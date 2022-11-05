#!/usr/bin/bash
time=`date +%s`; mysqldump --defaults-extra-file=db.conf sgtn_18244028_wc2022 > sgtn_${time}_wc2022.sql
