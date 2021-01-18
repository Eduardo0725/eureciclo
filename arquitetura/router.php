<?php
require_once __DIR__ . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

if (is_file(__DIR__ . '/public' . $uri)){
    $arr = explode('.', $uri);
    $extension = end($arr);

    if ($extension === 'css')
        header("Content-Type: text/css");

    require __DIR__ . '/public' . $uri;
} else {
    if ($uri === '/download') {
        (new App\Controllers\Storage)->download();
    } else {
        require __DIR__ . '/public/index.php';
    }
}
