update profile p
set money = money + (select if(b.`option`=1,money,money*(-1)) from bet b where b.match_id = 27 and b.user_id = p.user_id)
where p.user_id IN (select b.user_id from bet b where b.match_id = 27);

update `match` m
set result = 1
where id = 27