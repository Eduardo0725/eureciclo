<?php 

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use DateTime;

class Storage 
{
    public function save()
    {
        if (!isset($_FILES['file_csv'])) 
            die('Erro no envio.');
        
        $file = $_FILES['file_csv'];
        $arFilename = explode('.', $file['name']);
        $extension = strtolower(end($arFilename));

        if ($extension !== 'csv')
            die('Tipo de arquivo errado, precisa ser do tipo csv.');

        array_pop($arFilename);
        $filename = implode('.', $arFilename);

        if (move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public/storage/' . $filename . '_' . (new DateTime())->format('Y-m-d-H-i-s') . ".$extension")) {
            header('Location:/');
        } else {
            die('Erro no armazenamento do arquivo.');
        }
    }

    public function download() 
    {
        $selectedLines = $_POST['selectedLines'];

        $filename = 'newfile.csv';
        $file = fopen($filename, 'w');

        foreach($selectedLines as $value)
        fwrite($file, "$value\n");

        fclose($file);

        header("Content-Type: application/" . filetype($filename));
        header("Content-Length: " . filesize($filename));
        header("Content-Disposition: attachment; filename=$filename");

        readfile($filename);
    }
}