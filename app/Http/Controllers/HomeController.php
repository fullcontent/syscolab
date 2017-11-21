<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('home');

    }

    public function buscaCodigo(Request $request){


        

        
    }

  
}
