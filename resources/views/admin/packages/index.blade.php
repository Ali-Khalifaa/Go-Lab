@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> العروض </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="{{ url('admin/packages/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>


                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم العرض</th>
                        <th>سعر العرض</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($packages as $i=>$package)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $package['name'] }}</td>
                            <td>{{ $package['price'] }}</td>


                            <td>
                                <a href="{{url('admin/packages/'.$package['id'].'/edit')}}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>


                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/packages/'.$package['id']) }}" style="display:inline">

                                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>

                            </td>


                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
