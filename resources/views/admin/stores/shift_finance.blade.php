@extends('layouts.main-old-jemy')
@section('content')


    @include('partials._errors')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> نقل الشيفت </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ url('/admin/store/switch_finance') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">مسئول المالية
                                المنقول اليه الشيفت</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="finance_manager" id="form_control_1">

                                    @foreach ($finance_managers as $finance_manager)
                                        @if($user->id != $finance_manager->id)
                                            <option
                                                value="{{ $finance_manager->id }}">{{ $finance_manager->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                <div class="form-control-focus"></div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                 style="color:white">إلغاء</a></button>
                                <button class="btn btn-primary" type="reset">إعاده</button>
                                <button type="submit" class="btn btn-success">اتمام</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
