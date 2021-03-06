
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
#php /var/www/html/tasks/cleanup-127s.php
#php /var/www/html/tasks/cache-daily-average-for-week-as-Json.php
php /var/www/html/tasks/cache-multi-line-graph.php
#php /var/www/html/tasks/cache-remote-json.php
php /var/www/html/tasks/cache-station-mslp-airtemp.php
#php /var/www/html/tasks/cache-table-data.php
#php /var/www/html/tasks/cache-weekly-data-as-Json.php
php /var/www/html/tasks/cache-windrose-data.php
php /var/www/html/tasks/cache-windrose-frequency-json.php
php /var/www/html/tasks/cache-zambretti-prediction.php
php /var/www/html/tasks/cache-rainfall-json.php
php /var/www/html/tasks/cache-wind-speed-json.php
php /var/www/html/tasks/cache-windrose-gust-frequency-json.php
#php /var/www/html/tasks/cache-live-latest-readings-json.php
php /var/www/html/tasks/cache-recent-station-date-json.php
php /var/www/html/tasks/cache-recent-soil-data-json.php
php /var/www/html/tasks/meteogram-json.php
php /var/www/html/tasks/cache-linked-graph-data.php
