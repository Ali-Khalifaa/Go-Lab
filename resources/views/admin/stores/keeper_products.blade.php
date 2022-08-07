@extends('layouts.main-old-jemy')
@section('content')
 
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <br>
                    <form method="POST" action="{{ route('store_keeper.store_products',$user->id) }}"
                          enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">

                                                <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="ui fluid search dropdown" multiple="" id="members_dropdown" required
                                        id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                        name="products[]">
                                    @foreach ($products as $product)
                                        <option
                                            {{
                                                $user_products->contains($product->id)?"selected":""
                                            }}
                                            value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="dtBox"></div>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" id="selectall">
                                <label>تحديد الكل</label>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
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
