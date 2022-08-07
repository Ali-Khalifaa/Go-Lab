@extends('layouts.main')
@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">

          <h2>  المكافئات </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li> <a href="{{ url('admin/discounts/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>


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
              <th>   الفئه الفرعية  </th>
              <th> بدايه من سعر </th>
              <th>  الي سعر  </th>
              <th>   المكافأه  </th>
              <th>   التاريخ من  </th>
              <th>   التاريخ الى  </th>

              <th width="15%">التحكم</th>

            </tr>
          </thead>
          <tbody>
          @foreach($discounts as $i=>$discount)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>@if($discount->subcategory->name){{ $discount->subcategory->name }}@endif</td>
                <td>{{ $discount['from_price'] }}</td>
                <td>{{ $discount['to_price'] }}</td>
                <td>{{ $discount['discount'] }}</td>
                <td>{{ $discount['from_date'] }}</td>
                <td>{{ $discount['to_date'] }}</td>



                <td>
                <a href="{{url('admin/discounts/'.$discount['id'].'/edit')}}" class="btn btn-success" >
                <span class="glyphicon glyphicon-edit"></span>
                 </a>


                 <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/discounts/'.$discount['id']) }}"  style="display:inline" >

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
