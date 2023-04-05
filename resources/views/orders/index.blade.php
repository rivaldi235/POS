@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('content-header', 'Daftar Pesanan')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-success">Transaksi</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{route('orders.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <table class="table table-sm table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Received</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Remain.</th>
                    <th class="text-center">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td class="text-center">{{$order->id}}</td>
                    <td class="text-center">{{$order->getCustomerName()}}</td>
                    <td class="text-center">{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td class="text-center">{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td class="text-center">
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Change</span>
                        @endif
                    </td>
                    <td class="text-center">{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td class="text-center">{{$order->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="text-center">{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th class="text-center">{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

