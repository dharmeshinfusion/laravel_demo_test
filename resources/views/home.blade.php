@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Product List') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab19">
                                <div class="sch-product-grid">
                                    <div class="sch-grid-5">
                                        <div class="sch-item-row-5">
                                            @foreach ($product as $item)
                                                <div class="sch-item-row-5-number">
                                                    <div class="card">
                                                        <div class="card--image">
                                                            <img src="{!! url('storage/product/' . @$item->image) !!}" alt="{{ $item->image }}">
                                                        </div>
                                                    </div>
                                                    <div class="sch-item-row-5-info">
                                                        <div class="sch-item-row-5-name">
                                                            <a
                                                                href="{{ route('single_product', $item['id']) }}">{{ $item['name'] }}</a>
                                                        </div>
                                                        <div class="sch-item-row-5-brand">
                                                            {{ Str::words($item['description'], 15, '....') }}
                                                        </div>
                                                        <div class="sch-item-row-5-price">
                                                            $ {{ $item['price'] }}
                                                        </div>
                                                        <div class="sch-button-5">
                                                            <a href="{{ route('single_product', $item['id']) }}"
                                                                class="button-cart" style="float: left;">
                                                                <i class="ion-eye left-icon"></i>
                                                            </a>
                                                            <form action="{{ route('checkout.store') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item['id'] }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="name"
                                                                    value="{{ $item['name'] }}">
                                                                <input type="hidden" name="price"
                                                                    value="{{ $item['price'] }}">
                                                                <input type="hidden" name="description"
                                                                    value="{{ $item['description'] }}">
                                                                <input type="hidden" name="image"
                                                                    value="{{ $item['image'] }}">
                                                                <button class="button-cart" style="float: right;">
                                                                    <i class="ion-ios-cart right-icon"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
    <link href="{{ asset('assets/css/style6.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style10.css') }}" rel="stylesheet">
@endsection
