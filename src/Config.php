<?php
    namespace Idsy\Worker;

    class Config
    {
        public static function accessCredentials(): array
        {
            return [
                'user' => 'worker',
                'password' => '123456',
                'team' => 'control'                
            ];
        }

        public static function url(): string
        {
            return 'http://localhost:8080/idsy-api/public_html/index.php';
        }        

        public static function storagePath(): string
        {
            return 'D:/Documents/Desenvolvimento/htdocs dev/idsy-worker/src/storage/';
        }
    }

