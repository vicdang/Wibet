#!/usr/bin/bash
time=`date +%s`; mysqldump --defaults-extra-file=db.conf sgtn_18244028_euro2021 > sgtn_${time}_euro2021
