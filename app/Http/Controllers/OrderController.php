<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
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
    @Description: Function for Store Order Table And cart table remove entry
    ---------------------------------------------------------------------------------- */
    public function storeorder(Request $request)
    {
        try {
            $customMessages = [
                'first_name.required'     => 'First Name is Required',
                'last_name.required'      => 'Last Name is Required',
                'address.required'        => 'Address is Required',
                'pincode.required'        => 'Pin Code is Required',
                'country.required'        => 'Country is Required',
            ];
            $validatedData = Validator::make($request->all(), [
                'first_name'         => 'required',
                'last_name'          => 'required',
                'address'            => 'required',
                'pincode'            => 'required',
                'country'            => 'required',
            ], $customMessages);
            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }
            $checkout = Checkout::where('user_id', Auth::user()->id)->get();
            $checkout_list_sum = Checkout::where('user_id', Auth::user()->id)->sum('total_price');
            $invoice_no = random_int(1000, 9999);
            foreach ($checkout as $list) {
                Order::create([
                    'first_name'     => $request->get('first_name'),
                    'invoice_no'     => $invoice_no,
                    'last_name'      => $request->get('last_name'),
                    'address'        => $request->get('address'),
                    'pincode'        => $request->get('pincode'),
                    'country'        => $request->get('country'),
                    'user_id'        => Auth::user()->id,
                    'product_id'     => $list->product_id,
                    'quantity'       => $list->quantity,
                    'name'           => $list->name,
                    'price'          => $list->price,
                    'total_price'    => $list->total_price,
                    'image'          => $list->image,
                    'description'    => $list->description,
                ]);
                $checkout_dele = Checkout::where('id', $list->id)->first();
                $checkout_dele->delete();
            }
            $products = Order::where('invoice_no', $invoice_no)->get();
            $details = [
                'invoice_no' => $invoice_no,
                'product_total' => $checkout_list_sum,
            ];
            Mail::to('admin@gmail.com')->send(new \App\Mail\OrderSummaryMail($details, $products));
            smilify('success', 'Order Successfully Created 🔥 !');
            return redirect()->route('home');
        } catch (Exception $e) {
            smilify('error', 'Order Not Successfully Created 🔥 !');
            return back()->with(['alert-type' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
