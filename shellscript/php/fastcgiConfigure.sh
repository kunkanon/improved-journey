#usage
#./fastcgiConfigure.sh /root/src/mod_fastcgi-master /opt/apache24
#Download https://github.com/FastCGI-Archives/mod_fastcgi
#!/bin/bash

FCGIFOLDER=$1
APACHEDIR=$2

cd $FCGIFOLDER
cp Makefile.AP2 Makefile
make top_dir=$APACHEDIR
make install
