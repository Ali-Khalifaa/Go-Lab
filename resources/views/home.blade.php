@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                    </div>


                </div>

                <div class="row widget-row" style="width: max-content;margin: 20%;">
                    <!--<div class="col-md-4" style="border-style: groove;" >-->

                    <!--    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">-->
                    <!--        <h4 class="widget-thumb-heading">Current Balance</h4>-->
                    <!--        <div class="widget-thumb-wrap">-->
                    <!--            <i class="widget-thumb-icon bg-green icon-bulb"></i>-->
                    <!--            <div class="widget-thumb-body">-->
                    <!--                <span class="widget-thumb-subtitle">USD</span>-->
                    <!--                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="7,644">0</span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--</div>-->
{{--                    <div class="col-md-6" style="border-style: groove;width: max-content;">--}}

{{--                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
{{--                            <h4 class="widget-thumb-heading"> طلبات اليوم </h4>--}}
{{--                            <div class="widget-thumb-wrap">--}}
{{--                                <i class="widget-thumb-icon bg-red icon-layers"> </i>--}}
{{--                                <div class="widget-thumb-body">--}}
{{--                                    <span class="widget-thumb-subtitle">الطلبات</span>--}}
{{--                                    <span class="widget-thumb-body-stat" data-counter="counterup"--}}
{{--                                          data-value="100">0</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <!--<div class="col-md-4" style="border-style: groove;" >-->
                    <!--    <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">-->
                    <!--        <h4 class="widget-thumb-heading">Biggest Purchase</h4>-->
                    <!--        <div class="widget-thumb-wrap">-->
                    <!--            <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>-->
                    <!--            <div class="widget-thumb-body">-->
                    <!--                <span class="widget-thumb-subtitle">USD</span>-->
                    <!--                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="815">0</span>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--</div>-->
{{--                    <div class="col-md-6" style="border-style: groove;width: max-content;">--}}

{{--                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">--}}
{{--                            <h4 class="widget-thumb-heading"> دخل اليوم </h4>--}}
{{--                            <div class="widget-thumb-wrap">--}}
{{--                                <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>--}}
{{--                                <div class="widget-thumb-body">--}}
{{--                                    <span class="widget-thumb-subtitle">L.E</span>--}}
{{--                                    <span class="widget-thumb-body-stat" data-counter="counterup"--}}
{{--                                          data-value="1000">0</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>

            </div>
        </div>
    </div>
@endsection
