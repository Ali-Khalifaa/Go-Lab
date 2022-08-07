    @extends('layouts.main')
    @section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">

              <h2>  بنود المصروفات </h2>
              <ul class="nav navbar-right panel_toolbox">
                  @permission('create-statistics')
                  <li> <a href="{{ url('admin/outgoings/create') }}"> <i class="fa fa-plus"></i>اضافه قسم</a></li>
                  @if($add_item)
                    <li> <a href="{{ url('admin/outgoings_item/create/'.$id) }}"> <i class="fa fa-plus"></i>اضافه بند</a></li>
                  @endif
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
                  <th>اسم بند المصروفات</th>
                  <th>القسم التابع له</th>
                  <th>يومي/شهري</th>
                  <th width="15%">التحكم</th>
                </tr>
              </thead>
              <tbody>
              @foreach($outgoings as $i=>$outgoing)
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{ $outgoing['name'] }}</td>
                    @if($outgoing->parent_id ==0)
                        <td>قسم رئيسي</td>
                    @else
                        <td>{{$outgoing->parent->name}}</td>
                    @endif
                    @if($outgoing->is_daily ==1)
                        <td>يومي</td>
                    @else
                        <td>شهري</td>
                    @endif
                    <td>
                        @permission('create-statistics')

                        <a href="{{url('admin/outgoings/'.$outgoing['id'].'/edit')}}" class="btn btn-success" >
                        <span class="glyphicon glyphicon-edit"></span>
                     </a>
                        @endpermission
                        <a href="{{ url('admin/outgoings?id='.$outgoing['id']) }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
{{--                     <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/outgoings/'.$outgoing['id']) }}"  style="display:inline" >--}}
{{--                    <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
{{--                    <span class="glyphicon glyphicon-remove"></span>--}}
{{--                    </button>--}}
{{--                    <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                    </form>--}}

                   </td>
                  </tr>
              @endforeach

                </tbody>
              </table>

            </div>
            </div>
            </div>


    @endsection
