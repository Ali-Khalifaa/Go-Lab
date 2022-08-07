@extends('layouts.main')
@section('content')


<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>تعديل  المنتج الاكثر مبيعا </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br>
        <form method="POST" action="{{ url('admin/mostproducts/'.$mostproducts->id) }}" enctype="multipart/form-data" mostproducts-parsley-validate="" class="form-horizontal form-label-left" >

        <input name="_method" type="hidden" value="PUT">
            {{ csrf_field() }}

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_id">اسم المنتج
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" required id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12" name="product_id">
                  <option value="">---</option>

                  @foreach ($products as $product)
                    <option value="{{$product->id}}" {{ ($product->id == $mostproducts->product_id)?"selected":"" }}>{{$product->name}}</option>
                  @endforeach

                </select>
              </div>
            </div>


{{--            <div class="form-group">--}}
{{--              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> الكميه   <span class="required">*</span>--}}
{{--              </label>--}}
{{--              <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                <input  type="number"  name="counter" id="counter" value="{{$mostproducts->counter}}" class="form-control col-md-7 col-xs-12" required>--}}
{{--              </div>--}}
{{--            </div>--}}


              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/mostproducts" style="color:white">إلغاء</a></button>
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
