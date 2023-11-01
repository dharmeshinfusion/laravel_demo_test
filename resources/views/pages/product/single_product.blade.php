@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-8 border p-3 main-section bg-white">
            <div class="row hedding m-0 pl-3 pt-0 pb-3">
                <p>Single Product Detail
                    <span style="float: right">
                        <a href="{{ route('home') }}"style="text-decoration: none;">Back</a>
                    </span>
                </p>
            </div>
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="{!! url('storage/product/' . @$single_product->image) !!}" alt="{{ $single_product->image }}" class="border p-3">
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="m-0 p-0">{{ $single_product->name }}</p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro">$ {{ $single_product->price }}</p>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h5>Product Detail</h5>
                                <span>{{ $single_product->description }}</span>
                                <hr class="m-0 pt-2 mt-2">
                                {{-- <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="" name="quantity"
                                        value="1" title="Qty" class="input-text qty text" size="4"
                                        pattern="" inputmode="">
                                    <input type="button" value="+" class="plus">
                                </div> --}}
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-12 pb-2">
                                        <form action="{{ route('checkout.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $single_product->id }}">
                                            <div class="quantity buttons_added">
                                                <input type="button" value="-" class="minus">
                                                <input type="number" step="1" min="1" max=""
                                                    name="quantity" value="1" title="Qty"
                                                    class="input-text qty text" size="4" pattern=""
                                                    inputmode="">
                                                <input type="button" value="+" class="plus">
                                            </div>
                                            <br>
                                            <br>
                                            {{-- <input type="hidden" name="quantity" value="1"> --}}
                                            <input type="hidden" name="name" value="{{ $single_product->name }}">
                                            <input type="hidden" name="price" value="{{ $single_product->price }}">
                                            <input type="hidden" name="description"
                                                value="{{ $single_product->description }}">
                                            <input type="hidden" name="image" value="{{ $single_product->image }}">
                                            <button class="btn btn-danger w-100" style="float: right;">Add To Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        .hedding {
            font-size: 20px;
            color: #ab8181`;
        }

        .main-section {
            position: absolute;
            left: 50%;
            right: 50%;
            transform: translate(-50%, 5%);
        }

        .left-side-product-box img {
            width: 100%;
        }

        .left-side-product-box .sub-img img {
            margin-top: 5px;
            width: 83px;
            height: 100px;
        }

        .right-side-pro-detail span {
            font-size: 15px;
        }

        .right-side-pro-detail p {
            font-size: 25px;
            color: #a1a1a1;
        }

        .right-side-pro-detail .price-pro {
            color: #E45641;
        }

        .right-side-pro-detail .tag-section {
            font-size: 18px;
            color: #5D4C46;
        }

        .pro-box-section .pro-box img {
            width: 100%;
            height: 200px;
        }

        @media (min-width:360px) and (max-width:640px) {
            .pro-box-section .pro-box img {
                height: auto;
            }
        }
    </style>
@endsection
@section('scripts')
    <script data-require="jquery@3.1.1" data-semver="3.1.1"
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets/css/script.js') }}"></script>
@endsection
