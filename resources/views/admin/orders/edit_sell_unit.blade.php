@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a>
                </button>

                <div class="clearfix"></div>
            </div>
            <form method="POST" action="{{url('/admin/store/edit_sell/'.$order_unit->id.'/update') }}"
                  enctype="multipart/form-data"
                  data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                <div class="x_content">

                    @csrf
                    <h4>{{$order_unit->product->name}}</h4>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">كميه الجملة المطلوبه </label>
                            <input type="number" name="quantity_total" value="{{$order_unit->quantity_total}}" min="0"
                                   class="form-control" id="inputEmail4"
                                   required>
                        </div>
                    </div>
                    <input type="hidden" name="url" value="{{ url()->previous() }}">

                    {{--                    <div class="form-row">--}}
                    {{--                        <div class="form-group col-md-2">--}}
                    {{--                            <label for="inputEmail4"> كميه القطاعي المطلوبه </label>--}}
                    <input type="hidden" name="quantity_unit" value="{{$order_unit->quantity_unit}}" min="0"
                           class="form-control" id="inputEmail4"
                           required>
                {{--                        </div>--}}
                {{--                    </div>--}}


                <!--<div class="clearfix"></div>-->
                    <button class="btn btn-danger" style="margin-top: 23px;" onclick="return confirm('هل انت متأكد؟')"
                            type="submit">
                        تعديل
                    </button>


                </div>
            </form>
        </div>
    </div>


@endsection
