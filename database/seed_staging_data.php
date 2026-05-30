<?php
/**
 * Staging Database Seeder - World Cup 2026 Mock Data
 * This script populates the staging database with test data for development
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');
$app = new yii\web\Application($config);

try {
    echo "🌱 Seeding Staging Database with Mock Data\n";
    echo "==========================================\n\n";

    $db = Yii::$app->db;

    // Get existing admin user
    $adminResult = $db->createCommand("SELECT id FROM user WHERE email = 'vudnn.dl@gmail.com' LIMIT 1")->queryOne();
    $adminId = $adminResult['id'] ?? 1;
    echo "✓ Admin user found (ID: $adminId)\n\n";

    // 1. Create Mock Users (15 users)
    echo "Creating mock users...\n";
    $mockUsers = [
        ['Nguyễn Văn A', 'nguyenvana', 'nguyenvana@example.com'],
        ['Trần Thị B', 'tranthib', 'tranthib@example.com'],
        ['Phạm Minh C', 'phamminhc', 'phamminhc@example.com'],
        ['Hoàng Việt D', 'hoangvietd', 'hoangvietd@example.com'],
        ['Đỗ Hải E', 'dohaie', 'dohaie@example.com'],
        ['Lê Kim F', 'lekimf', 'lekimf@example.com'],
        ['Vũ Quốc G', 'vuquocg', 'vuquocg@example.com'],
        ['Bùi Long H', 'builongh', 'builongh@example.com'],
        ['Cao Tuấn I', 'caotuani', 'caotuani@example.com'],
        ['Dương Hùng J', 'duonghungj', 'duonghungj@example.com'],
        ['Giang Ánh K', 'gianganhk', 'gianganhk@example.com'],
        ['Hải Yến L', 'haiyenl', 'haiyenl@example.com'],
        ['Ích Đức M', 'ichdcm', 'ichdcm@example.com'],
        ['Khánh Linh N', 'khanhlinhn', 'khanhlinhn@example.com'],
        ['Linh Đà O', 'linhdao', 'linhdao@example.com'],
    ];

    $userIds = [];
    foreach ($mockUsers as $user) {
        list($fullName, $username, $email) = $user;
        $password = password_hash('password123', PASSWORD_BCRYPT);

        $db->createCommand()->insert('user', [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => 2,
            'status' => 10,
            'created_by' => $adminId,
            'created_at' => date('Y-m-d H:i:s'),
            'auth_key' => bin2hex(random_bytes(32)),
            'access_token' => bin2hex(random_bytes(32)),
            'created_ip' => '127.0.0.1',
        ])->execute();

        $userId = $db->getLastInsertID();
        $userIds[] = $userId;

        // Create profile for user
        $db->createCommand()->insert('profile', [
            'user_id' => $userId,
            'full_name' => $fullName,
            'money' => rand(300, 1000),
            'timezone' => 'Asia/Ho_Chi_Minh',
            'created_at' => date('Y-m-d H:i:s'),
        ])->execute();

        echo "  ✓ Created user: $username (ID: $userId)\n";
    }

    echo "✓ " . count($userIds) . " mock users created\n\n";

    // 2. Get all teams
    echo "Fetching teams...\n";
    $teams = $db->createCommand("SELECT id, name, group_name FROM team ORDER BY group_name, id")->queryAll();
    $teamsByGroup = [];
    foreach ($teams as $team) {
        $group = $team['group_name'];
        if (!isset($teamsByGroup[$group])) {
            $teamsByGroup[$group] = [];
        }
        $teamsByGroup[$group][] = $team;
    }
    echo "✓ " . count($teams) . " teams found\n\n";

    // 3. Create World Cup 2026 Matches
    echo "Creating World Cup 2026 matches...\n";
    $matchCount = 0;
    $baseDate = new DateTime('2026-06-12'); // World Cup start date

    // Group Stage Matches (64 matches = 16 matches per group)
    $groupOrder = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
    $matchdayCounter = 0;

    foreach ($groupOrder as $groupLetter) {
        $groupTeams = array_values(array_filter($teams, fn($t) => $t['group_name'] === $groupLetter));

        // Each group plays round-robin (6 matches per group)
        for ($i = 0; $i < count($groupTeams); $i++) {
            for ($j = $i + 1; $j < count($groupTeams); $j++) {
                $team1 = $groupTeams[$i];
                $team2 = $groupTeams[$j];

                $matchDate = (clone $baseDate)->add(new DateInterval('P' . $matchdayCounter . 'D'));

                $db->createCommand()->insert('match', [
                    'team_1' => $team1['name'],
                    'team_2' => $team2['name'],
                    'match_date' => $matchDate->format('Y-m-d H:i:s'),
                    'description' => "Group $groupLetter: {$team1['name']} vs {$team2['name']}",
                    'created_by' => $adminId,
                    'visible' => 1,
                ])->execute();

                $matchCount++;
            }
            $matchdayCounter++;
        }
    }

    echo "  ✓ Group stage: $matchCount matches created\n";

    // Knockout Matches (16 matches)
    $knockoutDate = (clone $baseDate)->add(new DateInterval('P21D'));
    $knockoutMatches = [
        'Round of 16 - Match 1',
        'Round of 16 - Match 2',
        'Round of 16 - Match 3',
        'Round of 16 - Match 4',
        'Round of 16 - Match 5',
        'Round of 16 - Match 6',
        'Round of 16 - Match 7',
        'Round of 16 - Match 8',
        'Quarterfinal 1',
        'Quarterfinal 2',
        'Quarterfinal 3',
        'Quarterfinal 4',
        'Semifinal 1',
        'Semifinal 2',
        'Third Place Match',
        'Final',
    ];

    foreach ($knockoutMatches as $idx => $description) {
        $matchDate = (clone $knockoutDate)->add(new DateInterval('P' . $idx . 'D'));

        // Use random teams from different groups for knockout matches
        $team1 = $teams[rand(0, count($teams) - 1)];
        $team2 = $teams[rand(0, count($teams) - 1)];

        // Ensure different teams
        while ($team2['id'] === $team1['id']) {
            $team2 = $teams[rand(0, count($teams) - 1)];
        }

        $db->createCommand()->insert('match', [
            'team_1' => $team1['name'],
            'team_2' => $team2['name'],
            'match_date' => $matchDate->format('Y-m-d H:i:s'),
            'description' => $description,
            'created_by' => $adminId,
            'visible' => 1,
        ])->execute();

        $matchCount++;
    }

    echo "  ✓ Knockout stage: 16 matches created\n";
    echo "✓ Total matches created: $matchCount\n\n";

    echo "==========================================\n";
    echo "✅ Staging database seeded successfully!\n\n";
    echo "Mock User Credentials (all with password: 'password123'):\n";
    foreach ($mockUsers as $user) {
        list($fullName, $username, $email) = $user;
        echo "  - Username: $username | Email: $email\n";
    }
    echo "\nAdmin Account:\n";
    echo "  - Email: vudnn.dl@gmail.com\n";
    echo "  - (Password unchanged)\n";

} catch (Exception $e) {
    echo "❌ Error seeding database: " . $e->getMessage() . "\n";
    exit(1);
}
