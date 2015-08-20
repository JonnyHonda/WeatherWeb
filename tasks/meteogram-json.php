<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$meteogram = array(
    'location' => array(
        'name' => 'Scampton',
        'type' => 'Town',
        'country' => "United Kingdom",
        'timezone' => array(
            '@attributes' => array(
                'id' => "Europe/London",
                'utcoffsetMinutes' => "0"
            )
        ),
        'location' => array(
            '@attributes' => array(
                'altitude' => "",
                'latitude' => "",
                'longitude' => "",
                'geobase' => "geonames",
                'geobaseid' => "2643743"
            )
        )
    ),
    'credit' => array(
        'comment' => array("", ""),
        'link' => array(
            "@attributes" => array(
                "text" => "Weather forecast from yr.no, delivered by the Norwegian Meteorological Institute and the NRK",
                "url" => "http://www.yr.no/place/United_Kingdom/England/London/"
            )
        )
    ),
    'links' => array(
        'link' => array(
            array(
                '@attributes' => array(
                    'id' => "xmlSource",
                    'url' => "http://www.yr.no/place/United_Kingdom/England/London/forecast.xml"
                )
            ),
            array(
                '@attributes' => array(
                    'id' => "xmlSourceHourByHour",
                    'url' => "http://www.yr.no/place/United_Kingdom/England/London/forecast_hour_by_hour.xml"
                )
            ),
            array('@attributes' => array(
                    'id' => "hourByHour",
                    'url' => "http://www.yr.no/place/United_Kingdom/England/London/hour_by_hour"
                )
            ),
            array('@attributes' => array(
                    'id' => "overview",
                    'url' => "http://www.yr.no/place/United_Kingdom/England/London/"
                )
            ),
            array('@attributes' => array(
                    'id' => "longTermForecast",
                    'url' => "http://www.yr.no/place/United_Kingdom/England/London/long"
                )
            )
        )
    ),
    'meta' => array(
        'lastupdate' => "",
        'nextupdate' => ""
    ),
    'sun' => array(
        "@attributes" => array(
            'rise' => "",
            'set' => ""
        )
    ),
    'forecast' =>
    array('tabular' => array(
            'time' => array()
        )
    )
);


date_default_timezone_set(TZ);
if (date('I')) {
    $meteogram['location']['timezone']['@attributes']['utcoffsetMinutes'] = "60";
}
$meteogram['meta']['lastupdate'] = Date("Y-m-d\TH:m:s");
$meteogram['meta']['nextupdate'] = Date("Y-m-d\TH:m:s");
$meteogram['meta']['datemark'] = Date("d/m/Y H:m:s");
$meteogram['sun']['@attributes']['rise'] = Date("Y-m-d") . "T" . date_sunrise(time(), SUNFUNCS_RET_STRING, LAT, LONG, 90 + (60 / 60), 0);
$meteogram['sun']['@attributes']['set'] = Date("Y-m-d") . "T" . date_sunset(time(), SUNFUNCS_RET_STRING, LAT, LONG, 90, 0);
$meteogram['location']['location']['@attributes']['altitude'] = ALTITUDE;
$meteogram['location']['location']['@attributes']['latitude'] = LAT;
$meteogram['location']['location']['@attributes']['longitude'] = LONG;
//die($meteogram['location']['timezone'] ['@attributes']);
$meteogram['location']['timezone'] ['@attributes']['id'] = TZ;

$link = mysql_connect(SERVER, USER, PASSWORD);

$db_found = mysql_select_db(DATABASE);

$sql = "SELECT * FROM Weather.meteogram "
        . "WHERE `from` >= now() - INTERVAL 49 HOUR GROUP BY DATE_FORMAT(`from`, \"%d-%m-%y %H:00\");";


$query = mysql_query($sql);

$tabularContent = "";

$time = array(
    ['@attributes'] => array(
        ['from'] => "0",
        ['to'] => "0"
    ),
    ['comment'] => array(
        
    ),
    ['symbol'] => array(
        ['@attributes'] => array(
            ['number'] => "2",
            ['numberEx'] => "02",
            ['name'] => "Fair",
            ['var'] => "02d"
        )
    ),
    ['precipitation'] => array(
        ['@attributes'] => array(
            ['value'] => "0"
        )
    ),
    ['windDirection'] => array(
        ['@attributes'] => array(
            ['deg'] => "0",
            ['code'] => "0",
            ['name'] => "0"
        )
    ),
    ['windSpeed'] => array(
        ['@attributes'] => array(
            ['mps'] => "0",
            ['name'] => ""
        )
    ),
    ['temperature'] => array(
        ['@attributes'] => array(
            ['unit'] => "celcius",
            ['value'] => "0"
        )
    ),
    ['pressure'] => array(
        ['@attributes'] => array(
            ['unit'] => "hPa",
            ['value'] => "0"
        )
    )
);

while ($r = mysql_fetch_array($query)) {
    $time['@attributes']['from'] = $r['from'];
    $time['@attributes']['to'] = $r['to'];
    $time['comment'] = array("", "");
    $time['symbol']['@attributes']['number'] = "";
    $time['symbol']['@attributes']['numberEx'] = "";
    $time['symbol']['@attributes']['name'] = "";
    $time['symbol']['@attributes']['var'] = "";
    $time['precipitation']['@attributes']['value'] = $r['precipitation'];
    $time['windDirection']['@attributes']['deg'] = $r['deg'];
    $time['windDirection']['@attributes']['code'] = $r['code'];
    $time['windDirection']['@attributes']['name'] = $r['name'];
    $time['windSpeed']['@attributes']['mps'] = $r['windSpeed'];
    $time['windSpeed']['@attributes']['name'] = $r['beaufort'];
    $time['temperature']['@attributes']['unit'] = "celcius";
    $time['temperature']['@attributes']['value'] = $r['temperature'];
    $time['pressure']['@attributes']['value'] = $r['pressure'];
    $time['pressure']['@attributes']['unit'] = "hPa";
//    print_r($time);
//    die();
    $meteogram['forecast']['tabular']['time'][] = $time;
}

//print_r($meteogram);
//echo json_encode($meteogram);
file_put_contents('data/cache-meteogram.json', json_encode($meteogram));
mysql_close($link);
