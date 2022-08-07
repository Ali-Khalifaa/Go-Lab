@extends('layouts.main')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/admin/stores')}}">المخازن </a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل</span>
            </li>
        </ul>

    </div>

    @include('partials._errors')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-green"></i>
                        <span class="caption-subject font-green bold uppercase">تعديل المخزن</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <br>
                    <form method="POST" action="{{ url('admin/stores/'.$stores->id) }}" enctype="multipart/form-data"
                          categories-parsley-validate="" class="form-horizontal form-label-left">

                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price"> اسم المخزن
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name" id="name" value="{{$stores->name}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> منطقة
                                    المخزن</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="place_id" id="form_control_1">
                                        @foreach ($areas as $area)

                                            <option
                                                value="{{ $area->id }}" {{ ($area->id == $stores->place_id)?"selected":"" }}>{{ $area->place }}</option>

                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2-multiple" id="members_dropdown" multiple=""
                                            required
                                            id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                            name="products[]">
                                        @foreach ($products as $product)
                                            <option
                                                {{
                                                $stores->products->contains($product->id)?"selected":""
                                                }}
                                                value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="dtBox"></div>
                                <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
                                    <input type="checkbox" id="selectall">
                                    <label>تحديد الكل</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">امناء العهد</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple
                                            name="store_keepers[]">
                                        @foreach ($store_keepers as $store_keeper)
                                            @if(is_null($store_keeper->store) && is_null($store_keeper->keeper_store) && is_null($store_keeper->seller_store)&& is_null($store_keeper->manager_store))
                                                <option
                                                    {{
                                                        $stores->store_keepers->contains($store_keeper->id)?"selected":""
                                                    }}
                                                    value="{{ $store_keeper->id }}">{{ $store_keeper->name }}</option>
                                            @endif
                                            @if(!is_null($store_keeper->keeper_store))
                                                @if($store_keeper->keeper_store->id == $stores->id && is_null($store_keeper->seller_store)&& is_null($store_keeper->manager_store))
                                                    <option selected
                                                            value="{{ $store_keeper->id }}">{{ $store_keeper->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">البائعين</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple
                                            name="sellers[]">
                                        @foreach ($sellers as $seller)
                                            @if(is_null($seller->store) && is_null($seller->keeper_store) && is_null($seller->seller_store)&& is_null($seller->manager_store))
                                                <option
                                                    {{
                                                        $stores->store_sellers->contains($seller->id)?"selected":""
                                                    }}
                                                    value="{{ $seller->id }}">{{ $seller->name }}</option>
                                            @endif
                                            @if(!is_null($seller->seller_store))
                                                @if($seller->seller_store->id == $stores->id && is_null($seller->keeper_store)&& is_null($seller->manager_store))
                                                    <option selected
                                                            value="{{ $seller->id }}">{{ $seller->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">المسؤلين</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple
                                            name="managers[]">
                                        @foreach ($managers as $manager)
                                            @if(is_null($manager->store) && is_null($manager->keeper_store) && is_null($manager->seller_store) && is_null($manager->manager_store) && is_null($manager->finance_manager_store))
                                                <option
                                                    {{
                                                        $stores->store_sellers->contains($manager->id)?"selected":""
                                                    }}
                                                    value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endif
                                            @if(!is_null($manager->manager_store))
                                                @if($manager->manager_store->id == $stores->id && is_null($manager->keeper_store) && is_null($manager->seller_store))
                                                    <option selected
                                                            value="{{ $manager->id }}">{{ $manager->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">مسئولين المالية</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple
                                            name="finance_managers[]">
                                        @foreach ($finance_managers as $finance_manager)
                                            @if(is_null($finance_manager->store) && is_null($finance_manager->keeper_store) && is_null($finance_manager->seller_store) && is_null($finance_manager->manager_store)  )
                                                <option
                                                    {{
                                                        $stores->store_sellers->contains($finance_manager->id)?"selected":""
                                                    }}
                                                    value="{{ $finance_manager->id }}">{{ $finance_manager->name }}</option>
                                            @endif
                                            @if(!is_null($finance_manager->finance_manager_store))
                                                @if($finance_manager->finance_manager_store->id == $stores->id && is_null($finance_manager->keeper_store) && is_null($finance_manager->seller_store))
                                                    <option selected
                                                            value="{{ $finance_manager->id }}">{{ $finance_manager->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="form_control_1">المحاسب</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="accountant_id" id="form_control_1">
                                        @foreach ($accountants as $accountant)

                                            <option value="{{ $accountant->id }}" {{$accountant->id == $stores->accountant_id ? "selected":""}}>{{ $accountant->name }}</option>

                                        @endforeach

                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_price"> عنوان المخزن
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="address" id="address" value="{{$stores->address}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">تعديل</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
