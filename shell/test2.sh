#!/bin/sh
PATH=/usr/local/php/bin:/opt/someApp/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
cd /home/wwwroot/default/yicai/
for((i=0;i<=60;i=(i+30)));do
    php think fast && php think gd11 && php cq10
    sleep 30
done
