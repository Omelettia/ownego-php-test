<?php

namespace App\Http\Controllers;

use App\Services\TeaService;
use Illuminate\Http\Request;

class TeaController extends Controller
{
    public function index(TeaService $teaService)
    {
        $data = $teaService->getMenuData();
        
        dd($data); 

        return view('menu.index', $data);
    }
}