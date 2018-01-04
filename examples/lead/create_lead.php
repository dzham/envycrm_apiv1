<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$leadData = [
    "department_id" => 590,
    "inbox_type_id" => 4478,
    "values" => [
        "name" => "Тестовый лид2",
        "email" => "test@test2.com",
        "phone" => "79278888888",
    ]
];
try{
    var_dump($client->createLead($leadData));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}