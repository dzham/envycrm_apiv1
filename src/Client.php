<?php

namespace Dzham\EnvyCrmApiV1;

use Dzham\EnvyCrmApiV1\Exceptions\ApiException;
use Dzham\EnvyCrmApiV1\Exceptions\SenderException;

class Client
{
    const API_URL = "https://envycrm.com/crm/api/v1";

    /**
     * @var Sender
     */
    protected $sender;

    /**
     * @var $apiKey
     */
    protected $apiKey;


    /**
     * Client constructor.
     * @param null $apiKey
     */
    public function __construct($apiKey = null)
    {
        $this->sender = new Sender();

        if($apiKey){
            $this->setApiKey($apiKey);
        }
    }

    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey){
        $this->apiKey = $apiKey;
    }

    /**
     * Информация о CRM
     * @return mixed
     * @throws ApiException
     */
    public function getCrmData(){

        $senderMethod = "GET";
        $apiMethod = "/main/data";

        $result = $this->execute($senderMethod, $apiMethod);

        return $result;
    }

    /**
     * Создание заявки
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function createLead($data){

        if(!is_array($data) || !$data){
            throw new ApiException("Client : Укажите данные для отправки");
        }

        $senderMethod = "POST";
        $apiMethod = "/lead/set";

        $data["method"] = "create";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Получение заявки по ID
     * @param $leadId
     * @return mixed
     * @throws ApiException
     */
    public function getLeadById($leadId){

        if(!$leadId){
            throw new ApiException("Client : Укажите id заявки");
        }

        $senderMethod = "POST";
        $apiMethod = "/lead/get";

        $data = [
            "lead_id" => $leadId
        ];

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Поиск по заявкам
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function leadSearch($data){

        if(!is_array($data) || !$data){
            throw new ApiException("Client : Укажите данные для поиска");
        }

        $senderMethod = "POST";
        $apiMethod = "/lead/search";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Получение списка заявок
     * @param array $data
     * @return mixed
     * @throws ApiException
     */
    public function leadList($data = []){

        $senderMethod = "POST";
        $apiMethod = "/lead/list";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Взятие заявки в работу
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function leadStart($data){

        if(!is_array($data) || !$data){
            throw new ApiException("Client : Укажите данные лида");
        }

        $senderMethod = "POST";
        $apiMethod = "/lead/start";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Обновление поля заявки
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function updateLeadValue($data){
        if(!is_array($data) || !$data || !isset($data['fields']) || !$data['fields']){
            throw new ApiException("Client : Укажите данные для обновления");
        }

        $senderMethod = "POST";
        $apiMethod = "/lead/updateLeadValue";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Получение сделки по ID
     * @param $dealId
     * @return mixed
     * @throws ApiException
     */
    public function getDealById($dealId){

        if(!$dealId){
            throw new ApiException("Client : Укажите id сделки");
        }

        $senderMethod = "POST";
        $apiMethod = "/deal/get";

        $data = [
            "deal_id" => $dealId
        ];

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Поиск по сделкам
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function dealSearch($data){

        if(!is_array($data) || !$data){
            throw new ApiException("Client : Укажите данные для поиска");
        }

        $senderMethod = "POST";
        $apiMethod = "/deal/search";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Обновление этапа сделки
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function updateDealStage($data){

        if(!is_array($data) || !$data){
            throw new ApiException("Client : Укажите данные для обновления");
        }

        $senderMethod = "POST";
        $apiMethod = "/deal/updateDealStage";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Получение списка сделок
     * @param array $data
     * @return mixed
     * @throws ApiException
     */
    public function dealList($data = []){

        $senderMethod = "POST";
        $apiMethod = "/deal/list";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Обновление поля сделки
     * @param $data
     * @return mixed
     * @throws ApiException
     */
    public function updateDealValue($data){

        if(!is_array($data) || !$data || !isset($data['fields']) || !$data['fields']){
            throw new ApiException("Client : Укажите данные для обновления");
        }

        $senderMethod = "POST";
        $apiMethod = "/deal/updateDealValue";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * Получение списка клиентов
     * @param array $data
     * @return mixed
     * @throws ApiException
     */
    public function clientList($data = []){

        $senderMethod = "POST";
        $apiMethod = "/client/list";

        $result = $this->execute($senderMethod, $apiMethod, $data);

        return $result;
    }

    /**
     * @param $senderMethod
     * @param $apiMethod
     * @param array $params
     * @return mixed
     * @throws ApiException
     */
    private function execute($senderMethod, $apiMethod, $params = []){

        if(!$this->apiKey){
            throw new ApiException("Client : Не указан ключ API");
        }

        $url = self::API_URL . $apiMethod . "?api_key={$this->apiKey}";

        //изменяем под формат CRM
        if($senderMethod == 'POST'){
            $params = [
                "request" => $params
            ];
            $params = json_encode($params);
        }

        $this->sender
            ->setUrl($url)
            ->setType($senderMethod)
            ->setParams($params);

        try{
            $result = $this->sender->send();
        }catch (SenderException $e){
            throw new ApiException($e->getMessage());
        }

        if($result['data'] ){
            $result['data'] = json_decode($result['data'], true);
        }

        if($result['http_code'] != 200){
            throw new ApiException($result['data']['message']);
        }else{
            unset($result['data']['status_code']);
            unset($result['data']['message']);
            $result = $result['data'];
        }

        return $result;
    }


}