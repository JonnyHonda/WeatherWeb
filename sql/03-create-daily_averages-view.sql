CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `mysqladmin`@`%` 
    SQL SECURITY DEFINER
VIEW `daily_averages` AS
    select 
        min(`observations`.`date`) AS `start_date`,
        max(`observations`.`date`) AS `end_date`,
        round(min(`observations`.`air_temp`), 2) AS `min_air_temp`,
        round(max(`observations`.`air_temp`), 2) AS `max_air_temp`,
        round(avg(`observations`.`air_temp`), 2) AS `avg_air_temp`,
        round(min(`observations`.`grass_temp`), 2) AS `min_grass_temp`,
        round(max(`observations`.`grass_temp`), 2) AS `max_grass_temp`,
        round(avg(`observations`.`grass_temp`), 2) AS `avg_grass_temp`,
        round(min(`observations`.`soil_temp_10`), 2) AS `min_soil_temp_10`,
        round(max(`observations`.`soil_temp_10`), 2) AS `max_soil_temp_10`,
        round(avg(`observations`.`soil_temp_10`), 2) AS `avg_soil_temp_10`,
        round(min(`observations`.`soil_temp_30`), 2) AS `min_soil_temp_30`,
        round(max(`observations`.`soil_temp_30`), 2) AS `max_soil_temp_30`,
        round(avg(`observations`.`soil_temp_30`), 2) AS `avg_soil_temp_30`,
        round(min(`observations`.`soil_temp_100`), 2) AS `min_soil_temp_100`,
        round(max(`observations`.`soil_temp_100`), 2) AS `max_soil_temp_100`,
        round(avg(`observations`.`soil_temp_100`), 2) AS `avg_soil_temp_100`
    from
        `observations`
    group by cast((`observations`.`date` - interval 9 hour)
        as date)
