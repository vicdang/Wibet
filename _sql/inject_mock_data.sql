-- Mock Data Injection for Staging Database
-- Creates realistic test data for users, matches, bets, and rankings
-- PRESERVES admin user (id=1) with email: vudnn.dl@gmail.com

-- ============================
-- 1. PRESERVE ADMIN USER & CLEAR TEST DATA
-- ============================
DELETE FROM bet;
DELETE FROM ranking;
DELETE FROM user WHERE id > 1;
DELETE FROM `match`;

-- Ensure admin user exists with correct credentials
INSERT INTO user (id, role_id, status, email, username, password, auth_key, created_by, created_ip, created_at)
VALUES (1, 1, 10, 'vudnn.dl@gmail.com', 'admin', '$2y$10$5oI9C0YVft/YeouiOAmbKOQsxG0zLfo5yHseUxEk02tkAK7zsWjJe', 'admin_key', 1, '127.0.0.1', NOW())
ON DUPLICATE KEY UPDATE
  email = 'vudnn.dl@gmail.com',
  username = 'admin',
  password = '$2y$10$5oI9C0YVft/YeouiOAmbKOQsxG0zLfo5yHseUxEk02tkAK7zsWjJe',
  role_id = 1;

-- ============================
-- 2. INSERT MOCK PLAYERS (10 test accounts)
-- ============================
INSERT INTO user (role_id, status, email, username, password, auth_key, created_by, created_ip, created_at) VALUES
(2, 10, 'player1@wibet.local', 'player1', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key1', 1, '127.0.0.1', NOW()),
(2, 10, 'player2@wibet.local', 'player2', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key2', 1, '127.0.0.1', NOW()),
(2, 10, 'player3@wibet.local', 'player3', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key3', 1, '127.0.0.1', NOW()),
(2, 10, 'player4@wibet.local', 'player4', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key4', 1, '127.0.0.1', NOW()),
(2, 10, 'player5@wibet.local', 'player5', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key5', 1, '127.0.0.1', NOW()),
(2, 10, 'player6@wibet.local', 'player6', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key6', 1, '127.0.0.1', NOW()),
(2, 10, 'player7@wibet.local', 'player7', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key7', 1, '127.0.0.1', NOW()),
(2, 10, 'player8@wibet.local', 'player8', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key8', 1, '127.0.0.1', NOW()),
(2, 10, 'player9@wibet.local', 'player9', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key9', 1, '127.0.0.1', NOW()),
(2, 10, 'player10@wibet.local', 'player10', '$2y$13$XeFeXWVBwwM6TZPm9yrJ6OmK5pBl5VL5cJzQJvZNvJ5H1Q7l.7lYO', 'key10', 1, '127.0.0.1', NOW());

-- ============================
-- 3. CREATE PROFILES FOR ALL USERS
-- ============================
INSERT INTO profile (user_id, full_name, timezone, money, created_at, updated_at) VALUES
(1, 'Administrator', 'Asia_Ho_Chi_Minh', 999999, NOW(), NOW()),
(2, 'Player One', 'Asia_Ho_Chi_Minh', 5000, NOW(), NOW()),
(3, 'Player Two', 'Asia_Ho_Chi_Minh', 4500, NOW(), NOW()),
(4, 'Player Three', 'Asia_Ho_Chi_Minh', 4000, NOW(), NOW()),
(5, 'Player Four', 'Asia_Ho_Chi_Minh', 3500, NOW(), NOW()),
(6, 'Player Five', 'Asia_Ho_Chi_Minh', 3000, NOW(), NOW()),
(7, 'Player Six', 'Asia_Ho_Chi_Minh', 2500, NOW(), NOW()),
(8, 'Player Seven', 'Asia_Ho_Chi_Minh', 2000, NOW(), NOW()),
(9, 'Player Eight', 'Asia_Ho_Chi_Minh', 1500, NOW(), NOW()),
(10, 'Player Nine', 'Asia_Ho_Chi_Minh', 1000, NOW(), NOW()),
(11, 'Player Ten', 'Asia_Ho_Chi_Minh', 500, NOW(), NOW())
ON DUPLICATE KEY UPDATE
  full_name = VALUES(full_name),
  money = VALUES(money);

-- ============================
-- 4. INSERT MOCK MATCHES (24 matches - Groups A-D)
-- ============================
INSERT INTO `match` (campaign_id, team_1, team_2, team_1_score, team_2_score, rate, result, match_date, description, created_by) VALUES
-- Group A
(1, 1, 5, 2, 1, 0.5, 1, '2026-06-12 21:00:00', 'Group A - Mexico vs Canada', 1),
(1, 10, 6, 1, 0, 0.5, 1, '2026-06-13 18:00:00', 'Group A - Morocco vs Switzerland', 1),
(1, 5, 10, NULL, NULL, 0.5, NULL, '2026-06-20 21:00:00', 'Group A - Canada vs Morocco', 1),
(1, 6, 1, NULL, NULL, 0.5, NULL, '2026-06-21 18:00:00', 'Group A - Switzerland vs Mexico', 1),
(1, 10, 5, NULL, NULL, 0.5, NULL, '2026-06-27 22:00:00', 'Group A - Morocco vs Canada', 1),
(1, 1, 6, NULL, NULL, 0.5, NULL, '2026-06-28 22:00:00', 'Group A - Mexico vs Switzerland', 1),
-- Group B
(1, 9, 7, 3, 0, 0.5, 1, '2026-06-13 21:00:00', 'Group B - Brazil vs Qatar', 1),
(1, 19, 20, 2, 1, 0.5, 1, '2026-06-14 18:00:00', 'Group B - France vs England', 1),
(1, 7, 19, NULL, NULL, 0.5, NULL, '2026-06-21 21:00:00', 'Group B - Qatar vs France', 1),
(1, 20, 9, NULL, NULL, 0.5, NULL, '2026-06-22 18:00:00', 'Group B - England vs Brazil', 1),
(1, 19, 7, NULL, NULL, 0.5, NULL, '2026-06-28 18:00:00', 'Group B - France vs Qatar', 1),
(1, 9, 20, NULL, NULL, 0.5, NULL, '2026-06-29 18:00:00', 'Group B - Brazil vs England', 1),
-- Group C
(1, 21, 22, 2, 0, 0.5, 1, '2026-06-12 18:00:00', 'Group C - Argentina vs Peru', 1),
(1, 23, 24, 1, 2, 0.5, 2, '2026-06-13 15:00:00', 'Group C - Poland vs Chile', 1),
(1, 22, 23, NULL, NULL, 0.5, NULL, '2026-06-20 18:00:00', 'Group C - Peru vs Poland', 1),
(1, 24, 21, NULL, NULL, 0.5, NULL, '2026-06-21 15:00:00', 'Group C - Chile vs Argentina', 1),
(1, 23, 24, NULL, NULL, 0.5, NULL, '2026-06-26 22:00:00', 'Group C - Poland vs Chile', 1),
(1, 21, 22, NULL, NULL, 0.5, NULL, '2026-06-27 22:00:00', 'Group C - Argentina vs Peru', 1),
-- Group D
(1, 25, 26, 1, 0, 0.5, 1, '2026-06-14 21:00:00', 'Group D - Netherlands vs Senegal', 1),
(1, 27, 28, 2, 2, 0.5, 0, '2026-06-15 18:00:00', 'Group D - Belgium vs Iceland', 1),
(1, 26, 27, NULL, NULL, 0.5, NULL, '2026-06-22 21:00:00', 'Group D - Senegal vs Belgium', 1),
(1, 28, 25, NULL, NULL, 0.5, NULL, '2026-06-23 18:00:00', 'Group D - Iceland vs Netherlands', 1),
(1, 27, 25, NULL, NULL, 0.5, NULL, '2026-06-29 22:00:00', 'Group D - Belgium vs Netherlands', 1),
(1, 26, 28, NULL, NULL, 0.5, NULL, '2026-06-30 22:00:00', 'Group D - Senegal vs Iceland', 1);

-- ============================
-- 5. INSERT MOCK BETS (30 bets across different matches)
-- ============================
INSERT INTO bet (user_id, match_id, `option`, money, is_active, created_time) VALUES
(2, 1, 1, 100, 0, NOW()),
(3, 1, 2, 150, 0, NOW()),
(4, 2, 1, 200, 0, NOW()),
(5, 2, 2, 75, 0, NOW()),
(6, 3, 1, 120, 1, NOW()),
(7, 3, 2, 180, 1, NOW()),
(8, 4, 1, 250, 1, NOW()),
(9, 5, 2, 90, 1, NOW()),
(10, 6, 1, 160, 1, NOW()),
(11, 7, 1, 140, 0, NOW()),
(2, 7, 2, 200, 0, NOW()),
(3, 8, 1, 175, 0, NOW()),
(4, 8, 2, 125, 0, NOW()),
(5, 9, 1, 185, 1, NOW()),
(6, 9, 2, 220, 1, NOW()),
(7, 10, 1, 95, 1, NOW()),
(8, 10, 2, 270, 1, NOW()),
(9, 11, 1, 110, 1, NOW()),
(10, 12, 2, 150, 1, NOW()),
(11, 13, 1, 300, 0, NOW()),
(2, 13, 2, 80, 0, NOW()),
(3, 14, 1, 190, 0, NOW()),
(4, 14, 2, 140, 0, NOW()),
(5, 15, 1, 225, 1, NOW()),
(6, 15, 2, 165, 1, NOW()),
(7, 16, 1, 130, 1, NOW()),
(8, 16, 2, 210, 1, NOW()),
(9, 17, 1, 170, 1, NOW()),
(10, 18, 2, 195, 1, NOW()),
(11, 18, 1, 240, 1, NOW());

-- ============================
-- SUMMARY
-- ============================
SELECT 'MOCK DATA INJECTION COMPLETED' as status,
  (SELECT COUNT(*) FROM user) as total_users,
  (SELECT COUNT(*) FROM `match`) as total_matches,
  (SELECT COUNT(*) FROM bet) as total_bets;
