<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "email" => "d@d.ru"
];

try{
    var_dump($client->dealSearch($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}