@extends('layouts.main')
@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">

          <h2> الخصومات بالإسم </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a href="{{ url('admin/name_notifies/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>


            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <table id="table_id" class="table table-striped">
            <thead  class="thead-light">
              <tr>
              <th>#</th>
              <th>   اسم الخصم  </th>
              <th>   المنتجات التي بالخصم  </th>

              <th width="15%">التحكم</th>

            </tr>
          </thead>
          <tbody>
          @foreach($notify_names as $i=>$notify)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{ $notify->name }}</td>
                <td>
                    @foreach($notify->notify_name_units as $unit)
                        {{$unit->product->name}} <br>
                    @endforeach
                </td>
                <td>
                    <a href="{{route('name_notifies.edit',$notify->id)}}" class="btn btn-success" >
                    <span class="glyphicon glyphicon-edit"></span>
                     </a>
                    <a href="{{route('name_notifies.show',$notify->id)}}" class="btn btn-success" >
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                     <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/name_notifies/'.$notify->id) }}"  style="display:inline" >
                        <button name="_method" type="hidden" value="DELETE" class="btn btn-danger">
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
