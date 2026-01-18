<?php

namespace App\Http\Controllers;

use App\Services\TeaService;
use Illuminate\Http\Request;

class TeaController extends Controller
{
    public function index(Request $request, TeaService $teaService)
    {
        $data = $teaService->getMenuData();
        
        //dd($data); 
        $sort = $request->input('sort');

        $filters = [
            'sort' => $request->input('sort'),
            'toppings' => $request->input('topping') 
            
        ];
    
        $data = $teaService->getMenuData($filters);

        return view('menu.index', $data);
    }
}