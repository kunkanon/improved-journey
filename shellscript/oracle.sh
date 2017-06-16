##
# @Author: Ronyan Alves
# @Date: 2016-12-09 16:04
# @Project: Shell Script
#
##


#!/bin/bash
#Oracle ScriptCase 8.1/9
arch=$(uname -m)
basic="oracle_basic.rpm"
devel="oracle_dev.rpm"
ksh="ksh.rpm"
urlBasic="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-basic-12.1.0.2.0-1.i386.rpm"
urlDevel="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-devel-12.1.0.2.0-1.i386.rpm"
filBasic64="oracle-instantclient12.1-basic_12.1.0.2.0-2_amd64.deb"
filDevel64="oracle-instantclient12.1-devel_12.1.0.2.0-2_amd64.deb"
filBasic="oracle-instantclient12.1-basic_12.1.0.2.0-2_i386.deb"
filDevel="oracle-instantclient12.1-basic_12.1.0.2.0-2_i386.deb"
urlKsh="ftp://195.220.108.108/linux/centos/6.8/os/i386/Packages/ksh-20120801-33.el6.i686.rpm"
releases=("/etc/debian_version" "/etc/SuSE-release" "/etc/mandrake-release" "/etc/fedora-release" "/etc/redhat-release" "/etc/gentoo-release" "/etc/slackware-version" "/etc/arch-release")
for i in ${releases[*]}
    do if [ -f $i ] ;
     then pkg=$(echo $i | sed 's/\/etc\///1;s/_version//1;s/-release//1')
        if [ $pkg = "redhat" ] ;
          then os=$pkg
        elif [ $pkg = "debian" ] ;
          then os=$pkg
	elif [ $pkg = "SuSE" ] ;
	  then os=$pkg
        fi
       fi
done
sudo wget $urlBasic -O $basic
sudo wget $urlDevel -O $devel
if [ $os = "redhat" ] ; then
   sudo yum update -y
   sudo yum install -y libaio-devel.i686 libaio.i686 glibc.i686 compat-libstdc++-33.i686 glibc-devel.i686 libstdc++.i686 libstdc++.i686 pam.i686 ncurses-devel.i686 unixODBC.i686
   sudo wget $urlKsh -O $ksh
   sudo yum install -y $ksh
   sudo yum install -y $basic
   sudo yum install -y $devel
   sudo rm $ksh
elif [ $os = "debian" ] ; then
  if echo $arch | grep '64' ; then
    sudo dpkg --add-architecture i386
    sudo apt-get update -y
    sudo apt-get install -y libaio1:i386 libncurses5:i386 alien gcc-multilib g++-multilib libpam0g:i386 ksh:i386 unixodbc-dev:i386 unixodbc:i386
    echo "Performing installation process..."
    echo "Wait.."
    sudo alien --target=amd64 $basic
    sudo alien --target=amd64 $devel
    sudo dpkg -i $filBasic64
    sudo dpkg -i $filDevel64
    sudo rm $filBasic64
    sudo rm $filDevel64
  else
    sudo apt-get update -y
    sudo apt-get install -y libaio1 libncurses5 alien gcc-multilib g++-multilib libpam0g ksh unixodbc-dev unixodbc
    sudo alien $basic
    sudo alien $devel
    sudo dpkg -i $filBasic
    sudo dpkg -i $filDevel
    sudo rm $filBasic
    sudo rm $filDevel
  fi
elif [ $os = "SuSE" ] ; then
    sudo zypper --no-gpg-checks -non-interactive up
   if echo $arch | grep '64' ; then
     sudo zypper --no-gpg-checks -non-interactive in libaio-devel.i686 libaio.i686 glibc.i686 compat-libstdc++-33.i686 glibc-devel.i686 libstdc++.i686 libstdc++.i686 pam.i686 ncurses-devel.i686 unixODBC.i686
   else
      sudo zypper --no-gpg-checks -non-interactive in libaio-devel libaio glibc compat-libstdc++-33 glibc-devel libstdc++ libstdc++ pam ncurses-devel unixODBC
  fi
  sudo zypper --no-gpg-checks -non-interactive in $basic
  sudo zypper --no-gpg-checks -non-interactive in $devel
else
  echo "Your Linux distribution isn't supported"
fi
sudo rm $basic
sudo rm $devel
sudo /etc/init.d/apachesc81 restart
sudo /etc/init.d/apachesc9 restart
