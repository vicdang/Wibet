#!/usr/bin/bash
# run ./migrate_db.sh

CUR_DIR="/home/wibet/database";
TIMESTAMP=`date +%s`;
MONTH=`date +%b`;
DAY=`date +%d`;
CONF=${CUR_DIR}"/db.conf";
MIGRATE="migrations";
GAME="er2024";

cd $CUR_DIR;
DB=$1;
shift;
if [ -z "$DB" ]
then
    DB="wibet_1670044606_${GAME}";
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
    filename="wibet_${timestamp}_${GAME}.sql";
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
