#!/usr/bin/bash
# run ./migrate_db.sh

CUR_DIR="/home/wibet/database";
TIMESTAMP=`date +%s`;
MONTH=`date +%b`;
DAY=`date +%d`;
CONF=${CUR_DIR}"/db.conf";
MIGRATE="migrations";

cd $CUR_DIR;
DB=$1;
shift;
if [ -z "$DB" ]
then
    DB="sgtn_18244028_wc2022";
fi

create_path () {
    path=$1
    if [ ! -d ${path} ]
    then
        mkdir -p ${path};
    fi
}

dump_db () {
    timestamp=$1;
    path=$2;
    filename="sgtn_${timestamp}_wc2022.sql";
    mysqldump --defaults-extra-file=${CONF} ${DB} > ${path}/${filename};
    echo "Dumpped db at [${timestamp}] to [${path}] with name [${filename}]" >> ${CUR_DIR}/"dump.log";
}

main (){
    PATHFILE=${CUR_DIR}/${MIGRATE}/${MONTH}/${DAY};
    create_path ${PATHFILE};

    dump_db ${TIMESTAMP} ${PATHFILE};
    echo "Execute $0 completed...";
}

main
