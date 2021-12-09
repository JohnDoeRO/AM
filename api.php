<?php
function take_json_from_url($api, $city, $units, $appid)
{
    $url = $api.'?q='.$city.'&appid='.$appid.'&units='.$units;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode(utf8_encode($result));
}

header('Content-Type: application/json; charset=utf-8');

if(isset($_GET['city'])){
    $city = $_GET['city'];
    $appid = "{key here}";
    $units = "metric";
    $api = 'https://api.openweathermap.org/data/2.5/weather';
    $call = take_json_from_url($api, $city, $units, $appid);
}
else{
    $call = [
        'cod' => '404',
        'message' => 'Missing city parameter'
    ];
}
echo  json_encode($call);