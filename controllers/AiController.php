<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\AdminConfig;
use app\models\GameMatch;
use app\models\Team;

class AiController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['chat'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public $enableCsrfValidation = false;

    public function actionChat()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isPost) {
            return ['error' => 'Invalid request method'];
        }

        $message = Yii::$app->request->post('message', '');
        if (empty($message)) {
            return ['error' => 'Message cannot be empty'];
        }

        // Check if demo mode is enabled
        $demoMode = AdminConfig::get('ai_demo_mode', '1');
        if ($demoMode === '1' || $demoMode === 1) {
            return $this->getDemoResponse($message);
        }

        $provider = AdminConfig::get('ai_provider', 'huggingface');
        $apiKey = '';

        if ($provider === 'claude') {
            $apiKey = AdminConfig::get('ai_api_key_claude', '');
        } elseif ($provider === 'gemini') {
            $apiKey = AdminConfig::get('ai_api_key_gemini', '');
        } elseif ($provider === 'huggingface') {
            $apiKey = AdminConfig::get('ai_api_key_huggingface', '');
        }

        if (empty($apiKey) && $provider !== 'huggingface') {
            return ['error' => 'AI provider not configured. Please add an API key in the Config page.'];
        }

        if ($provider === 'huggingface' && empty($apiKey)) {
            return ['error' => 'HuggingFace API key not configured. Get a free token from huggingface.co and add it in the Config page.'];
        }

        $systemPrompt = $this->buildSystemPrompt();

        try {
            if ($provider === 'claude') {
                $reply = $this->callClaudeApi($message, $systemPrompt, $apiKey);
            } elseif ($provider === 'gemini') {
                $reply = $this->callGeminiApi($message, $systemPrompt, $apiKey);
            } elseif ($provider === 'huggingface') {
                $reply = $this->callHuggingFaceApi($message, $systemPrompt, $apiKey);
            } else {
                return ['error' => 'Unknown AI provider'];
            }

            return ['reply' => $reply, 'status' => 'ok'];
        } catch (\Exception $e) {
            return ['error' => 'AI service error: ' . $e->getMessage()];
        }
    }

    private function buildSystemPrompt()
    {
        $user = Yii::$app->user->identity;

        // All config from DB — source of truth is the Config page
        $startingMoney = AdminConfig::get('starting_money',  200);
        $minBet        = AdminConfig::get('min_bet_money',   50);
        $maxBet        = AdminConfig::get('max_pay_money',   300);
        $totalAmount   = AdminConfig::get('total_amount',    0);
        $phase         = AdminConfig::get('tournament_phase', 'group_stage');
        $minBetTimes   = AdminConfig::get('min_bet_times',   4);
        $maxRefill     = AdminConfig::get('max_refill_times', 3);
        $payTime       = AdminConfig::get('pay_time',        '09h00,22h30');
        $seasonName    = AdminConfig::get('season_name',     'WC 2026');
        $userBalance   = $user->profile->money ?? $startingMoney;

        // Build team list grouped by group
        $teams = Team::find()->orderBy(['group_name' => SORT_ASC, 'name' => SORT_ASC])->all();
        $groupedTeams = [];
        foreach ($teams as $team) {
            $groupedTeams[$team->group_name][] = $team->name;
        }
        $teamsInfo = '';
        foreach ($groupedTeams as $group => $names) {
            $teamsInfo .= "\n  Group {$group}: " . implode(', ', $names);
        }

        // Build match list
        $matches = GameMatch::find()->orderBy(['match_date' => SORT_ASC, 'id' => SORT_ASC])->all();
        $matchesInfo = '';
        if (empty($matches)) {
            $matchesInfo = "\n  No matches scheduled yet.";
        } else {
            foreach ($matches as $m) {
                $t1   = Team::findOne($m->team_1);
                $t2   = Team::findOne($m->team_2);
                $n1   = $t1 ? $t1->name : "Team {$m->team_1}";
                $n2   = $t2 ? $t2->name : "Team {$m->team_2}";
                $date = $m->match_date ? date('d/m/Y H:i', strtotime($m->match_date)) : 'TBD';
                $score = ($m->team_1_score !== null && $m->team_2_score !== null)
                    ? "{$m->team_1_score}-{$m->team_2_score}"
                    : 'upcoming';
                $rate = $m->rate !== null ? $m->rate : 'N/A';
                $totalBet = (int) \Yii::$app->db->createCommand(
                    'SELECT IFNULL(SUM(money), 0) FROM bet WHERE match_id = :id AND is_active = 1'
                )->bindValue(':id', $m->id)->queryScalar();
                $matchesInfo .= "\n  {$n1} vs {$n2} ({$date}): {$score}, handicap: {$rate}, total bet: {$totalBet}❤️";
            }
        }

        // Build ranking top 10
        $rankingInfo = '';
        $rankRows = \Yii::$app->db->createCommand(
            'SELECT username, money, total_money, bet_times, win_times FROM ranking ORDER BY money DESC LIMIT 10'
        )->queryAll();
        if (empty($rankRows)) {
            $rankingInfo = 'No ranking data yet.';
        } else {
            foreach ($rankRows as $i => $r) {
                $rankingInfo .= ($i + 1) . ". {$r['username']} — {$r['money']}❤️ (won {$r['win_times']}/{$r['bet_times']} bets)\n";
            }
        }

        // Build prize structure entirely from DB
        $tierNames  = ['Diamond', 'Platinum', 'Gold', 'Silver', 'Consolation'];
        $tierRates  = [
            AdminConfig::get('p1_rate',  25),
            AdminConfig::get('p2_rate',  20),
            AdminConfig::get('p3_rate',  10),
            AdminConfig::get('p4_rate',  5),
            AdminConfig::get('p5_rate',  0),
        ];
        $tierCounts = [
            AdminConfig::get('p1_count', 1),
            AdminConfig::get('p2_count', 1),
            AdminConfig::get('p3_count', 2),
            AdminConfig::get('p4_count', 4),
            AdminConfig::get('p5_count', 5),
        ];
        $mtRate  = AdminConfig::get('mt_rate',  10);
        $adjRate = AdminConfig::get('adj_rate', 5);
        $prizeInfo  = "- Operating cost: {$mtRate}%, Adjustment fund: {$adjRate}%\n";
        $totalPrizes = 0;
        foreach ($tierNames as $i => $name) {
            $count = $tierCounts[$i];
            $rate  = $tierRates[$i];
            $pos   = $i + 1;
            $totalPrizes += $count;
            $prizeInfo .= "- {$pos}. {$name}: {$count} prize(s), {$rate}% each (" . ($rate * $count) . "% total)\n";
        }
        $prizeInfo .= "- Total prizes per round: {$totalPrizes}";

        return <<<EOT
You are an AI assistant for Wibet (also called Wibex), a score-prediction game for {$seasonName} for a private group.

CURRENCY: ❤️ (Hearts / "Máu" in Vietnamese). NOT real money — purely for fun and prizes.

GAME STRUCTURE:
- 104 total matches across 4 independent rounds: VB1 (24 matches), VB2 (24), VB3 (24), LTT/Knockout (32).
- Each round's prizes are settled independently.
- Tournament phase: {$phase}.

STARTING & REFILL PACKAGES (Dịch Vụ Y Tế):
- Tân Thủ [GTT] (New player): {$startingMoney}K → {$startingMoney}❤️
- Sơ Cứu [GSC]: 99K → 100❤️
- Cấp Cứu [GCC]: 149K → 160❤️ (+7% bonus)
- ICU [ICU]: 199K → 250❤️ (+26% bonus)
- Max {$maxRefill} refills per round. Refill allowed when balance < 50❤️.
- Payment gateway open {$payTime} daily. Transactions after closing time processed next day at opening.
- Contact admin Giàu Võ (Skype/MoMo: 0834020737, BIDV: 1440216948) to create account or refill.

PREDICTION RULES:
- Min {$minBet}❤️ per match. Must play at least {$minBetTimes} matches per round to qualify for prizes.
- Handicap lines: 0, 0.25, 0.5, 0.75, 1. Winning amount depends on handicap and margin of victory.
- Current user balance: {$userBalance}❤️.

PRIZE STRUCTURE (per round, total pool: {$totalAmount}K VND):
{$prizeInfo}
- Tiebreaker: 1) total hearts, 2) matches played, 3) wins.

