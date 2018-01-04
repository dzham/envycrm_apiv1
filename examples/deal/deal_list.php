<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "keyword" => "d@d.ru"
];

try{
    var_dump($client->dealList($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}