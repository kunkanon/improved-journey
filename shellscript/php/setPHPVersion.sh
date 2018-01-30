#!/bin/bash
#usage
#./setPHPVersion.sh 72 /opt/apache24
VERSION=$1
APACHEDIR=$2
cp -f $APACHEDIR/conf/extra/fcgi$VERSION.conf $APACHEDIR/conf/extra/mod-fastcgi.conf
$APACHEDIR/bin/apachectl restart
