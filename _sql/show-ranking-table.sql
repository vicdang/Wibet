SELECT *, ROUND(win_times/bet_times*100,2) AS win_rate, (money+bet_money) AS total_money
FROM
	( SELECT u.id, u.username, u.email, p.full_name, p.money,
				( SELECT COUNT(id) FROM bet WHERE user_id = u.id ) AS bet_times,
				( SELECT COUNT(b.id) FROM bet b INNER JOIN `match` m ON m.id = match_id 
								WHERE user_id=u.id AND m.result IS NOT NULL AND `option` = m.result AND m.result <> 0 ) AS win_times,
				( SELECT IF(COUNT(money) > 0, SUM(money), 0) FROM bet WHERE user_id=28 AND is_active = 1 ) AS bet_money
	FROM `user` u
		INNER JOIN `profile` p ON p.user_id = u.id
	WHERE u.role_id = 2 ) AS ranking_table