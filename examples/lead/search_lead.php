<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "email" => "test@test2.com"
];

try{
    var_dump($client->leadSearch($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}