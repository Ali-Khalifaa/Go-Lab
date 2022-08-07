@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>صلاحيات المنتجات</span>
            </li>
        </ul>

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> صلاحيات المنتجات </h2>
{{--                <ul class="nav navbar-right panel_toolbox">--}}

{{--                    <li>--}}
{{--                        <form method="GET" action="{{url('admin/lockers')}}" class="form-inline">--}}
{{--                            <label for="from"> من </label>--}}
{{--                            <input class="form-control" id="from" type="date" name="from_date"--}}
{{--                                   value="{{old('from_date' , date('Y-m-d'))}}">--}}
{{--                            <label for="to">الى</label>--}}
{{--                            <input id="to" class="form-control" type="date" name="to_date"--}}
{{--                                   value="{{old('to_date', date('Y-m-d') )}}">--}}
{{--                            <input class="btn btn-primary mb-2" type="submit" value="جرد">--}}


{{--                            <div class="ui fluid search selection dropdown" style="width:150px;display: inline;">--}}
{{--                                <input type="hidden" name="store_id">--}}
{{--                                <i class="dropdown icon"></i>--}}
{{--                                <div class="default text">المخزن</div>--}}
{{--                                <div class="menu">--}}
{{--                                    @foreach ($stores as $store)--}}
{{--                                        <div class="item" data-value="{{ $store->id }}">{{ $store->name }}</div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="ui fluid search selection dropdown" style="width:150px;display: inline;">--}}
{{--                                <input type="hidden" name="type">--}}
{{--                                <i class="dropdown icon"></i>--}}
{{--                                <div class="default text">النوع</div>--}}
{{--                                <div class="menu">--}}

{{--                                    <div class="item" value="0">ايرادات</div>--}}
{{--                                    <div class="item" data-value="1">مصروفات</div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </form>--}}

{{--                    </li>--}}

{{--                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
                <div class="clearfix"></div>
            </div>

            <div class="x_content table-scrollable">

                <table id="table_id" class="table table-striped table-bordered table-advance table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th> المخزن</th>
                        <th> الكميه</th>
{{--                        <th> الكميه قطاعى</th>--}}
                        <th>تاريخ الانتاج</th>
                        <th>تاريخ الانتهاء</th>

                        <!--<th width="15%">التحكم</th>-->

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($info_expiration as $i=>$company)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <?php
                            $product = $company->infos->products->first();
                            ?>
                            <td>{{ $product->name }}</td>

                            <td>

                                {{$company->store->name }}

                            </td>

                            <td>

                                {{ $company['quantity_total'] }}

                            </td>

{{--                            <td>--}}
{{--                                {{ $company['quantity_unit'] }}--}}
{{--                            </td>--}}

                            <td>

                                {{$company->production_date}}
                            </td>

                            <td>{{$company->expiry_date}}</td>

                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
