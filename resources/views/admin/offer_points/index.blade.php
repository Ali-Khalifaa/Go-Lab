@extends('layouts.main')
@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">

          <h2>  عروض النقاط </h2>
          <ul class="nav navbar-right panel_toolbox">
              @permission('create-offer_points')
              <li> <a href="{{ url('admin/offer_points/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
              @endpermission


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
              <th> اجمالي الفاتورة</th>
              <th>النقاط</th>

              <th width="15%">التحكم</th>

            </tr>
          </thead>
          <tbody>
          @foreach($offer_points as $i=>$offer_point)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{ $offer_point['total'] }}</td>
                <td>{{ $offer_point['points'] }}</td>



                <td>
                    @permission('update-offer_points')
                    <a href="{{url('admin/offer_points/'.$offer_point['id'].'/edit')}}" class="btn btn-success" >
                        <span class="glyphicon glyphicon-edit"></span>
                     </a>
                    @endpermission
                    @permission('delete-offer_points')
                    <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/offer_points/'.$offer_point['id']) }}"  style="display:inline" >
                        <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     </form>
                    @endpermission

                </td>

              </tr>

          @endforeach

            </tbody>
          </table>

        </div>
        </div>
        </div>


@endsection
