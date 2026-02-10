<?php

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR])) {
        file_put_contents(...);
    }
});

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/php-error.log');
error_reporting(E_ALL);

include_once "../../../vendor/autoload.php";

use idsy\worker\core\Config;

use idsy\worker\dao\Log;

use idsy\client\services\financeiro\BaixarPix;

use idsy\client\services\control\Login; 

try {
    // login
    $login = new Login();
    $login->request->setURL(Config::url());
    $login->setLogin(Config::accessCredentials()["user"]);
    $login->setPassword(Config::accessCredentials()["password"]);
    $login->setTeam(Config::accessCredentials()["team"]);
    $login->setKey('');
    $login->get();

    $data = json_decode($login->request->getResult(), true);
    $chave = $data['result'];
    Log::set("Acesso para BaixarPix(Login)");
    Log::set("Chave: " . $chave);

    $call = new BaixarPix();
    $call->request->setURL(Config::url());
    $call->post($chave);

    Log::set("Acesso para BaixarPix(FINANCEIRO_BAIXAR_PIX_API)");
    Log::set("ResultCode: " . $call->request->getResultCode());
    Log::set("Result: " . $call->request->getResult());

} catch (Throwable $e) {
    Log::set("Exception: " . $e->getMessage());
    Log::set("Exception File: " . $e->getFile());
    Log::set("Exception Line: " . $e->getLine());
}    