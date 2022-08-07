@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/users')}}"> المستخدمين </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اضافة</span>
            </li>
        </ul>

    </div>
    <h1 class="page-title">اضافه مستخدم </h1>
    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ Route('users.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> اسم المستخدم <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id"> رقم التليفون <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="id" id="id" class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number"> الايميل <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" name="email" id="email"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">كلمة السر <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="password" id="password"
                                       class="form-control col-md-7 col-xs-12" required>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="checkbox">اضافة جميع الصلاحيات
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <input type="checkbox" name="all_permission" id="notific8_sticky" value="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">الصلاحيات <span
                                    class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3"></h3>
                                        <ul class="nav nav-pills ml-auto p-2">
                                            @foreach($permissions as $permission => $name)
                                                <li class="nav-item"><a
                                                        class="nav-link {{$permission=='users'?'active':''}}"
                                                        href="#{{$permission}}" data-toggle="tab">{{$name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            @foreach($permissions as $permission => $name)
                                                <div class="tab-pane {{$permission=='users'?'active':''}}"
                                                     id="{{$permission}}">
                                                    @foreach($maps as $map => $map_name)
                                                        <label><input type="checkbox" name="permissions[]"
                                                                      value="{{$map}}-{{$permission}}">{{$map_name}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                        @endforeach
                                        <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/users"
                                                                                 style="color:white">إلغاء</a></button>
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
