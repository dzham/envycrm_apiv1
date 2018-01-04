<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "client_id" => 1148075,
    "deal_id" => 700778,
    "fields" => [
        [
            "value_type_id" => 1, //сервисное
            "input_id" => 2001, //название
            "value" => "Новое название " . date("Y.m.d H:i:s")
        ]
    ]
];

try{
    var_dump($client->updateDealValue($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}