@extends('layouts.main')
@section('content')

    @include('partials._errors')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>تعديل المعلومه</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('admin/contacts/'.$contacts->id) }}"
                          enctype="multipart/form-data" categories-parsley-validate=""
                          class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone1"> الرقم
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="phone" id="phone" value="{{$contacts->phone}}"
                                       class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" requied> نوع الرقم
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="radio" name="is_whats" value="1"
                                       @if($contacts->is_whats=="1") checked @endif> واتس<br>
                                <input type="radio" name="is_whats" value="0"
                                       @if($contacts->is_whats=="0") checked @endif > عادى<br>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/contacts"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">تعديل</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
