@extends('layouts.main')
@section('title'. 'order Details')
@section('content')
<section class="section">

    <div class="row">
        <div class="col-lg-12">
            <div class="card-header d-flex justify-content-between align-item-center">
                <h3 class="card-tittle">{{ $title ?? '' }}</h3>
                <div class="" >
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    <a href="{{ route('print', $order->id) }}" class="btn btn-success"><i class="bi bi-printer"></i></a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                <h5 class="card-title">Order</h5>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Order Code</th>
                            <td>{{ $order->order_code ?? ''}}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->order_date ?? ''}}</td>
                        </tr>
                        <tr>
                            <th>Order Status</th>
                            <td>{{ $order->order_status ?? ''}}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Details</h5>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>SubTotal</th>
                        <tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $key=> $orderDetail)
                        <tr>
                            <td>{{ $key +=1 }}</td>
                            <td> <img src="{{ asset('storage/' . $orderDetail->product->product_photo) }}" alt="" width="100" > </td>
                            <td> {{ $orderDetail->product->product_name }}</td>
                            <td> {{ $orderDetail->qty }} </td>
                            <td> {{ number_format($orderDetail->order_price) }}</td>
                            <td> {{ number_format($orderDetail->order_subtotal) }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="2">Grand Total</th>
                            <td colspan="3" class="text-end pe-5">
                                <span class="grandtotal">{{ number_format($order->order_amount) }}</span>
                            </td>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>


</section>
@endsection
