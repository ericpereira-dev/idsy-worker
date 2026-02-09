<?php

include_once "../vendor/autoload.php";

use idsy\client\services\financeiro\BaixarPix;

use idsy\client\services\control\login; 

// login
$login = new Login();
$login->request->setURL('http://localhost:8080/idsy-api/public_html/index.php');
// $login->request->setURL('http://localhost:1880/idsy-api/public_html/index.php');
$login->setLogin('worker');
$login->setPassword('123456');
$login->setTeam('control');
$login->setKey('');
$login->get();

$data = json_decode($login->request->getResult(), true);
$chave = $data['result'];

$call = new BaixarPix();
$call->request->setURL('http://localhost:8080/idsy-api/public_html/index.php');
// $call->request->setURL('http://localhost:1880/idsy-api/public_html/index.php');
// $call->post($login->request->getResult());
// $call->post('2c08c376eadc810498a5d289d5cfe721c80d97dcdfd4b5c596e117a65a806491048c28cde5eab606');
$call->post($chave);

echo $chave;
echo nl2br('');
echo nl2br($call->request->getResultCode());
echo nl2br($call->request->getResult());
echo nl2br('');
