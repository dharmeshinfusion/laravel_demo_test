<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class HomeController extends Controller
{
    /**
     *  * Create a new controller instance.
     *  *
     *  * @return void
     *  */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * * Show the application dashboard.
     * *
     * * @return \Illuminate\Contracts\Support\Renderable
     * */


    /* ----------------------------------------------------------------------------------
    @Description: Function for List Of Product
    ---------------------------------------------------------------------------------- */
    public function index()
    {
        $product = Product::get();
        return view('home', compact('product'));
    }
}
