<?php // versão 01;   
namespace idsy\client\services\control;

use idsy\client\http\Request;
use idsy\client\model\control\Login as LoginModel;

class Login extends LoginModel
{
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        parent::toClear();
    }

    public function toClear(): void
    {
        parent::toClear();
        $this->request->toClear();
    }

    public function get(): void
    {        
        $authenticationData = [
            'login' => $this->getLogin(), 
            'password' => $this->getPassword(), 
            'team' => $this->getTeam(),
            'key' => $this->getKey()
        ];   
  
        $this->request->setController('Login');
        $this->request->setPublicDataType('json');
        $this->request->setAuthenticationDataType('json');  
        $this->request->setAuthenticationData(json_encode($authenticationData));
        $this->request->setPrivateDataType('json');  
        $this->request->post();                
    }
}
