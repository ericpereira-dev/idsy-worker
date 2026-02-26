<?php // versão 01;   
namespace Idsy\Client\Services\Financeiro;

use Idsy\Client\Http\Request;

class PixSincronizar
{
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->toClear();
    }

    public function toClear(): void
    {
        $this->request->toClear();
    }

    public function post(string $authenticationData): void
    {   
        $this->request->setController('FINANCEIRO_PIX_SINCRONIZAR');
        $this->request->setPublicDataType('json');
        $this->request->setAuthenticationDataType('text');  
        $this->request->setAuthenticationData($authenticationData);        
        $this->request->setPrivateDataType('json');  
        $this->request->post();        
    }
}
