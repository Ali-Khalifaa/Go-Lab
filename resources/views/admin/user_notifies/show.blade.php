@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2>المكافأه الخاص بالعميل {{$notify->user->name}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="{{route('user_notifies.edit',$notify->id)}}">
                            <i class="fa fa-edit"></i>تعديل
                        </a>
                    </li>
                    <li style="margin: 0 5px 0 5px">
                        <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                              action="{{ url('admin/user_notifies/'.$notify->id) }}" style="display:inline">
                            <button name="_method" type="hidden" value="DELETE" class="btn btn-danger">
                                <i class="fa fa-trash-o"></i>حذف
                            </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </li>
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>

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
                    @foreach($notify->notify_user_units as $i=>$unit)

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
