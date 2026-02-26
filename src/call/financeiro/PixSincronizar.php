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

use Idsy\Worker\Config;

use Idsy\Client\Services\Financeiro\PixSincronizar;

use Idsy\Client\Services\Control\Login; 

use Idsy\Tools\Create;

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

    Create::Log(Config::storagePath(), 'Call', 'PixSincronizar');
    Create::Log(Config::storagePath(), 'Call', 'Acesso para BaixarPix(Login)');    
    Create::Log(Config::storagePath(), 'Call', 'Chave: ' . $chave);        

    $call = new PixSincronizar();
    $call->request->setURL(Config::url());
    $call->post($chave);

    Create::Log(Config::storagePath(), 'Call', 'Acesso para PixSincronizar(FINANCEIRO_PIX_SINCRONIZAR)');
    Create::Log(Config::storagePath(), 'Call', 'ResultCode: ' . $call->request->getResultCode());    
    Create::Log(Config::storagePath(), 'Call', 'Result: ' . $call->request->getResult());        

} catch (Throwable $e) {
    Create::Log(Config::storagePath(), 'error', 'Exception: ' . $e->getMessage());
    Create::Log(Config::storagePath(), 'error', 'Exception File: ' . $e->getFile());    
    Create::Log(Config::storagePath(), 'error', 'Exception Line: ' . $e->getLine());
}    