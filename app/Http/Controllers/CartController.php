<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartController extends Controller
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
    @Description: Function for List Of Cart
    ---------------------------------------------------------------------------------- */
    public function checkout(Request $request)
    {
        try {
            $checkout_list = Checkout::where('user_id', Auth::user()->id)->get();
            if (sizeof($checkout_list) > 0) {
                $checkout_list_sum = Checkout::where('user_id', Auth::user()->id)->sum('total_price');
                return view('pages/checkout/checkout_product', compact('checkout_list', 'checkout_list_sum'));
            } else {
                $checkout_list = array();
                $checkout_list_sum = array();
                return view('pages/checkout/checkout_product', compact('checkout_list', 'checkout_list_sum'));
            }
        } catch (Exception $e) {
            return back()->with(['alert-type' => 'danger', 'message' => $e->getMessage()]);
        }
    }


    /* ----------------------------------------------------------------------------------
    @Description: Function for Cart Item Delete
    ---------------------------------------------------------------------------------- */
    public function delete($id)
    {
        try {
            $checkout = Checkout::where('id', $id)->first();
            $checkout->delete();
            smilify('success', 'Cart Item Successfully Deleted 🔥 !');
            return response()->json(['status' => 'success', 'title' => 'Success!!', 'message' => 'Cart Item Successfully Deleted..!']);
        } catch (Exception $e) {
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }


    /* ----------------------------------------------------------------------------------
    @Description: Function for Store Checkout Cart
    ---------------------------------------------------------------------------------- */
    public function store(Request $request)
    {
        try {
            $quantity = $request->get('quantity');
            $total_price = $request->get('quantity') * $request->get('price');
            $checkout = Checkout::where('user_id', Auth::user()->id)
                ->where('product_id', $request->get('id'))
                ->first();
            if ($checkout) {
                $quantity = $checkout->quantity + $request->get('quantity');
                $total_price = $quantity * $checkout->price;
            }
            Checkout::updateOrInsert(
                [
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->get('id'),
                ],
                [
                    'quantity' => $quantity,
                    'name' => $request->get('name'),
                    'price' => $request->get('price'),
                    'total_price' => $total_price,
                    'image' => $request->get('image'),
                    'description' => $request->get('description'),
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );
            smilify('success', 'Item has been add to cart 🔥 !');
            return redirect()->route('home');
        } catch (Exception $e) {
            smilify('error', 'Item has been Not add to cart 🔥 !');
            return back()->with(['alert-type' => 'danger', 'message' => $e->getMessage()]);
        }
    }


    /* ----------------------------------------------------------------------------------
    @Description: Function for Cart Item quantity plus & Minus
    ---------------------------------------------------------------------------------- */
    public function cartitem(Request $request, $id)
    {
        try {
            $checkout = Checkout::where('id', $id)->first();
            if ($checkout) {
                $total_price = $request->get('quantity') * $checkout->price;
                Checkout::where('id', $id)->update([
                    'quantity'     => @$request->get('quantity'),
                    'total_price'  => $total_price,
                ]);
                smilify('success', $request->flage);
                return response()->json(['status' => 'success', 'title' => 'Success!!', 'message' => $request->flage]);
            }
        } catch (Exception $e) {
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}
