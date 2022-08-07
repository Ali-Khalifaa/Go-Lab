@extends('layouts.main')
@section('content')


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> تاكيد الاستلام</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>

                    @if(str_contains(url()->current(), '/confirm_direct_sell_received_money'))
                        <form method="POST" action="{{ url('/admin/confirm_direct_sell_received_money/'.$order->id) }}"
                              enctype="multipart/form-data" data-parsley-validate=""
                              class="form-horizontal form-label-left" novalidate="">
                            @else
                                <form method="POST" action="{{ url('/admin/confirm_received_money/'.$order->id) }}"
                                      enctype="multipart/form-data" data-parsley-validate=""
                                      class="form-horizontal form-label-left" novalidate="">
                                    @endif
                                    {{ csrf_field() }}

                                    @if(str_contains(url()->current(), '/confirm_direct_sell_received_money'))
                                        <div class="form-group">

                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> المبلغ
                                                المستلم <span class="required">*</span>

                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="received_direct_sell_money_from_f_m"
                                                       id="received_direct_sell_money_from_f_m"
                                                       value="{{old('received_direct_sell_money_from_f_m')}}"
                                                       class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> المبلغ
                                                المستلم من المندوب <span class="required">*</span>

                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="received_money_from_f_m"
                                                       id="received_money_from_f_m"
                                                       value="{{old('received_money_from_f_m')}}"
                                                       class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>

                                    @endif

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-primary" type="button"><a
                                                    href="{{url('/')}}/admin/orders" style="color:white">إلغاء</a>
                                            </button>
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
