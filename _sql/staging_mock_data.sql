-- =============================================================
-- STAGING MOCK DATA — Wibet World Cup 2026
-- Password for all mock users: demo123
-- Run against: wibet_staging
-- =============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -------------------------------------------------------------
-- 1. USERS  (role_id=2 = regular user, status=1 = active)
-- -------------------------------------------------------------
INSERT INTO `user` (id, role_id, status, email, username, password, auth_key, created_ip, created_at, updated_at, created_by) VALUES
(20, 2, 1, 'an.nguyen@example.com',   'nguyen_van_an',      '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:00:00', '2026-06-01 08:00:00', 3),
(21, 2, 1, 'bich.tran@example.com',   'tran_thi_bich',      '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:05:00', '2026-06-01 08:05:00', 3),
(22, 2, 1, 'duc.le@example.com',      'le_minh_duc',        '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:10:00', '2026-06-01 08:10:00', 3),
(23, 2, 1, 'ha.pham@example.com',     'pham_hong_ha',       '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:15:00', '2026-06-01 08:15:00', 3),
(24, 2, 1, 'binh.hoang@example.com',  'hoang_van_binh',     '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:20:00', '2026-06-01 08:20:00', 3),
(25, 2, 1, 'thao.do@example.com',     'do_thu_thao',        '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:25:00', '2026-06-01 08:25:00', 3),
(26, 2, 1, 'long.nguyen@example.com', 'nguyen_thanh_long',  '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:30:00', '2026-06-01 08:30:00', 3),
(27, 2, 1, 'lan.vu@example.com',      'vu_thi_lan',         '$2y$13$HlO6/D23NnYTmFoLWgZsnOT.gCx89YHSojnQxWcGnvNlmpVJTq/8u', NULL, '127.0.0.1', '2026-06-01 08:35:00', '2026-06-01 08:35:00', 3);

-- -------------------------------------------------------------
-- 2. PROFILES  (money = current balance after all settled bets)
-- -------------------------------------------------------------
-- Starting money was 300 for each user.
-- money column = balance after settled bets, minus active (pending) bets.
INSERT INTO `profile` (user_id, full_name, timezone, money, created_at, updated_at) VALUES
(20, 'Nguyễn Văn An',     'Asia_Ho_Chi_Minh', 550, '2026-06-01 08:00:00', NOW()),
(21, 'Trần Thị Bích',     'Asia_Ho_Chi_Minh', 110, '2026-06-01 08:05:00', NOW()),
(22, 'Lê Minh Đức',       'Asia_Ho_Chi_Minh', 510, '2026-06-01 08:10:00', NOW()),
(23, 'Phạm Hồng Hà',      'Asia_Ho_Chi_Minh', 130, '2026-06-01 08:15:00', NOW()),
(24, 'Hoàng Văn Bình',    'Asia_Ho_Chi_Minh', 370, '2026-06-01 08:20:00', NOW()),
(25, 'Đỗ Thu Thảo',       'Asia_Ho_Chi_Minh', 460, '2026-06-01 08:25:00', NOW()),
(26, 'Nguyễn Thanh Long', 'Asia_Ho_Chi_Minh', 220, '2026-06-01 08:30:00', NOW()),
(27, 'Vũ Thị Lan',        'Asia_Ho_Chi_Minh', 300, '2026-06-01 08:35:00', NOW());

