<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class HomeController extends Controller
{
    public function main()
    {
        $sales = !($data = Sale::all())->count() ? false : $data;
        return view('welcome', ['sales' => $sales]);
    }
}
