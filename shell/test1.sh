#!/bin/sh
PATH=/usr/local/php/bin:/opt/someApp/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
cd /home/wwwroot/default/yicai/
for((i=0;i<=60;i=(i+30)));do
    php think car
    sleep 30
done
/var/spool/cron


#!/bin/bash
cd `dirname $0`
DIRNAME="GameResultsLog/`date +%Y-%m-%d`"
test -d "./$DIRNAME/" || mkdir -p "$DIRNAME"
SERVER="http://154.222.138.157"
step=3
for (( i = 0; i < 60; i=(i+step) )); do 
		RESULT=`curl "$SERVER/admin/car" -s`
		echo -e "`date +%Y-%m-%d\ %H:%M:%S` > $RESULT" >> "./$DIRNAME/`date +%H`_GameResults.log"
	sleep $step
done
exit 0