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
     * Receives an upload, normalizes and stores it in a database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        try {
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
