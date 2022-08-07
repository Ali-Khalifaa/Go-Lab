@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> صافي الارباح </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي الايرادات اليوم</h5>
                                <h1 class="card-text">{{$total_in_today}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي المصروفات اليوم</h5>
                                <h1 class="card-text">{{$total_out_today}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">صافي الربح اليوم</h5>
                                <h1 class="card-text">{{$total_in_out_today}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي ايرادات الشهر</h5>
                                <h1 class="card-text">{{$total_in_monthly}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي مصروفات الشهر</h5>
                                <h1 class="card-text">{{$total_out_monthly}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">صافي ربح الشهر</h5>
                                <h1 class="card-text">{{$total_in_out_monthly}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي ايرادات السنه</h5>
                                <h1 class="card-text">{{$total_in_yearly}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">اجمالي مصروفات السنه</h5>
                                <h1 class="card-text">{{$total_out_yearly}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">صافي ربح السنه</h5>
                                <h1 class="card-text">{{$total_in_out_yearly}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
