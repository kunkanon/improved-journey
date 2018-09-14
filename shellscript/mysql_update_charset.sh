#!/bin/bash

#usage ./update_charset.sh 127.0.0.1 usr_root pwd_root db_test
HOSTDB=$1
USRDB=$2
PSWDDB=$3
DBNM=$4
mysql -h $HOSTDB -u $USRDB -p${PSWDDB} -e "SELECT CONCAT('ALTER TABLE ',TABLE_SCHEMA,'.',TABLE_NAME,' CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;') FROM information_schema.TABLES WHERE TABLE_SCHEMA = '${DBNM}';" > update_charset.sql
sed -i '1d;$d' update_charset.sql
mysql -h $HOSTDB -u $USRDB -p${PSWDDB} $DBNM < update_charset.sql
rm update_charset.sql
