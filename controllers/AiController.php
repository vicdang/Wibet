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
}
