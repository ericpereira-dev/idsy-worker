<?php

namespace idsy\worker\dao;

use idsy\worker\core\Config;

class Log
{
    public static function set($message)
    {
        $fp = fopen(Config::storagePath() . 'logs/call.txt', "a+");
        fwrite($fp, date('d/m/Y H:i:s'));
        fwrite($fp, 'Result: ' . $message);
        fwrite($fp, "\n");
        fwrite($fp, '-----------------------------------');
        fwrite($fp, "\n");
        fclose($fp);
    }
}