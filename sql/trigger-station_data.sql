USE `Weather`; 
DROP Trigger IF EXISTS `calc_pressure_trend`;
DELIMITER $$
CREATE
    TRIGGER  `calc_pressure_trend` BEFORE INSERT
    ON `station_data`
    FOR EACH ROW BEGIN
    declare pressure_trend_val double;
        -- trigger body
    SELECT round(sum(trend.diff) ,1) as trend
    from (
        SELECT x.barom_mb as X, y.barom_mb as Y,
             x.barom_mb - y.barom_mb diff
          FROM station_data x 
          JOIN station_data y 
            ON y.id < x.id
        WHERE y.dateutc >= now() - INTERVAL 3 HOUR 
        GROUP BY y.id) 
            as trend into pressure_trend_val;
    
        SET new.pressure_trend = pressure_trend_val;

    END $$
DELIMITER ;
