@extends('layouts.main-old-jemy')
@section('content')


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
                    <form method="POST" action="{{ url('/admin/store/switch') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">امين المخزن
                                المنقول اليه الشيفت</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="store_keeper">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">امين المخزن</div>
                                    <div class="menu">
                                        @foreach ($store_keepers as $store_keeper)
                                            @if($user->id != $store_keeper->id)
                                                <div class="item"
                                                     data-value="{{ $store_keeper->id }}">{{ $store_keeper->name }}</div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}"
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
