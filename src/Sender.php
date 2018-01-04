<?php

namespace Dzham\EnvyCrmApiV1;

use Dzham\EnvyCrmApiV1\Exceptions\SenderException;

class Sender
{
    protected $url;
    protected $type;
    protected $params;
    protected $result;

    /**
     * @param mixed $url
     * @return Sender
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param mixed $type
     * @return Sender
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param mixed $params
     * @return Sender
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param mixed $result
     * @return Sender
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }


    /**
     * @return mixed
     * @throws SenderException
     */
    public function send(){
        if(!$this->url){
            throw new SenderException('Sender: Не указан url');
        }
        if (!in_array($this->type, ['GET', 'POST', 'PUT', 'DELETE'])) {
            $this->setType('GET');
        }

        $options = [
            CURLOPT_URL            => $this->url,
            CURLOPT_CUSTOMREQUEST  => $this->type,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ];
        $ch = curl_init();
        if ($this->type == 'GET') {
            $options[CURLOPT_URL] = $this->url;
            if ($this->params) {
                $options[CURLOPT_URL].='?' . http_build_query($this->params);
            }
        } else {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = (is_array($this->params)) ? http_build_query($this->params) : $this->params;
        }

        curl_setopt_array($ch, $options);
        $res= curl_exec($ch);
        $info = curl_getinfo($ch);
        $this->setResult([
            'http_code' => $info['http_code'],
            'data' => $res
        ]);

        return $this->result;
    }
}