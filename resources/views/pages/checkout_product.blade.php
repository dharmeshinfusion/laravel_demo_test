@extends('layouts.app')
@section('content')
    @if (sizeof($checkout_list) > 0)
        <div class="container"
            style="width: 100%;height: 92vh;display: flex;justify-content: space-evenly;align-items: center;background-color: #f9fafc;">
            <div class="payment_details">
                <h1>Payment Information</h1>
                <form action="{{ route('order') }}" method="post">
                    @csrf
                    <div class="details_card">
                        <div class="name_address">
                            <div class="first_lastName">
                                <input type="text" placeholder="First Name" name="first_name" />
                                <input type="text" placeholder="Last Name" name="last_name" />

                            </div>
                            <div class="first_lastName">
                                <span class="help-block">
                                    <font color="red">
                                        {{ $errors->has('first_name') ? '' . $errors->first('first_name') . '' : '' }}
                                    </font>
                                </span>
                                <span class="help-block">
                                    <font color="red">
                                        {{ $errors->has('last_name') ? '' . $errors->first('last_name') . '' : '' }} </font>
                                </span>
                            </div>
                            <div class="address">
                                <input type="text" id="put" placeholder="Address" name="address" />
                                <input type="number" placeholder="Pincode" name="pincode" />
                                <input type="text" placeholder="Country" name="country" />
                            </div>
                            <div class="address">
                                <span class="help-block">
                                    <font color="red">
                                        {{ $errors->has('address') ? '' . $errors->first('address') . '' : '' }} </font>
                                </span>
                                <span class="help-block">
                                    <font color="red">
                                        {{ $errors->has('pincode') ? '' . $errors->first('pincode') . '' : '' }} </font>
                                </span>
                                <span class="help-block">
                                    <font color="red">
                                        {{ $errors->has('country') ? '' . $errors->first('country') . '' : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <div class="proced_payment">
                            <button class="btn btn-danger w-100">Procced to payment</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="order_summary">
                <h1>Order Summary</h1>
                <div class="summary_card">
                    @foreach ($checkout_list as $list)
                        <div class="card_item">
                            <div class="product_img">
                                <img src="{!! url('storage/product/' . @$list->image) !!}" alt="{{ $list->image }}" />
                            </div>
                            <div class="product_info">
                                <h1>{{ $list['name'] }}</h1>
                                <p>{{ Str::words($list['description'], 5, '....') }}</p>
                                <a href="javascript:void(0)" class="close-btn deletecart" data-id={{ $list['id'] }}>
                                    <i class="fa fa-close"></i>
                                </a>
                                {{-- <div class="close-btn">
                                    <i class="fa fa-close"></i>
                                </div> --}}
                                <div class="product_rate_info">
                                    <h1>$ {{ $list['price'] }}</h1>
                                    <span class="pqt">1</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr />
                    <div class="order_total">
                        <p>Total Amount</p>
                        <h4>${{ $checkout_list_sum }}</h4>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container"
            style="width: 100%;height: 92vh;display: flex;justify-content: space-evenly;align-items: center;background-color: #f9fafc;">
            <div class="payment_details">
                <h1></h1>
                <div class="details_card">
                    <div class="proced_payment">
                        <a href="{{ route('home') }}" class="btn btn-danger w-100"
                            style="background-color:#dc3545;color:#FFF">Empty
                            Cart...</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <style>
        h1 {
            font-size: 16px;
            margin: 5px;
        }

        .details_card {
            width: 700px;
            height: 400px;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        .summary_card {
            background-color: #fff;
            width: 350px;
            height: 500px;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 10px;
        }

        .card_item {
            display: flex;
            position: relative;
            margin: 10px 0;
        }

        .close-btn {
            position: absolute;
            right: 10px;
            top: 5px;
        }

        .card_item .product_img img {
            height: 80px;
            margin-right: 20px;
            width: 70px;
            border-radius: 5px;
        }

        .product_info h1 {
            font-size: 20px;
            color: #1e212d;
            margin: 5px 0;
        }

        .product_info p {
            color: #a1a1a1;
            font-size: 14px;
        }

        .product_rate_info {
            display: flex;
            margin: 5px 0;
            align-items: center;
            justify-content: space-between;
        }

        .pqt {
            font-size: 20px;
            line-height: 30px;
            width: 30px;
            text-align: center;
        }

        .order_price,
        .order_service,
        .order_total {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .order_price p,
        .order_service p {
            color: #a1a1a1;
        }

        .order_total p {
            font-weight: 600;
        }

        input {
            outline: 0;
            background: #f2f2f2;
            border-radius: 4px;
            width: 100%;
            border: 0;
            caret-color: #4f5d7e;
            margin: 10px 15px !important;
            padding: 15px 20px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .first_lastName,
        .shipping_card,
        .address {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .new_card {
            width: 100%;
            height: 115px;
            border: 2px solid #53b5aa;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
        }

        .add_savedcard {
            width: 100%;
            height: 100px;
            border: 2px solid #a1a1a1;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
        }

        .proced_payment a {
            padding: 10px 20px;
            width: 200px;
            border: 2px solid #f5f5f5;
            background-color: #53b5aa;
            color: #000;
            margin-left: 10px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">
        $(document).on("click", "a.deletecart", function(e) {
            var row = $(this);
            var id = $(this).attr('data-id');
            console.log("id", id)
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e69a2a",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('checkoutdelete', ['']) }}" + "/" + id,
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(msg) {
                            if (msg.status == 'success') {
                                swal({
                                        title: "Deleted",
                                        text: "Delete Record success",
                                        type: "success"
                                    },
                                    function() {
                                        location.reload();
                                    });
                            } else {
                                swal("Warning!", msg.message, "warning");
                            }
                        },
                        error: function() {
                            swal("Error!", 'Error in delete Record', "error");
                        }
                    });
                } else {
                    swal("Cancelled", "Your Cart is safe :)", "error");
                }
            });
            return false;
        })
    </script>
@endsection
