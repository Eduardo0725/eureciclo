<?php

namespace App;

class GallonManagement
{
    public function calculate($gallon, $bottles, array $rejected = [])
    {
        $volumeOfBottles = [];

        foreach ($bottles as $key => $quantity)
            // Se o galão não for maior que 0 (zero) ou se a garrafa estiver na lista de rejeitados, então vai pular essa etapa.
            // Vai subtraír o galão com a quantidade selecionada, vai adicionar a quantidade subtraída do galão na variável '$volumeOfBottles'.
            if ($gallon > 0 && array_search($key, $rejected) === false) {
                $gallon = number_format($gallon - $quantity, 2);
                array_push($volumeOfBottles, $quantity);
            }

        return [
            'leftOver' => $gallon,
            'volumeOfBottles' => $volumeOfBottles
        ]; 
    }

    public function fill($gallon, $bottles)
    {
        // Faz a primeira tentativa com os primeiros valores.
        $content = $this->calculate($gallon, $bottles);
        
        $numberOfBottles = count($bottles);

        // Se sobrar alguma quantidade, então faz mais tentativas rejeitando uma garrafa a cada processo.
        if (!$content['leftOver'] == 0)
            for ($i = 0; $i < $numberOfBottles; $i++) {
                $result = $this->calculate($gallon, $bottles, [$i]);
                
                // A sobra que tive mais perto de 0 (zero), vai ser colocado na variavel '$content'.
                if ($result['leftOver'] <= 0 && $result['leftOver'] > $content['leftOver']) 
                    $content = $result;

                // Se não houver sobra, então vai quebrar o loop.
                if ($result['leftOver'] == 0) 
                    break;
            }

        // Se sobrar alguma quantidade, então faz mais tentativas rejeitando duas garrafas a cada processo.
        if (!$result['leftOver'] == 0)
            for ($iFirst = 0; $iFirst < $numberOfBottles; $iFirst++)
                for ($iSecond = 0; $iSecond < $numberOfBottles; $iSecond++) {
                    $result = $this->calculate($gallon, $bottles, [$iFirst, $iSecond]);

                    if ($result['leftOver'] <= 0 && $result['leftOver'] > $content['leftOver']) 
                        $content = $result;

                    if ($result['leftOver'] == 0) 
                        break;
                }

        $strVolumeOfBottles = implode('L, ', $content['volumeOfBottles']) . 'L';
        $leftOver = abs($content['leftOver']) . 'L';

        return "Resposta: [$strVolumeOfBottles], sobra $leftOver;";
    }
}
