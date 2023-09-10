<?php

function trace(...$response)
{
    if (env('APP_ENV') == 'local') {
        date_default_timezone_set('UTC');
        $nowtime = date('d/m/Y H:i:s', time());
        file_put_contents('log.txt', $nowtime . "\n", FILE_APPEND | LOCK_EX);
        file_put_contents('log.txt', "LOG ", FILE_APPEND | LOCK_EX);
        file_put_contents('log.txt', print_r($response, true), FILE_APPEND | LOCK_EX);
        file_put_contents('log.txt', "\n", FILE_APPEND | LOCK_EX);
    }
}
