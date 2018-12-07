@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($products->chunk(3) as $items)
        <div class="row" style="margin-bottom:10px;">
            @foreach($items as $product)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top product-img" src="{{ $product->img_name }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('product.info', ['id' =>  $product->id ]) }}" class="btn btn-outline-primary">
                                <i class="fa fa-info-circle"></i> 資訊
                            </a>
                            <form method="POST" action="{{ route('shoppingcart.add') }}" style="display:inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="hidden" name="quantity" value="1">
                                @if ( $product->inventory > 0)
                                    <button class="btn btn-outline-success">
                                        <i class="fa fa-cart-plus"></i> 加入購物車
                                    </button>
                                @else
                                    <button class="btn btn-outline-danger" disabled>
                                        <i class="fa fa-minus-circle"></i> 已售完
                                    </button>
                                @endif
                            </form>
                            @if (!Auth::guest() && Auth::user()->user_type === 'admin')
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="fa fa-edit"></i> 修改資訊
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
