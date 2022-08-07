@extends('layouts.store')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>اضافه  فئه</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('storecategories.store') }}" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم الفئه  <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  type="text"  name="name" id="name" value="{{old('name')}}" class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >صورة</label>
                            <div class="input-group" >
                                <div class="col-md-6 col-sm-6 col-xs-12" >
                                    <input type="file" name="image" id="image" class="form-control" > </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/categories" style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">اضافه</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
