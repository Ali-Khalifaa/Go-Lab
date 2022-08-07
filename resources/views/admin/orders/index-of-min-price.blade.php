@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اقل سعر للطلبات</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">اقل سعر للطلبات</h1>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل اقل سعر للطلبات</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th> <i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i>  السعر الحالى </th>
                            <th><i class="fa fa-bookmark"></i> عرض </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($orders as $i => $order)

                            <tr>
                                <td scope="row">{{ $i + 1}}</td>

                                <td>{{$order->price}}</td>


                                <td>
                                    <form method="POST" action="{{ url('/admin/min-price/change')}}"
                                          class="form-horizontal form-label-left" style="display: flex;">
                                        @csrf

                                        <input style="" name="price" type="number" value="">
                                        <input class="btn btn-primary mb-2" type="hidden" name="id" value="{{$order->id}}">
                                        <input class="btn btn-primary mb-2" type="submit" value="تغيير القيمه">
                                    </form>

                                <!--<a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">-->
                                    <!--    <i class="fa fa-eye"></i>-->
                                    <!--</a>-->
                                <!--<a href="{{ route('orders.edit',$order->id) }}" class="btn btn-success">-->
                                    <!--    <i class="fa fa-edit"></i>-->
                                    <!--</a>-->

                                </td>

                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>


@endsection
