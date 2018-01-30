#usage
#./fastcgiConfigure.sh /root/src/mod_fastcgi-master /opt/apache24
#!/bin/bash

FCGIFOLDER=$1
APACHEDIR=$2

cd $FCGIFOLDER
cp Makefile.AP2 Makefile
make top_dir=$APACHEDIR
make install
