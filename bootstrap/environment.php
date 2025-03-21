<?php

use Dotenv\Dotenv;

$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../.env';
    $setEnv = trim(file_get_contents($environmentPath));
    if (file_exists($environmentPath))
    {
        putenv("$setEnv");
        if (getenv('APP_ENV') && file_exists(__DIR__.'/../envs/.' .getenv('APP_ENV') .'.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__.'/../envs/', '.'.getenv('APP_ENV').'.env');
            $dotenv->load();
        }
    }
});