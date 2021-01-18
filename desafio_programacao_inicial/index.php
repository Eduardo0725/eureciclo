<?php
require_once __DIR__ . '/vendor/autoload.php';

$gallonManager = new App\GallonManagement;

while (true) {
    $gallon = readline("Insira o volume do galão: "); 
    $numbersOfbottles = readline("Quantidade de garrafas: "); 
    $bottles = [];
    
    for ($i = 1; $i <= $numbersOfbottles; $i++) {
        $volume = readline("Garrafa $i: ");
        array_push($bottles, $volume);
    }
    
    echo PHP_EOL;
    echo $gallonManager->fill($gallon, $bottles);
    echo PHP_EOL . PHP_EOL;

    $wantToContinue = readline("Quer continuar? ([S]im/[n]ão) ");
    
    if ($wantToContinue)
        $wantToContinue = mb_strtolower($wantToContinue);
    
    if ($wantToContinue == 'n' || $wantToContinue == 'não')
        die();
}
