DELETE FROM `bet` WHERE id IS NOT NULL;
DELETE FROM `match` WHERE id IS NOT NULL;
UPDATE `user` SET `status` = 0 WHERE `id` > 1;
UPDATE `profile` SET `money` = 0 WHERE `id` > 1;
