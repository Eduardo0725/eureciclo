<?php
use App\Controllers as C;

$getPagePath = function($name) {
    return __DIR__ . "/app/pages/$name.php";
};

$uri = $_SERVER['REQUEST_URI'];

if (preg_match('/\?/', $uri))
    $uri = preg_replace('/\?.*/i', '', $uri);

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' || $method === 'HEAD') 
    switch ($uri) {
        case '/':
        case '/index.php':
            require $getPagePath('home');
            break;
        
        case (preg_match('/table\/*/', $uri) ? true : false):
            require $getPagePath('table');
            break;

        default:
            echo '<h1>404 Not Found</h1>';
            echo '<a href="/">Página inicial</a>';
            break;
    }
//

if ($method === 'POST') 
    switch ($uri) {
        case '/save':
            (new C\Storage)->save();
            break;

        case '/download':
            (new C\Storage)->download();
            break;

        default:
            header("Location:/");
            break;
    }
//