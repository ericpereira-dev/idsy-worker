<?php // versão 01;   
namespace idsy\client\http;

use idsy\client\model\http\Request as RequestModel;

class Request extends RequestModel
{
    // public RequestModel $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function toClear(): void
    {
        parent::toClear();
    }

    private function getHearders(): array
    {
        $headers = [
            'Accept: application/json',
            'controller: ' . parent::getController(),
            'public-data-type: ' . parent::getPublicDataType(),
            'private-data-type: ' . parent::getPrivateDataType(),
            'authentication-data-type: ' . parent::getAuthenticationDataType(),
            'authentication-data: ' . parent::getAuthenticationData(),
            'device: ' . parent::getDevice()
        ];
        return $headers;
    }

    public function post(): void
    {       
        $headers = $this->getHearders();
        $body = parent::getPrivateData();
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => parent::getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => array_merge($headers, [
                'Connection: close'
            ]),            
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_FORBID_REUSE   => true,
            CURLOPT_FRESH_CONNECT  => true            
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception($error);
        }        

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);        

        parent::setResult($response);
        parent::setResultCode($httpCode);        

        curl_reset($ch);
        curl_close($ch);        
    }

    public function get(): void
    {
        $headers = $this->getHearders();

        if (parent::getPublicData() != '') {
            $get = '?' . parent::getPublicData();
        } else {
            $get = '';
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => parent::getUrl() . $get,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array_merge($headers, [
                'Connection: close'
            ]),            
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_FORBID_REUSE   => true,
            CURLOPT_FRESH_CONNECT  => true
        ]);

        foreach ($headers as $h) {
            if (preg_match("/:\s*$/", $h)) {
                throw new \Exception("Header inválido: [$h]");
            }
        }        

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);        

        if ($error !== '') {
            throw new \Exception($error);
        }        

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }

        parent::setResult($response);
        parent::setResultCode($httpCode);        

        curl_reset($ch);
    }
}