-- -------------------------------------------------------------
-- 3. MATCHES  (campaign_id=1 = World Cup 2026)
-- team IDs: 49=Mexico 50=S.Africa 51=S.Korea 52=Czechia 56=Switzerland
--           57=Brazil 60=Scotland 61=USA 64=Turkey 65=Germany
--           69=Netherlands 70=Japan 73=Belgium 77=Spain 80=Uruguay
--           81=France 85=Argentina 89=Portugal 92=Colombia 93=England 94=Croatia
-- result: NULL=upcoming, 0=draw, 1=team1 wins, 2=team2 wins
-- -------------------------------------------------------------
INSERT INTO `match` (id, campaign_id, team_1, team_2, rate, team_1_score, team_2_score, result, match_date, visible, created_by, created_time) VALUES
-- Completed matches
(1,  1, 49, 50, 0.5,  2, 0, 1, '2026-06-13 17:00:00', 1, 3, '2026-06-12 10:00:00'),  -- Mexico 2-0 S.Africa
(2,  1, 57, 56, 0.5,  3, 1, 1, '2026-06-14 17:00:00', 1, 3, '2026-06-12 10:05:00'),  -- Brazil 3-1 Switzerland
(3,  1, 65, 60, 1.0,  5, 1, 1, '2026-06-14 20:00:00', 1, 3, '2026-06-12 10:10:00'),  -- Germany 5-1 Scotland
(4,  1, 77, 94, 0.0,  0, 0, 0, '2026-06-15 17:00:00', 1, 3, '2026-06-12 10:15:00'),  -- Spain 0-0 Croatia (draw)
(5,  1, 85, 81,-0.5,  2, 1, 1, '2026-06-15 20:00:00', 1, 3, '2026-06-12 10:20:00'),  -- Argentina 2-1 France
(6,  1, 61, 89,-1.0,  1, 3, 2, '2026-06-16 17:00:00', 1, 3, '2026-06-12 10:25:00'),  -- USA 1-3 Portugal
(7,  1, 51, 64, 0.0,  1, 1, 0, '2026-06-16 20:00:00', 1, 3, '2026-06-12 10:30:00'),  -- S.Korea 1-1 Turkey (draw)
(8,  1, 93, 73, 0.25, 2, 1, 1, '2026-06-17 17:00:00', 1, 3, '2026-06-12 10:35:00'),  -- England 2-1 Belgium
-- Upcoming matches
(9,  1, 69, 70, 0.5,  NULL, NULL, NULL, '2026-06-19 17:00:00', 1, 3, '2026-06-12 10:40:00'),  -- Netherlands vs Japan
(10, 1, 92, 80, 0.0,  NULL, NULL, NULL, '2026-06-19 20:00:00', 1, 3, '2026-06-12 10:45:00'),  -- Colombia vs Uruguay
(11, 1, 81, 85,-0.5,  NULL, NULL, NULL, '2026-06-20 17:00:00', 1, 3, '2026-06-12 10:50:00'),  -- France vs Argentina
(12, 1, 57, 65, 0.5,  NULL, NULL, NULL, '2026-06-21 17:00:00', 1, 3, '2026-06-12 10:55:00');  -- Brazil vs Germany

-- -------------------------------------------------------------
-- 4. BETS
-- option: 1=team1, 2=team2, 0=draw/skip
-- is_active: 0=settled, 1=pending (upcoming match)
-- money: amount wagered
-- -------------------------------------------------------------
INSERT INTO `bet` (user_id, match_id, `option`, money, is_active, created_time) VALUES

-- nguyen_van_an (user 20) — strong predictor, 5W/8 bets, ends at 550
(20, 1,  1, 80,  0, '2026-06-13 10:00:00'),  -- Mexico  ✓ WIN
(20, 2,  1, 70,  0, '2026-06-14 10:00:00'),  -- Brazil  ✓ WIN
(20, 3,  1, 60,  0, '2026-06-14 10:00:00'),  -- Germany ✓ WIN
(20, 4,  1, 50,  0, '2026-06-15 10:00:00'),  -- Spain   ~ DRAW (refund)
(20, 5,  1, 80,  0, '2026-06-15 10:00:00'),  -- Argentina ✓ WIN
(20, 8,  1, 70,  0, '2026-06-17 10:00:00'),  -- England ✓ WIN
(20, 9,  1, 60,  1, '2026-06-18 10:00:00'),  -- Netherlands (pending)
(20, 11, 2, 50,  1, '2026-06-18 10:00:00'),  -- France (pending)

-- tran_thi_bich (user 21) — mixed results, 2W/8 bets, ends at 110
(21, 1,  2, 80,  0, '2026-06-13 10:30:00'),  -- S.Africa ✗ LOSE
(21, 2,  1, 70,  0, '2026-06-14 10:30:00'),  -- Brazil   ✓ WIN
(21, 3,  2, 60,  0, '2026-06-14 10:30:00'),  -- Scotland ✗ LOSE
(21, 5,  2, 80,  0, '2026-06-15 10:30:00'),  -- France   ✗ LOSE
(21, 6,  2, 70,  0, '2026-06-16 10:30:00'),  -- Portugal ✓ WIN
(21, 7,  1, 50,  0, '2026-06-16 10:30:00'),  -- S.Korea  ~ DRAW (refund)
(21, 8,  2, 60,  0, '2026-06-17 10:30:00'),  -- Belgium  ✗ LOSE
(21, 10, 1, 50,  1, '2026-06-18 10:30:00'),  -- Colombia (pending)

