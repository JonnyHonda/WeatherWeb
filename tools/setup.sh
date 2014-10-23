#!/bin/sh 
# Entries need in cron tab

#0,30 * * * *  php /var/www/html/tasks/cache-table-data.php
#0 * * * *     php /var/www/html/tasks/cache-weekly-data-as-Json.php
#0 9 * * *     php /var/www/html/tasks/cache-zambretti-prediction.php
#0,30 * * * *  php /var/www/html/tasks/cache-line-graph.php
#0,30 * * * *  php /var/www/html/tasks/cache-multi-line-graph.php
#0,30 * * * *  php /var/www/html/tasks/cache-daily-average-for-week-as-Json.php
#0,30 * * * *  php /var/www/html/tasks/cache-windrose-data.php

#Execute each script to update cache files
php /var/www/html/tasks/cache-table-data.php
php /var/www/html/tasks/cache-weekly-data-as-Json.php
php /var/www/html/tasks/cache-zambretti-prediction.php
php /var/www/html/tasks/cache-line-graph.php
php /var/www/html/tasks/cache-multi-line-graph.php
php /var/www/html/tasks/cache-daily-average-for-week-as-Json.php
php /var/www/html/tasks/cache-windrose-data.php
php /var/www/html/tasks/cache-station-mslp-airtemp.php
