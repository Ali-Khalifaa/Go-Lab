@extends('layouts.main')
@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>مديونيات المورد</span>
            </li>
        </ul>

    </div>

{{--        <a href="{{ url('admin/depts/create') }}" class="btn green"> أضافة--}}
{{--            <i class="fa fa-plus"></i>--}}
{{--        </a>--}}

    <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a></button>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل مديونيات المورد</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-user"></i> اسم المورد</th>
                            <th><i class="fa fa-object-group"></i> المخزن</th>
                            <th><i class="fa fa-money"></i>الاجمالى</th>
                            <th><i class="fa fa-money"></i>المبلغ المدفوع</th>
                            <th><i class="fa fa-money"></i>متبقي</th>
                            <th><i class="fa fa-database"></i>التاريخ</th>
                            <th><i class="fa fa-object-group"></i>الحاله</th>
                            <th><i class="fa fa-bookmark"></i> عرض</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($depts as $i=>$dept)

                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td>{{ isset($dept->supplier) ? $dept->supplier->name : "-----" }}</td>
                                <td>{{ isset($dept->store) ? $dept->store->name : "-----" }}</td>
                                <td>{{ $dept->examination ? $dept->examination->total : "-----" }}</td>
                                <td>{{ $dept->examination ? $dept->examination->paid : "-----" }}</td>
                                <td>{{ $dept->amount ? $dept->amount : "-----" }}</td>
                                <td>{{$dept->created_at ? $dept->created_at : "-----"}}</td>
                                @if($dept->examination )
                                    <td> {{ $dept->examination->total == $dept->examination->paid ? " تم التحصيل " : "-----" }} </td>
                                @endif


                                <td>
                                    @if($dept->examination )
                                        @if($dept->examination->total != $dept->examination->paid)
                                            <a href="{{url('admin/supplier_depts/'.$dept['id'].'/edit')}}"
                                               class="btn btn-outline btn-circle btn-sm purple">
                                                <i class="fa fa-edit"></i> تعديل </a>
                                        @endif
                                    @endif

                                    {{--
                                  <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/depts/'.$dept['id']) }}"  style="display:inline" >
                                  <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                                  <span class="glyphicon glyphicon-remove"></span>
                                  </button>
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  </form> --}}

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