REACTIVATION BONUS (Hồi Sinh — for group-stage players re-entering knockout round):
- Sơ Cấp (reach 400❤️ refill): +20% bonus on first reactivation.
- Trung Cấp (reach 600❤️): +30% bonus.
- Siêu Cấp (reach 800❤️): +50% bonus.

ACCESS LEVELS:
- Group stage (VB): Can see others' prediction history, match participation lists, and live prediction ratios.
- Knockout (LTT): Can only see own predictions; others' details are hidden.

TEAMS BY GROUP ({$phase}):
{$teamsInfo}

MATCHES:{$matchesInfo}

CURRENT RANKINGS (top 10):
{$rankingInfo}

INSTRUCTIONS:
- Only reference teams, matches, and players listed above. Do not invent data.
- Each match in MATCHES already includes its handicap (tỉ lệ chấp) and total amount bet so far (tổng tiền cược). Use these values directly when asked.
- Answer in the same language the user writes in (Vietnamese or English).
- Use markdown formatting: **bold** for key terms, bullet lists for multiple items, numbered lists for steps.
- Be concise: 1-2 sentences for simple questions, up to 6 lines for complex ones.
EOT;
    }

    private function callClaudeApi($message, $systemPrompt, $apiKey)
    {
        $url = 'https://api.anthropic.com/v1/messages';

        $payload = [
            'model' => 'claude-haiku-4-5-20251001',
            'max_tokens' => 1024,
            'system' => $systemPrompt,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ]
        ];

        $headers = [
            'x-api-key: ' . $apiKey,
            'anthropic-version: 2023-06-01',
            'content-type: application/json'
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => json_encode($payload),
                'timeout' => 15
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception('Failed to connect to Claude API');
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            throw new \Exception('Claude API error: ' . $data['error']['message']);
        }

        if (isset($data['content'][0]['text'])) {
            return $data['content'][0]['text'];
        }

        throw new \Exception('Unexpected response format from Claude API');
    }

    private function callGeminiApi($message, $systemPrompt, $apiKey)
    {
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . urlencode($apiKey);

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $systemPrompt . "\n\n" . $message
                        ]
                    ]
                ]
            ]
        ];

        $headers = [
            'content-type: application/json'
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => json_encode($payload),
                'timeout' => 15
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception('Failed to connect to Gemini API');
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            throw new \Exception('Gemini API error: ' . $data['error']['message']);
        }

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new \Exception('Unexpected response format from Gemini API');
    }

    private function callHuggingFaceApi($message, $systemPrompt, $apiKey)
    {
        $model = 'Qwen/Qwen2.5-7B-Instruct';
        $url = 'https://router.huggingface.co/featherless-ai/v1/chat/completions';

        $payload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user',   'content' => $message],
            ],
            'max_tokens' => 500,
            'temperature' => 0.7,
        ];

        $headers = [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ];

        $options = [
            'http' => [
                'method'        => 'POST',
                'header'        => implode("\r\n", $headers),
                'content'       => json_encode($payload),
                'timeout'       => 30,
                'ignore_errors' => true,
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception('Failed to connect to HuggingFace API');
        }

        $data = json_decode($response, true);

        if (isset($data['error'])) {
            throw new \Exception('HuggingFace API error: ' . (is_array($data['error']) ? json_encode($data['error']) : $data['error']));
        }

        if (isset($data['choices'][0]['message']['content'])) {
            return trim($data['choices'][0]['message']['content']);
        }

        throw new \Exception('Unexpected response format from HuggingFace API');
    }

    private function getDemoResponse($message)
    {
        $message = strtolower($message);

        // Define demo responses for common questions
        $demoResponses = [
            'rules' => 'World Cup 2026 betting rules: Start with 300K coins. Each match requires minimum 50K bet. Win predictions earn points. You can refill your balance up to 4 times. Maximum 2 accounts per player. Good luck!',
            'bet' => 'To place a bet: Go to Matches page, select a match, choose your prediction (Win/Draw/Loss), enter bet amount, confirm. Your balance updates immediately based on results.',
            'refill' => 'Refill your balance: Go to Account settings, click Refill, select amount (50K to 2000K), confirm payment. You can refill up to 4 times per season.',
            'team' => 'Teams page shows all 48 World Cup 2026 teams organized in 12 groups (A-L). Each group has 4 teams. Click a team to see full statistics and match records.',
            'match' => 'Matches page displays all upcoming and completed World Cup matches. Click a match to place bets. Results update automatically after each match.',
            'prize' => 'Prize pool: Top 1 gets 25%, 2nd gets 10%, 3rd gets 20%, 4th gets 5% of total pool. Excellent rewards for winning predictions!',
            'account' => 'Account settings: View your balance, betting history, adjust notifications. Keep track of your performance and winnings here.',
            'group stage' => 'Group stage: 48 teams in 12 groups play round-robin. Each team plays 3 matches. Top 2 from each group advance to knockout stage.',
            'knockout' => 'Knockout stage: Teams compete in 6 rounds (R32, R16, QF, SF, Finals, 3rd Place). Single elimination - one loss and you\'re out!',
            'hi' => 'Hello! I can help you with betting rules, match information, team statistics, and tournament details. What would you like to know?',
            'hello' => 'Hello! I can help you with betting rules, match information, team statistics, and tournament details. What would you like to know?',
            'help' => 'I can help with: Game rules, betting guide, team information, match details, account management, prize structure, and tournament format.',
        ];

        // Check for keyword matches
        foreach ($demoResponses as $keyword => $response) {
            if (strpos($message, $keyword) !== false) {
                return ['reply' => $response, 'status' => 'ok'];
            }
        }

        // Default response
        return [
            'reply' => 'I can help you with World Cup 2026 betting rules, teams, matches, and tournament details. Try asking about: rules, betting, refill, teams, matches, prizes, or account. What would you like to know?',
            'status' => 'ok'
        ];
    }
}
