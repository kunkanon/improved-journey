#usage
#./phpConfigure.sh 72 php-7.2.1 /root/src/
##https://github.com/FastCGI-Archives/mod_fastcgi

#!/bin/bash

VERSION=$1
PHPFOLDER=$2
MAINFOLDER=$3

if [ $VERSION = "56" ]; then
 ln -s /usr/include/x86_64-linux-gnu/curl /usr/include
fi

if [ $VERSION = "72" ]; then
cp -rf $MAINFOLDER/mcrypt-1.0.1/ $MAINFOLDER/$PHPFOLDER/ext/mcrypt
GETTXT="t"
else
GETTXT=" "
fi

cd $MAINFOLDER/$PHPFOLDER

./configure \
--prefix=/opt/php$VERSION \
--with-pear \
--with-gettext$GETTXT \
--with-curl \
--enable-sockets \
--with-config-file-path=/opt/php$VERSION/ \
--enable-static \
--enable-cgi \
--disable-maintainer-zts \
--enable-pdo \
--enable-soap \
--with-gd \
--enable-gd-native-ttf \
--with-jpeg-dir=/usr \
--with-png-dir=usr \
--enable-exif \
--enable-calendar \
--with-freetype-dir \
--with-pdo-mysql \
--with-pdo-sqlite=shared \
--with-sqlite3=shared \
--enable-mbstring \
--enable-ftp \
--enable-intl \
--with-zlib \
--enable-pcntl \
--with-enchant \
--with-xsl \
--enable-json \
--enable-xml \
--enable-hash \
--enable-session \
--with-pdo-pgsql \
--with-pgsql \
--with-mysqli \
--enable-zip \
--with-openssl \
--with-mcrypt

make

make install

cp $MAINFOLDER/$PHPFOLDER/php.ini-production /opt/php$VERSION/php.ini

make clean
