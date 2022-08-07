@extends('layouts.main')
@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">

          <h2>  معلومات التواصل </h2>
          <ul class="nav navbar-right panel_toolbox">
              @permission('create-contacts')
              <li> <a href="{{ url('admin/contacts/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>
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
              <th> الرقم  </th>
              <th>  النوع </th>

              <th width="15%">التحكم</th>

            </tr>
          </thead>
          <tbody>
          @foreach($contacts as $i=>$contact)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{ $contact['phone'] }}</td>
                <td>@if($contact['is_whats']=="1")
                    واتس
                    @else
                    رقم عادى
                    @endif
                
                </td>
                <td>
                    @permission('update-contacts')

                    <a href="{{url('admin/contacts/'.$contact['id'].'/edit')}}" class="btn btn-success" >
                <span class="glyphicon glyphicon-edit"></span>
                 </a>
                    @endpermission

                    @permission('delete-contacts')

                 <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/contacts/'.$contact['id']) }}"  style="display:inline" >

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
