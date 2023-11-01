<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class ProductController extends Controller
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
    @Description: Function for Single Product
    ---------------------------------------------------------------------------------- */
    public function single_product($id)
    {
        try {
            $single_product = Product::where('id', $id)->first();
            if (!empty($single_product)) {
                return view('pages/product/single_product', compact('single_product'));
            } else {
                smilify('error', 'Single Page Not Found 🔥 !');
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return back()->with(['alert-type' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
