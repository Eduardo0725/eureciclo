<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Remove one or more TAB (\ t) digits and make it an array.
     * @param string $file
     * @return array
     */
    public function normalize(string $file): array
    {
        return explode("\n", trim(preg_replace("/\t+/", ',', $file)));
    }

    /**
     * Checks whether the extension is valid.
     * @param string $extension
     * @param array $acceptedExtensions
     * @return bool
     */
    private function validateExtensions(string $extension, array $acceptedExtensions = ['txt', 'csv']): bool
    {
        return array_search($extension, $acceptedExtensions) !== false;
    }

    /**
     * Receives an upload, normalizes and stores it in a database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['file' => 'required|file'], [
            'file.required' => 'O campo do arquivo é obrigatório.'
        ]);

        try {
            if(!$this->validateExtensions($request->file('file')->getClientOriginalExtension()))
                throw new Exception("O tipo do arquivo não é válido.");

            $file = $this->normalize($request->file('file')->get());

            foreach ($file as $key => $str) {
                $entry = str_getcsv($str);

                if (
                    $entry === false ||
                    $key === 0 ||
                    array_search(null, $entry) !== false ||
                    count($entry) !== 6
                ) continue;

                $arrSales[] = [
                    'buyer' => $entry[0],
                    'description' => $entry[1],
                    'price_unit' => $entry[2],
                    'lot' => $entry[3],
                    'address' => $entry[4],
                    'vendor' => $entry[5]
                ];
            }

            if (!isset($arrSales))
                throw new Exception('Nenhum dos dados enviados no arquivo foram aceitos.');

            Sale::insert($arrSales);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }

        return redirect()->back();
    }
}
