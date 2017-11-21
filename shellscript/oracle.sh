##
# @Author: Ronyan Alves
# @Date: 2016-12-09 16:04
# @Project: Shell Script
#
##
#!/bin/bash
#Oracle ScriptCase 8.1/9
scVersion=$1
arch=$(uname -m)
basic="oracle_basic.rpm"
devel="oracle_dev.rpm"
ksh="ksh.rpm"
urlBasic="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-basic-12.1.0.2.0-1.i386.rpm"
urlDevel="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-devel-12.1.0.2.0-1.i386.rpm"
urlBasic64="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-basic-12.1.0.2.0-1.amd64.rpm"
urlDevel64="http://cdn1.netmake.com.br/download/Conexao/Oracle/Linux/oracle-instantclient12.1-devel-12.1.0.2.0-1.amd64.rpm"
filBasic64="oracle-instantclient12.1-basic_12.1.0.2.0-2_amd64.deb"
filDevel64="oracle-instantclient12.1-devel_12.1.0.2.0-2_amd64.deb"
filBasic="oracle-instantclient12.1-basic_12.1.0.2.0-2_i386.deb"
filDevel="oracle-instantclient12.1-basic_12.1.0.2.0-2_i386.deb"
urlKsh="ftp://195.220.108.108/linux/centos/6.8/os/i386/Packages/ksh-20120801-33.el6.i686.rpm"
urlKsh64="ftp://195.220.108.108/linux/centos/6.8/os/i386/Packages/ksh-20120801-33.el6.rpm"
releases=("/etc/debian_version" "/etc/SuSE-release" "/etc/mandrake-release" "/etc/fedora-release" "/etc/redhat-release" "/etc/gentoo-release" "/etc/slackware-version" "/etc/arch-release")
if [ -z "$1" ] ; then
  echo "Please choose an ScriptCase version [ 8.1 | 9.0 ]"
  exit 1
fi
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
if echo $arch | grep '64' ; then
	if [ $scVersion = "8.1" ]; then
		wget $urlBasic -O $basic
		wget $urlDevel -O $devel
	else
		wget $urlBasic64 -O $basic
		wget $urlDevel64 -O $devel
	fi
elif
	wget $urlBasic -O $basic
	wget $urlDevel -O $devel
fi
if [ $os = "redhat" ] ; then
   yum update -y
   if echo $arch | grep '64' ; then
   	if [ $scVersion = "8.1" ]; then
		yum install -y libaio-devel.i686 libaio.i686 glibc.i686 compat-libstdc++-33.i686 glibc-devel.i686 libstdc++.i686 libstdc++.i686 pam.i686 ncurses-devel.i686 unixODBC.i686
		wget $urlKsh -O $ksh
	else
		yum install -y libaio-devel libaio glibc compat-libstdc++-33 glibc-devel libstdc++ libstdc++ pam ncurses-devel unixODBC
		wget $urlKsh64 -O $ksh
	fi
   else
   	yum install -y libaio-devel.i686 libaio.i686 glibc.i686 compat-libstdc++-33.i686 glibc-devel.i686 libstdc++.i686 libstdc++.i686 pam.i686 ncurses-devel.i686 unixODBC.i686
	wget $urlKsh64 -O $ksh
   fi
   yum install -y $ksh
   yum install -y $basic
   yum install -y $devel
   rm $ksh
elif [ $os = "debian" ] ; then
  if echo $arch | grep '64' ; then
	  if [ $scVersion = "8.1" ]; then
	    dpkg --add-architecture i386
	    apt-get update -y
	    apt-get install -y libaio1:i386 libncurses5:i386 alien gcc-multilib g++-multilib libpam0g:i386 ksh:i386 unixodbc-dev:i386 unixodbc:i386
	    echo "Performing installation process..."
	    echo "Wait.."
	    alien --target=amd64 $basic
	    alien --target=amd64 $devel
	    dpkg -i $filBasic64
	    dpkg -i $filDevel64
	    rm $filBasic64
	    rm $filDevel64
	  else 
	    apt-get update -y
	    apt-get install -y libaio1 libncurses5 alien gcc-multilib g++-multilib libpam0g ksh unixodbc-dev unixodbc
	    alien $basic
	    alien $devel
	    dpkg -i $filBasic64
	    dpkg -i $filDevel64
	    rm $filBasic64
	    rm $filDevel64
	  fi
  else
    apt-get update -y
    apt-get install -y libaio1 libncurses5 alien gcc-multilib g++-multilib libpam0g ksh unixodbc-dev unixodbc
    alien $basic
    alien $devel
    dpkg -i $filBasic
    dpkg -i $filDevel
    rm $filBasic
    rm $filDevel
  fi
elif [ $os = "SuSE" ] ; then
    zypper --no-gpg-checks -non-interactive up
   if echo $arch | grep '64' ; then
   	if [ $scVersion = "8.1" ]; then
		zypper --no-gpg-checks -non-interactive in libaio-devel.i686 libaio.i686 glibc.i686 compat-libstdc++-33.i686 glibc-devel.i686 libstdc++.i686 libstdc++.i686 pam.i686 ncurses-devel.i686 unixODBC.i686
	elif
		zypper --no-gpg-checks -non-interactive in libaio-devel libaio glibc compat-libstdc++-33 glibc-devel libstdc++ libstdc++ pam ncurses-devel unixODBC
	fi
     
   else
      	zypper --no-gpg-checks -non-interactive in libaio-devel libaio glibc compat-libstdc++-33 glibc-devel libstdc++ libstdc++ pam ncurses-devel unixODBC
  fi
  	zypper --no-gpg-checks -non-interactive in $basic
  	zypper --no-gpg-checks -non-interactive in $devel
else
  echo "Your Linux distribution isn't supported"
fi
if [ $scVersion = "8.1" ]; then
	/etc/init.d/apachesc81 restart
else
	/etc/init.d/apachesc9 restart
fi
rm $basic
rm $devel
