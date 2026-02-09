<?php

include_once "../vendor/autoload.php";

use idsy\client\services\control\login; 

// login
$login = new Login();
$login->request->setURL('http://localhost:8080/idsy-api/public_html/index.php');
// $login->setLogin('worker');
// $login->setPassword('123456');
$login->setLogin('eric');
$login->setPassword('1234');
$login->setTeam('control');
$login->setKey('3099195');
$login->get();

echo $login->request->getResult();