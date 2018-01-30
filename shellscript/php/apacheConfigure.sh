#usage
#./apacheConfigure.sh /opt/apache24 /opt/apache24/bin/apr /opt/apache24/bin/apr-util /opt/apache24/bin/pcre /root/src/httpd-2.4.29
#!/bin/bash

APACHEDIR=$1
APRDIR=$2
APRUTILDIR=$3
PCREDIR=$4
APACHESRC=$5

cd $APACHESRC

./configure \ 
--prefix=$APACHEDIR \
--enable-cgi \
--enable-so \
--enable-modules=all \
--enable-mime-magic \
--enable-fcgid \
--enable-ldap=ldap \
--enable-mods-shared=all \
--with-apr=$APRDIR \
--with-apr-util=$APRUTILDIR \
--with-pcre=$PCREDIR/bin/pcre-config \
--enable-rewrite \
--enable-ssl \
--with-ssl

make
make install
make clean
