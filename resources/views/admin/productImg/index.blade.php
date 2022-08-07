@extends('layouts.main')

@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>صور النتج</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">صور المنتج</h1>
    <a href="{{route('productImg.create',$product_id)}}" class="btn green"> أضافة
        <i class="fa fa-plus"></i>
    </a>
    <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a></button>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض صور المنتج</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> الصورة</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $index=>$product)

                            <tr>
                                <td scope="row">{{ $index + 1}}</td>

                                <td><img src="{{asset('uploads/product/images/'.$product->img)}}" alt="Image"
                                         style="width:50px;height:50px;"></td>

                                <td>

                                    <a href="{{route('productImg.edit', $product->id)}}"
                                       class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> تعديل </a>
                                    <form method="POST" onclick="return confirm('Are you sure?')"
                                          action="{{route('productImg.destroy', $product->id)}}" style="display:inline">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button name="_method" new="hidden" value="DELETE"
                                                class="btn btn-outline btn-circle dark btn-sm black">
                                            <span class="fa fa-trash-o"></span> حذف
                                        </button>

                                    </form>

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
