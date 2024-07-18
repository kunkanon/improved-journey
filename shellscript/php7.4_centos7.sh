#!/bin/bash

> /etc/yum.repos.d/CentOS-Base.repo

echo '[base]
name=CentOS-$releasever - Base
baseurl=http://vault.centos.org/7.9.2009/os/$basearch/
gpgcheck=1
gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7

[updates]
name=CentOS-$releasever - Updates
baseurl=http://vault.centos.org/7.9.2009/updates/$basearch/
gpgcheck=1
gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7

[extras]
name=CentOS-$releasever - Extras
baseurl=http://vault.centos.org/7.9.2009/extras/$basearch/
gpgcheck=1
gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7

[centosplus]
name=CentOS-$releasever - Plus
baseurl=http://vault.centos.org/7.9.2009/centosplus/$basearch/
gpgcheck=1
enabled=0
gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7' >> /etc/yum.repos.d/CentOS-Base.repo

# Atualizar os pacotes do sistema
sudo yum clean all
sudo yum -y update

# Instalar o repositório EPEL
sudo yum -y install epel-release

# Instalar o repositório Remi
sudo yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm

# Instalar o utilitário yum-utils
sudo yum -y install yum-utils

# Habilitar o repositório Remi para PHP 7.4
sudo yum-config-manager --disable 'remi-php*'
sudo yum-config-manager --enable remi-php74

# Instalar o PHP 7.4 e os módulos necessários
sudo yum -y install php php-cli php-fpm php-bcmath php-bz2 php-calendar php-ctype php-curl php-dom php-exif php-fileinfo php-filter php-ftp php-gd php-gettext php-gmp php-hash php-iconv php-imap php-intl php-json php-ldap php-libxml php-mbstring php-mysqli php-mysqlnd php-odbc php-opcache php-pcre php-pdo php-pdo_dblib php-pdo_firebird php-pgsql php-phar php-posix php-recode php-session php-simplexml php-soap php-sockets php-spl php-sqlite3 php-tokenizer php-wddx php-xml php-xmlreader php-xmlrpc php-xmlwriter php-xsl php-zip php-zlib


# Instalar o Apache
sudo yum -y install httpd mod_php

sudo systemctl enable httpd.service

sudo sed -i -e 's/post_max_size = 8M/post_max_size = 512M/g' /etc/php.ini
sudo sed -i -e 's/;date.timezone =/date.timezone = "America\/Recife"/g' /etc/php.ini
sudo sed -i -e 's/short_open_tag = Off/short_open_tag = On/g' /etc/php.ini
sudo sed -i -e 's/;max_input_vars = 1000/max_input_vars = 15000/g' /etc/php.ini
sudo sed -i -e 's/memory_limit = 128M/memory_limit = 1024M/g' /etc/php.ini
sudo sed -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 512M/g' /etc/php.ini
sudo sed -i -e 's/max_file_uploads = 20/max_file_uploads = 200/g' /etc/php.ini
sudo sed -i -e 's/max_input_time = 60/max_input_time = 600/g' /etc/php.ini
sudo sed -i -e 's/max_execution_time = 30/max_execution_time = 300/g' /etc/php.ini
sudo sed -i -e 's/expose_php = On/expose_php = Off/g' /etc/php.ini

sudo systemctl restart httpd

echo "<?php phpinfo(); ?>" > /var/www/html/info.php

# Verificar a versão do PHP instalada
php -v

echo "Instalação do PHP 7.4 e módulos concluída com sucesso."
