# DUMP DB
run ./migratedb.sh to migrate current database to sql file
dumped log will be tailing to log file dump.log

# NOTE
Make sure that dumpped sql files which containt data will NEVER be committed to the public
double check the .gitignore file
Please add "database/migrations/*" to .gitignore if NOT existing
double check before adding files

# CRON JOBS
show scheduling jobs:
crontab -l

edit jobs:
crontab -e

update and execute jobs:
service cron restart

## CURENT JOBS
run job from 16h to 23h, every 30min
*/30 16-23 * * * /home/wibet/database/migratedb.sh

run job from 0h to 3h, every 30min
*/30 0-3 * * * /home/wibet/database/migratedb.sh