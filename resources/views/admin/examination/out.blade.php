@extends('layouts.main')
@section('content')
    <style>
        * {
            font-size: 15px;
            font-weight: bold;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 150px;
            max-width: 150px;
        }

        td.index,
        th.index {
            width: 50px;
            max-width: 50px;
        }

        td.quantity,
        th.quantity {
            width: 50px;
            max-width: 50px;
            word-break: break-all;
        }

        td.price1,
        th.price1 {
            width: 55px;
            max-width: 55px;
            word-break: break-all;
        }

        td.price2,
        th.price2 {
            width: 55px;
            max-width: 55px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            margin: auto;
            width: 300px;
            max-width: 300px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <!--start -->

    <div class="ticket">
        <!--<p class="centered">-->
    <!--    # {{$order->id}}-->
        <!--</p>-->
    <!--<img src="{{url('/')}}/public/images/logo.png" style="width: 135px;margin-right: 70px;" alt="Logo">-->
        <h2 style="text-align: center;"> GOLAB </h2>

    <!--{{$order->type=='total' ? "جمله ": "قطاعى" }}-->
        <br>
        فاتورة شراء # {{$order->id}}
        <br> المورد : <span> {{$order->supplier->name}} </span>
        <br> التاريخ : <span> {{$order->created_at}} </span>
        <!--<br>Address line 2</p>-->
        <table>
            <thead>
            <tr>
                <th class="index">م</th>
                <th class="quantity">كميه</th>
                <th class="description">منتج</th>
                <th class="price1">سعر</th>
                <th class="price2">قيمة</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order_units as $i => $order_unit)
                <tr>
                    <td class="index">{{ ++$i }}</td>
                    <td class="quantity">{{ $order_unit->receive }}</td>
                    <td class="description">{{ $order_unit->product->name }}</td>
                    <td class="price1">{{ $order_unit->total_price / $order_unit->receive }} </td>
                    <td class="price2">{{ $order_unit->total_price }} </td>

                </tr>
            @endforeach
            </tbody>


        </table>
        <div style="padding:5px;">
            <div>
                <span>القيمه :</span>
                <input value=" {{$order->total }}" style="border-style: none;margin: auto;max-width: 100px;">
            </div>
            <div>
                <span>التوصيل :</span>
                <input value="{{$order->delivery_price ?$order->delivery_price : 0 }}"
                       style="border-style: none;margin: auto;max-width: 100px;">
            </div>
            <div>
                <span>مبالغ اضافيه :</span>
                <input value="{{$order->additional_price ?$order->additional_price : 0 }}"
                       style="border-style: none;margin: auto;max-width: 100px;">
            </div>
            <div>
                <span>المدفوع :</span>
                <input value="{{$order->paid }}" style="border-style: none;margin: auto;max-width: 100px;">
            </div>
            <div>
                <span> الباقى :</span>
                <input value="{{($order->total + $order->delivery_amount )- $order->paid}}"
                       style="border-style: none;margin: auto;max-width: 100px;">
            </div>
        </div>

        <p class="centered">استلمت البضاعه الموضحه سالفا بحاله جيده
            <br> المستلم : --------------</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <!--end-->
@endsection

@section ('javascript1')
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
@endsection
