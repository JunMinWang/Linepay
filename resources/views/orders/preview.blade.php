@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="align-middle" style="display: inline;">結帳</h2>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="align-middle center-container">無項目</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <hr>

                <form action="{{ route('order.add') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="font-weight-bold font-bg">付款方式</label>
                        </div>
                        <div class="col-md-8">
                            <label class="payment-type-label btn btn-primary">
                                <input name="paymentType" type="radio" value="1" class="payment-type-radio" checked>
                                <i class="far fa-money-bill-alt"></i>
                            </label>
                            <label class="payment-type-label btn btn-outline-dark">
                                <input name="paymentType" type="radio" value="2" class="payment-type-radio">
                                <img src="{{ asset('img/linepay.png') }}">
                            </label>
                            <label class="payment-type-label btn btn-outline-dark">
                                <input name="paymentType" type="radio" value="3" class="payment-type-radio">
                                <i class="fa fa-credit-card"></i>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold font-bg">總金額: {{ $total }}</label>
                    </div>

                    <div class="center-container">
                        <button type="submit" class="btn btn-outline-primary">結帳</button>
                        <button type="button" class="btn btn-outline-danger">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('[name="paymentType"]').change(function() {
            $('[name="paymentType"]:checked').parent().siblings().removeClass('btn-primary').addClass('btn-outline-dark')
            $('[name="paymentType"]:checked').parent().removeClass('btn-outline-dark').addClass('btn-primary')
        })
    })
</script>
@endsection
