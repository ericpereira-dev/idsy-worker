<?php // versão 01;   
namespace idsy\client\model\http;

class Request
{
    private string $url;
    private string $controller;
    private string $device;
    private string $publicData;
    private string $publicDataType;
    private string $privateData;
    private string $privateDataType;
    private string $authenticationData;
    private string $authenticationDataType;
    private string $result;
    private string $resultCode;

    public function toClear(): void
    {
        $this->url                       = '';
        $this->controller                = '';
        $this->device                    = '';
        $this->publicData                = '';
        $this->publicDataType            = '';
        $this->privateData               = '';
        $this->privateDataType           = '';
        $this->authenticationData        = '';
        $this->authenticationDataType    = '';
        $this->result                    = '';
        $this->resultCode                = '';
    }

    public function __construct()
    {
        $this->toClear();
    }

    public function getURL(): string
    {
        return $this->url;
    }

    public function setURL(string $value): void
    {
        $this->url = $value;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $value): void
    {
        $this->controller = $value;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

    public function setDevice(string $value): void
    {
        $this->device = $value;
    }


    public function getPublicData(): string
    {
        return $this->publicData;
    }

    public function setPublicData(string $value): void
    {
        $this->publicData = $value;
    }

    public function getPublicDataType(): string
    {
        return $this->publicDataType;
    }

    public function setPublicDataType(string $value): void
    {
        $this->publicDataType = $value;
    }

    public function getPrivateData(): string
    {
        return $this->privateData;
    }

    public function setPrivateData(string $value): void
    {
        $this->privateData = $value;
    }

    public function getPrivateDataType(): string
    {
        return $this->privateDataType;
    }

    public function setPrivateDataType(string $value): void
    {
        $this->privateDataType = substr($value, 0, 10);
    }

    public function getAuthenticationData(): string
    {
        return $this->authenticationData;
    }

    public function setAuthenticationData(string $value): void
    {
        $this->authenticationData = $value;
    }

    public function getAuthenticationDataType(): string
    {
        return $this->authenticationDataType;
    }

    public function setAuthenticationDataType(string $value): void
    {
        $this->authenticationDataType = $value;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $value): void
    {
        $this->result = $value;
    }

    public function getResultCode(): int
    {
        return $this->resultCode;
    }

    public function setResultCode(int $value): void
    {
        $this->resultCode = $value;
    }
}
