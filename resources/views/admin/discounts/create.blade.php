@extends('layouts.main')
@section('content')


      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2> اضافه  مكافأه </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>

                </ul>
              <div class="clearfix"></div>
          </div>
      <div class="x_content">
        <br>
        <form method="POST" action="{{ Route('discounts.store') }}" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

          {{ csrf_field() }}

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subcategory_id">اسم الفئه الفرعية
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select  class="form-control" name="subcategory_id">
                <option value="">---</option>
                @foreach ($subcategories as $subcategory)


                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
              </select>
            </div>
          </div>


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> السعر يبدأ من     <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  type="number"  name="from_price" id="from_price" value="{{old('from_price')}}" class="form-control col-md-7 col-xs-12" required>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_price"> إلي سعر   <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  type="number"  name="to_price" id="to_price" value="{{old('to_price')}}" class="form-control col-md-7 col-xs-12" required>
          </div>
        </div>



        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> المكافأه
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  type="number"  name="discount" id="discount" value="{{old('discount')}}" class="form-control col-md-7 col-xs-12" >
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> التاريخ من
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input  type="date"  name="from_date" id="date" value="{{old('from_date')}}" class="form-control col-md-7 col-xs-12" >
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">  التاريخ الى
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input  type="date"  name="to_date" id="date" value="{{old('to_date')}}" class="form-control col-md-7 col-xs-12" >
            </div>
        </div>


        <div class="ln_solid"></div>
         <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/discounts" style="color:white">إلغاء</a></button>
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
