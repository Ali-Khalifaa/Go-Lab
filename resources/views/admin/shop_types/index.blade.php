@extends('layouts.main')
@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">

          <h2> التخصصات </h2>
          <ul class="nav navbar-right panel_toolbox">
              @permission('create-sliders')
              <li> <a href="{{ url('admin/shoptypes/create') }}"> <i class="fa fa-plus"></i> اضافه</a></li>
              @endpermission


            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">

          <table class="table table-striped">
            <thead  class="thead-light">
              <tr>
              <th>#</th>
              <th>التخصص </th>
              <th width="15%">التحكم</th>

            </tr>
          </thead>
          <tbody>
          @foreach($sliders as $i=>$slide)

            <tr>
                <th scope="row">{{++$i}}</th>
              <!--  <td>-->
              <!--<img src="{{asset('uploads/shoptypes/'.$slide->image)}}"  alt="Image" style="width:50px;height:50px;margin-left:30px;">-->
              <!--  </td>-->

              <td>{{$slide->name}}</td>
                <td>
                    @permission('update-sliders')
                    <a href="{{url('admin/shoptypes/'.$slide['id'].'/edit')}}" class="btn btn-success" >
                <span class="glyphicon glyphicon-edit"></span>
                 </a>
                    @endpermission

                    @permission('delete-sliders')

                 <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/shoptypes/'.$slide['id']) }}"  style="display:inline" >

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
