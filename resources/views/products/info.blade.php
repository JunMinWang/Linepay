@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white">
            {{ $product->name }}
        </div>
        <div class="card-body">
    <div class="row">
        <div class="col-md-4 offset-md-1 center-container">
            <img src="{{ $product->img_name }}" class="product-info-img"/>
        </div>
        <div class="col-md-6 text-secondary">
            <p class="product-info-description">{{ $product->description }}</p>
            <h3 class="product-info-price">$ {{ $product->price }}</h3>

            @if ($product->inventory > 0)
                <a href="#" class="btn btn-outline-primary"><i class="fa fa-money"></i> 直接購買</a>
                <form method="POST" action="{{ route('shoppingcart.add') }}" style="display:inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="quantity" value="1">
                    <button class="btn btn-outline-success">
                        <i class="fa fa-cart-plus"></i> 加入購物車
                    </button>
                </form>
                <br>
                <small>庫存量: {{ $product->inventory }}</small>
            @else
                <button type="button" class="btn btn-outline-dark" disabled ><i class="fa fa-money"></i> 直接購買</button>
                <button type="button" class="btn btn-outline-dark" disabled ><i class="fa fa-cart-plus"></i> 加入購物車</button>
                <br>
                <small class="text-danger">庫存不足，無法販售!</small>
            @endif
        </div>
    </div>
        </div>
    </div>

</div>
@endsection
