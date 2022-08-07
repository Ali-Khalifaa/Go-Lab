@extends('layouts.store')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2>  الفئات </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li> <a href="{{ url('store/storecategories/create') }}"> <i class="fa fa-plus"></i>اضافه</a></li>


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
                        <th>اسم الفئة</th>
                        <th>الصورة</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $i=>$category)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $category['name'] }}</td>
                             <td><img style="height:50px; width:50px;" src="{{asset('uploads/storecatecories/'.$category->image)}}"></td>


                            <td>
                                <a href="{{url('store/storecategories/'.$category['id'].'/edit')}}" class="btn btn-success" >
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>


                                <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('store/storecategories/'.$category['id']) }}"  style="display:inline" >

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
