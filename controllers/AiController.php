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
        $params = Yii::$app->params;
        $user = Yii::$app->user->identity;

        $totalAmount = $params['totalAmount'] ?? 0;
        $startingMoney = $params['startingMoney'] ?? 0;
        $minBet = $params['minBet'] ?? 0;
        $maxBet = $params['maxBet'] ?? 0;

        $teamCount = Team::find()->count();
        $matchCount = GameMatch::find()->count();

        $phase = AdminConfig::get('tournament_phase', 'group_stage');

        $recentMatches = GameMatch::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(10)
            ->all();

        $matchesInfo = '';
        foreach ($recentMatches as $match) {
            $team1Obj = Team::findOne($match->team_1);
            $team2Obj = Team::findOne($match->team_2);
            $team1 = $team1Obj ? $team1Obj->name : "Team {$match->team_1}";
            $team2 = $team2Obj ? $team2Obj->name : "Team {$match->team_2}";
            $date = $match->match_date ? date('Y-m-d H:i', strtotime($match->match_date)) : 'TBD';
            $score = ($match->team_1_score !== null && $match->team_2_score !== null)
                ? "{$match->team_1_score} - {$match->team_2_score}"
                : "Not played yet";
            $matchesInfo .= "\n- {$team1} vs {$team2} ({$date}): {$score}";
        }

        $userBalance = $user->profile->money ?? $startingMoney;
        $userPoints = $user->profile->points ?? 0;

        $prompt = <<<EOT
You are a helpful AI assistant for a World Cup 2026 betting application called Wibet.

APPLICATION RULES:
- Starting balance: $startingMoney coins
- Total prize pool: $totalAmount coins
- Min bet: $minBet coins per match
- Max bet: $maxBet coins per match
- Winning predictions earn points
- Users can refill their balance

TOURNAMENT INFO:
- Tournament phase: $phase
- Total teams: $teamCount
- Total matches: $matchCount
- Format: 48 teams in 12 groups (A-L), 4 teams per group in group stage, followed by knockout rounds (R32, R16, QF, SF, Finals, 3rd Place)

AVAILABLE MATCHES FOR BETTING (last 10):
$matchesInfo

CURRENT USER STATS:
- Balance: $userBalance coins
- Points: $userPoints

INSTRUCTIONS:
- Answer questions about the betting rules, how the app works, tournament format
- When user asks about matches, refer to the AVAILABLE MATCHES listed above - these are the matches you should analyze
- Provide match analysis using the match data shown above
- Be helpful and friendly
- Keep answers concise (1-2 sentences for simple questions, 3-4 for complex ones)
- No emojis
- If user asks about their balance or stats, use the data above
- Don't make up information about teams or matches not shown

User question:
EOT;

        return $prompt;
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
        $url = 'https://api-inference.huggingface.co/models/google/flan-t5-base';

        $fullPrompt = $systemPrompt . "\n\n" . $message;

        $payload = [
            'inputs' => $fullPrompt,
            'parameters' => [
                'max_length' => 512,
                'temperature' => 0.7,
            ]
        ];

        $headers = [
            'Authorization: Bearer ' . $apiKey,
            'content-type: application/json'
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => json_encode($payload),
                'timeout' => 30
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

        // HuggingFace returns an array of results
        if (is_array($data) && count($data) > 0) {
            if (isset($data[0]['generated_text'])) {
                $reply = $data[0]['generated_text'];
                // Remove the input prompt from the output
                $reply = str_replace($fullPrompt, '', $reply);
                $reply = trim($reply);
                return $reply ?: 'I apologize, but I could not generate a response. Please try again.';
            }
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
