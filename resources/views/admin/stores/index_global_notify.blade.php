@extends('layouts.main')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">المكافأه العام على جميع المخازن
                </a>

            </li>

        </ul>

    </div>
    <h2 class="page-title"> المكافأه العام على جميع المخازن</h2>
    @if($create)
    <a href="{{ url('/admin/create_global_notify') }}" class="btn green"> أضافة
        <i class="fa fa-plus"></i>
    </a>
    @else
        <a href="{{ url('/admin/edit_global_notify') }}" class="btn green"> تعديل
            <i class="fa fa-plus"></i>
        </a>
        <form method="POST" onclick="return confirm('هل انت متأكد؟')"
              action="{{ url('admin/delete_global_notify') }}" style="display:inline">
            <button name="_method" type="hidden" value="DELETE" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
            </button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    @endif

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th> اسم المنتج</th>
                        <th> اسم الشركة</th>
                        <th> التصنيف</th>
                        <th> المكافأه الجملة</th>
                        <th> الفوري جملة</th>
                        <th> الآجل جملة</th>
                        <th> المكافأه القطاعي</th>
                        <th> الفوري قطاعي</th>
                        <th> الآجل قطاعي</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $i=>$unit)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $unit->product->name }}</td>
                            <td>{{ $unit->product->subcategory->name }}</td>
                            <td>{{ $unit->product->company->name }}</td>
                            <td>{{ $unit->discount_total }} %</td>
                            <td>{{ $unit->now_total }} %</td>
                            <td>{{ $unit->later_total }} %</td>
                            <td>{{ $unit->discount_unit }} %</td>
                            <td>{{ $unit->now_unit }} %</td>
                            <td>{{ $unit->later_unit }} %</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
