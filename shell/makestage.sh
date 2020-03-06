#!/bin/sh
PATH=/usr/local/php/bin:/opt/someApp/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
cd /home/wwwroot/xinhui/
php think cqsscstage && php think carstage && php think xyftstage && php think jsksstage && php think gdsyxwstage && php think pcddstage && php think mssscstage && php think msscstage && php think xyncstage

