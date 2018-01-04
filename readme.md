**Установка**

``composer require dzham/envycrm_api``

**Использование**

```php
$client = new \Dzham\EnvyCrmApiV1\Client("b6215149115fe226f83561a75aa8e6c6b54aa8c1");
try{ 
    $client->getCrmData();
}catch (\Dzham\EnvyCrmApiV1\Exceptions\ApiException $e){
    var_dump($e->getMessage());
}
```

**Методы**

``setApiKey`` - Установка API ключа
 - Заявка
 
 ``getCrmData`` - Получение данных по CRM  
 ``createLead`` - Создание заявки  
 ``getLeadById`` - Получение заявки по ID  
 ``leadSearch`` - Поиск заявки  
 ``leadList`` - Получение списка заявок  
 ``leadStart`` - Взятие заявки в работу  
 ``updateLeadValue`` - Обновление поля заявки  

 - Сделка
 
  ``getDealById`` - Получение сделки по ID  
  ``dealSearch`` - Поиск по сделкам  
  ``updateDealStage`` - Обновление этапа сделки  
  ``dealList`` - Получение списка сделок  
  ``updateDealValue`` - Обновление поля сделки  
 - Клиент
 
 ``clientList`` - Получение списка клиентов
