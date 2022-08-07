@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> اضافه عميل مميز </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="GET" action="{{ Route('user_notifies.create') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                العميل</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="user_id" id="form_control_1">
                                    @foreach ($users as $user)

                                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                العميل</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="store_id_notify" id="form_control_1">
                                    @foreach ($notifies as $notify)

                                        <option value="{{ $notify->id }}">{{ is_null($notify->store)? 'المكافأه العام على المخازن' :$notify->store->name }}</option>

                                    @endforeach
                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/user_notifies"
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
