<?php
require_once __DIR__ . '/vendor/autoload.php';

$gallonManager = new App\GallonManagement;

$bottles = [
    1,
    3, 
    4.5,
    1.5, 
    3.5
];

echo "1: \n";
echo $gallonManager->fill(7, $bottles);
echo PHP_EOL . PHP_EOL;

$bottles = [
    1,
    3, 
    4.5,
    1.5
];

echo "2: \n";
echo $gallonManager->fill(5, $bottles);
echo PHP_EOL . PHP_EOL;

$bottles = [
    4.5, 
    0.4
];

echo "3: \n";
echo $gallonManager->fill(4.9, $bottles);
