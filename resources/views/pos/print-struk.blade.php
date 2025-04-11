<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pembelian</title>
    <style>
        body{
            width:70mm;
            margin: 0 auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif';
            font-size: 12px;
            color:black;
        }
        header{
            text-align: center;
            font-weight: bold;
        }
        header p{
            font-weight: bold;
        }
        .divider{
            border-top: 1px, dashed black;
            margin: 5px 0;
        }
        .item-row{
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .item-row .left{
            flex: 1;
        }
        .item-row .right{
            flex: 0 0 auto;
            text-align: right;
        }
        .footer{
            margin-top: 10px;
        }
        .text-center{
            text-align: center;
        }
        @media print{
            body{
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="wrepper">
        <header>
            <h3>TOKO BARU</h3>
            <p>Jl. Alamat Baru, Rt.04 Rw.07, Jakarta Pusat</p>
            <p>No Telp: 0214545678</p>
        </header>
        <hr>
        <div class="divider"></div>
        <div>
            <div>Date : {{ date('d-M-Y', strtotime($order->order_date)) }}</div>
            <div>No. Transaction: {{ $order->order_code }}</div>
        </div>
        <hr>
        <div class="divider"></div>
        @foreach ($orderDetails as $orderDetail)

        <div class="item-row">
            <div class="left">{{ $orderDetail->product->product_name }}</div>
            <div class="right">{{ number_format($orderDetail->order_subtotal) }}</div>
        </div>
        <div class="item-row">
            <div class="left">{{ $orderDetail->qty }} x {{ number_format($orderDetail->order_price) }}</div>
        </div>
        @endforeach
        <div class="item-row">
            <div class="left">Total </div>
            <div class="right">{{ number_format($order->order_amount) }}</div>
        </div>

    </div>

</body>
<hr>
<footer>
    <p>Terima kasih di TOKO BARU</p>

</footer>
</html>
