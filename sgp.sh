#! /bin/sh
IN=`/sbin/ifconfig eth0 |grep bytes|cut -d":" -f2|cut -d" " -f1`
OUT=`/sbin/ifconfig eth0 |grep bytes|cut -d":" -f3|cut -d" " -f1`
LOAD=`temp=$(cat /proc/loadavg) && echo ${temp%% *}`

DATE=`date +%m%d%H%M%S`
touch /var/www/sgp/data/net/$DATE.$IN.$OUT
touch /var/www/sgp/data/load/$DATE.$LOAD

find /var/www/sgp/data/net/ -mmin +720 -type f -print0 | xargs -0 -n 100 rm -f
find /var/www/sgp/data/load/ -mmin +720 -type f -print0 | xargs -0 -n 100 rm -f
