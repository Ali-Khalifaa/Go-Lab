@extends('layouts.main')
@section('content')
    <div class="row">
        @if (Session::has('message'))
            <p style="background: #ebf6fa;font-size: 16px;text-align: center;font-size: 20px;height:106px">
                {{ Session::get('message') }}</p>
        @endif
    </div>

    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('password/' .Auth::id()) }}"
                          enctype="multipart/form-data" class="form-horizontal form-label-left">
                        {{-- <input name="_method" type="hidden" value="PUT"> --}}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offer_type"> كلمة المرور
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" class="form-control col-md-7 col-xs-12" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offer_type">كلمة المرور الجديده
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" class="form-control col-md-7 col-xs-12" name="new_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="offer_type">تاكيد كلمة المرور
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" class="form-control col-md-7 col-xs-12"
                                       name="password_confirmation"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                <button type="submit" class="btn btn-success"
                                        style="color:white;margin:auto;display:block;font-size:18px;width:110px">تغيير
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
