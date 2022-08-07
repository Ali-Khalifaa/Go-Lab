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
                <span>الخزينه</span>
            </li>
        </ul>

    </div>
    <div class="x_title">

        <div style="padding-top: 10px;">
            <li style="list-style: none;">
                <form method="GET" action="{{url('admin/lockers')}}" class="form-inline">
                    <label for="from"> من </label>
                    <input class="form-control" required id="from" type="date" name="from_date"
                           value="{{request()->from_date}}">
                    <label for="to">الى</label>
                    <input id="to" class="form-control" required type="date" name="to_date"
                           value="{{request()->to_date}}">
                    <input class="btn btn-primary mb-2" type="submit" value="جرد">
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المخزن</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="store_id" id="form_control_1">

                                @foreach ($stores as $store)
                                    <option
                                        value="{{ $store->id }}">{{ $store->name }}</option>

                                @endforeach

                            </select>
                            <div class="form-control-focus"></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المخزن</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="type" id="form_control_1">
                                <option value="0">ايرادات</option>
                                <option value="1">مصروفات</option>
                            </select>
                            <div class="form-control-focus"></div>
                        </div>
                    </div>

                    {{--                    <div class="ui fluid search selection dropdown" style="width:150px;display: inline;">--}}
                    {{--                        <input type="hidden" name="store_id">--}}
                    {{--                        <i class="dropdown icon"></i>--}}
                    {{--                        <div class="default text">المخزن</div>--}}
                    {{--                        <div class="menu">--}}
                    {{--                            @foreach ($stores as $store)--}}
                    {{--                                <div class="item" data-value="{{ $store->id }}">{{ $store->name }}</div>--}}
                    {{--                            @endforeach--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="ui fluid search selection dropdown" style="width:150px;display: inline;">--}}
                    {{--                        <input type="hidden" name="type">--}}
                    {{--                        <i class="dropdown icon"></i>--}}
                    {{--                        <div class="default text">النوع</div>--}}
                    {{--                        <div class="menu">--}}

                    {{--                            <div class="item" value="0">ايرادات</div>--}}
                    {{--                            <div class="item" data-value="1">مصروفات</div>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </form>
            </li>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> الخزينه </h2>
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
                        <th>المبلغ</th>
                        <th> النوع</th>
                        <th> الفئه</th>
                        <th>المخزن</th>
                        <th>المسئول</th>
                        <th>التاريخ</th>

                        <!--<th width="15%">التحكم</th>-->

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lockers as $i=>$company)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $company['number'] }}</td>

                            <td>

                                @if($company['type']==0)
                                    ايراد
                                @else
                                    مصروفات
                                @endif

                            </td>

                            <td>

                                @if($company['type']==0 && $company['category']=='general' )
                                    ايرادات
                                @elseif($company['type']==0 && $company['category']=='online' )
                                    بيع اونلاين
                                @elseif($company['type']==0 && $company['category']=='direct' )
                                    بيع مباشر
                                @elseif($company['type']==1 && $company['category']=='general' )
                                    مصروفات
                                @elseif($company['type']==1 && $company['category']=='direct' )
                                    فواتير شراء
                                @endif


                            </td>

                            <td>
                                {{$company->store->name}}
                            </td>

                            <td>

                                {{$company->user->name}}
                            </td>

                            <td>{{$company->created_at}}</td>

                        </tr>

                    @endforeach

                    </tbody>
                </table>
                <h3> الاجمالى
                    <span>
                  {{$total}}
              </span>
                </h3>

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
