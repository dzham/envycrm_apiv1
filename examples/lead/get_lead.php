<?php

include "../../vendor/autoload.php";
include "../config.php";

$client = new \Dzham\EnvyCrmApiV1\Client($config['api_key']);

$leadId = 2185058;

try{
    var_dump($client->getLeadById($leadId));
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}