#!/bin/sh
PATH=/usr/local/php/bin:/opt/someApp/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
cd /home/wwwroot/xinhui/
for((i=0;i<=60;i=(i+30)));do
    php think cqssc && php think car && php think xyft && php think jsks && php think gdsyxw && php think pcdd && php think msssc && php think mssc && php think xglhc && php think xync
    sleep 30
done
