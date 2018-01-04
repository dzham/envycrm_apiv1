<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$data = [
    "deal_id" => 700778,
    "client_id" => 1148075,
    "stage_id" => 53564, //53564,53561
];

try{
    var_dump($client->updateDealStage($data));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}