<?php

include_once "../vendor/autoload.php";

use Idsy\Client\Services\Financeiro\PixSincronizar;

use Idsy\Client\Services\Control\login; 

// login
$login = new Login();
$login->request->setURL('http://localhost:8080/idsy-api/public_html/index.php');
$login->setLogin('test');
$login->setPassword('123456');
$login->setTeam('control');
$login->setKey('');
$login->get();

$data = json_decode($login->request->getResult(), true);
$chave = $data['result'];

$call = new PixSincronizar();
$call->request->setURL('http://localhost:8080/idsy-api/public_html/index.php');
$call->post($chave);

echo $chave;
echo nl2br('');
echo nl2br($call->request->getResultCode());
echo nl2br($call->request->getResult());
echo nl2br('');