-- le_minh_duc (user 22) — excellent run, 5W/7 bets, ends at 510
(22, 1,  1, 100, 0, '2026-06-13 11:00:00'),  -- Mexico    ✓ WIN
(22, 3,  1, 80,  0, '2026-06-14 11:00:00'),  -- Germany   ✓ WIN
(22, 5,  1, 70,  0, '2026-06-15 11:00:00'),  -- Argentina ✓ WIN
(22, 6,  2, 60,  0, '2026-06-16 11:00:00'),  -- Portugal  ✓ WIN
(22, 8,  1, 50,  0, '2026-06-17 11:00:00'),  -- England   ✓ WIN
(22, 9,  1, 80,  1, '2026-06-18 11:00:00'),  -- Netherlands (pending)
(22, 12, 1, 70,  1, '2026-06-18 11:00:00'),  -- Brazil (pending)

-- pham_hong_ha (user 23) — unlucky, 0W/6 bets, ends at 130
(23, 1,  2, 40,  0, '2026-06-13 11:30:00'),  -- S.Africa ✗ LOSE
(23, 2,  2, 30,  0, '2026-06-14 11:30:00'),  -- Switzerland ✗ LOSE
(23, 3,  2, 40,  0, '2026-06-14 11:30:00'),  -- Scotland ✗ LOSE
(23, 5,  2, 30,  0, '2026-06-15 11:30:00'),  -- France   ✗ LOSE
(23, 7,  2, 30,  0, '2026-06-16 11:30:00'),  -- Turkey   ~ DRAW (refund)
(23, 10, 2, 30,  1, '2026-06-18 11:30:00'),  -- Uruguay (pending)

-- hoang_van_binh (user 24) — balanced, 3W/8 bets, ends at 370
(24, 2,  1, 90,  0, '2026-06-14 12:00:00'),  -- Brazil    ✓ WIN
(24, 4,  0, 50,  0, '2026-06-15 12:00:00'),  -- draw      ~ DRAW (refund)
(24, 5,  2, 60,  0, '2026-06-15 12:00:00'),  -- France    ✗ LOSE
(24, 6,  2, 80,  0, '2026-06-16 12:00:00'),  -- Portugal  ✓ WIN
(24, 7,  1, 60,  0, '2026-06-16 12:00:00'),  -- S.Korea   ~ DRAW (refund)
(24, 8,  1, 70,  0, '2026-06-17 12:00:00'),  -- England   ✓ WIN
(24, 11, 2, 60,  1, '2026-06-18 12:00:00'),  -- France (pending)
(24, 12, 2, 50,  1, '2026-06-18 12:00:00'),  -- Germany (pending)

-- do_thu_thao (user 25) — hot streak, 4W/6 bets, ends at 460
(25, 1,  1, 100, 0, '2026-06-13 12:30:00'),  -- Mexico   ✓ WIN
(25, 2,  1, 90,  0, '2026-06-14 12:30:00'),  -- Brazil   ✓ WIN
(25, 3,  1, 80,  0, '2026-06-14 12:30:00'),  -- Germany  ✓ WIN
(25, 6,  2, 70,  0, '2026-06-16 12:30:00'),  -- Portugal ✓ WIN
(25, 9,  1, 100, 1, '2026-06-18 12:30:00'),  -- Netherlands (pending)
(25, 10, 1, 80,  1, '2026-06-18 12:30:00'),  -- Colombia (pending)

-- nguyen_thanh_long (user 26) — average, 2W/7 bets, ends at 220
(26, 1,  1, 70,  0, '2026-06-13 13:00:00'),  -- Mexico      ✓ WIN
(26, 2,  2, 60,  0, '2026-06-14 13:00:00'),  -- Switzerland ✗ LOSE
(26, 4,  0, 50,  0, '2026-06-15 13:00:00'),  -- draw        ~ DRAW (refund)
(26, 5,  1, 70,  0, '2026-06-15 13:00:00'),  -- Argentina   ✓ WIN
(26, 8,  2, 50,  0, '2026-06-17 13:00:00'),  -- Belgium     ✗ LOSE
(26, 11, 1, 50,  1, '2026-06-18 13:00:00'),  -- Argentina (pending)
(26, 12, 1, 60,  1, '2026-06-18 13:00:00'),  -- Brazil (pending)

-- vu_thi_lan (user 27) — beginner, 2W/4 bets, ends at 300
(27, 3,  1, 50,  0, '2026-06-14 13:30:00'),  -- Germany  ✓ WIN
(27, 6,  1, 50,  0, '2026-06-16 13:30:00'),  -- USA      ✗ LOSE
(27, 8,  1, 50,  0, '2026-06-17 13:30:00'),  -- England  ✓ WIN
(27, 9,  2, 50,  1, '2026-06-18 13:30:00');  -- Japan (pending)

SET FOREIGN_KEY_CHECKS = 1;
