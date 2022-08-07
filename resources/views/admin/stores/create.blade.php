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
                <span>اضافة</span>
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
                        <span class="caption-subject font-green bold uppercase">اضافة مخزن</span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form method="POST" action="{{ Route('stores.store') }}" enctype="multipart/form-data"
                          data-parsley-validate="" class="form-horizontal form-row-seperated" novalidate="">

                        {{ csrf_field() }}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">اسم المخزن<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1"> اسم
                                    المنطقة</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="place_id" id="form_control_1">
                                        @foreach ($areas as $area)

                                            <option value="{{ $area->id }}">{{ $area->place }}</option>

                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">المنتجات
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2-multiple" id="members_dropdown" multiple="" required
                                            id="exampleFormControlSelect1" class="form-control col-md-6 col-xs-12"
                                            name="products[]">
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="dtBox"></div>
                                <div class="ui toggle checkbox col-md-3 col-sm-3 col-xs-12">
{{--                                    <input type="checkbox"  class="make-switch" id="selectall" data-size="mini">--}}
                                    <input type="checkbox"  id="selectall">
                                    <label>تحديد الكل</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">امناء العهد</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple name="store_keepers[]">
                                        @foreach ($store_keepers as $store_keeper)
                                            @if(is_null($store_keeper->store) && is_null($store_keeper->keeper_store) && is_null($store_keeper->seller_store)&& is_null($store_keeper->manager_store))
                                                <option value="{{ $store_keeper->id }}">{{ $store_keeper->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">امين العهدة الحالي</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="store_keeper_id" id="form_control_1">
                                        @foreach ($store_keepers as $store_keeper)
                                            @if(is_null($store_keeper->store) && is_null($store_keeper->keeper_store) && is_null($store_keeper->seller_store)&& is_null($store_keeper->manager_store))
                                                <option value="{{ $store_keeper->id }}">{{ $store_keeper->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">البائعين</label>
                                <div class="col-md-9">
                                <select id="multiple" class="form-control select2-multiple" multiple name="sellers[]">
                                    @foreach ($sellers as $seller)
                                        @if(is_null($seller->store) && is_null($seller->keeper_store) && is_null($seller->seller_store) && is_null($seller->manager_store))
                                            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">المسؤلين</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple name="managers[]">
                                        @foreach ($managers as $manager)
                                            @if(is_null($manager->store) && is_null($manager->keeper_store) && is_null($manager->seller_store) && is_null($manager->manager_store))
                                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">مسئول المالية الحالي</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="store_finance_manager_id" id="form_control_1">
                                        @foreach ($finance_managers as $manager)
                                            @if(is_null($manager->store) && is_null($manager->keeper_store) && is_null($manager->seller_store) && is_null($manager->manager_store) && is_null($manager->finance_manager_store))
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="multiple" class="control-label col-md-3">مسئولين المالية</label>
                                <div class="col-md-9">
                                    <select id="multiple" class="form-control select2-multiple" multiple name="finance_managers[]">
                                        @foreach ($finance_managers as $manager)
                                            @if(is_null($manager->store) && is_null($manager->keeper_store) && is_null($manager->seller_store) && is_null($manager->manager_store) && is_null($manager->finance_manager_store))
                                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="form_control_1">المحاسب</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="accountant_id" id="form_control_1">
                                        @foreach ($accountants as $accountant)
                                            @if(is_null($accountant->store_accountant))
                                                <option value="{{ $accountant->id }}">{{ $accountant->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    <div class="form-control-focus"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">عنوان المخزن<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="address" id="address" value="{{old('address')}}"
                                           class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-primary" type="button"><a href="{{url('/')}}/admin/stores"
                                                                                     style="color:white">إلغاء</a>
                                    </button>
                                    <button class="btn btn-primary" type="reset">إعاده</button>
                                    <button type="submit" class="btn btn-success">اضافه</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
