<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "lead_id" => 2185196,
    "fields" => [
        [
            "value_type_id" => 1, //сервисное
            "input_id" => 3, //email
            "value" => "dz@test.ru"
        ]
    ]
];

try{
    var_dump($client->updateLeadValue($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}