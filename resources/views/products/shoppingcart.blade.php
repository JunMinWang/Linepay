@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="align-middle" style="display: inline;">購物車</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-hover center-container">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">訂購品項</th>
                            <th scope="col">單價</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                            <th scope="col">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                <td class="align-middle">{{ $item->name }}</td>
                                <td class="align-middle">{{ $item->price }} </td>
                                <td class="align-middle">{{ $item->qty }}</td>
                                <td class="align-middle">{{ $item->qty * $item->price }}</td>
                                <td class="align-middle">
                                    <form method="POST" action="{{ route('shoppingcart.remove', [ 'id' => $item->rowId ]) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                        <button class="btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="align-middle center-container">無項目</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer center-container">
            <a href="{{ route('order.preview') }}" class="btn btn-outline-success">
                <i class="fa fa-money"></i> 確認購買
            </a>

            <a href="{{ route('product.list') }}" class="btn btn-outline-primary">
                <i class="fa fa-shopping-basket"></i> 繼續選購
            </a>
            <form method="POST" action="{{ route('shoppingcart.removeall') }}" style="display: inline;">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-outline-secondary">
                    <i class="fa fa-trash"></i> 取消所有項目
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
