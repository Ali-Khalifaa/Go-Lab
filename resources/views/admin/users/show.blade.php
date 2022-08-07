@extends('layouts.main')

@section('content')



    <div class="page-title">
        <div class="title_left" style="float: right;direction: rtl;">
            <h3>الصفحه الشخصيه</h3>
        </div>

    </div>


    <div class="clearfix"></div>

    <div class="row" style="direction: rtl">
        <button class="btn btn-primary" type="button"><a href="{{ url()->previous() }}" style="color:white">إلغاء</a></button>
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ticket ">
                <div class="x_title">

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">


                        </li>
                        {{-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li> --}}
                    </ul>
                    {{-- <h2 style="float: right"></h2> --}}
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-12 col-sm-12  profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                {{--                                    @if($user->image)--}}
                                {{--                                    <img class="img-responsive avatar-view" src="{{url('/')}}/public/images/user1.png" alt="Avatar"--}}
                                {{--                                        title="Change the avatar" style="float:right;width: 250px;height: 250px;border-radius: 110px;">--}}
                                {{--                                    @else--}}
                                {{--                                    <img class="img-responsive avatar-view" src="{{url('/')}}/public/images/picture.jpg" alt="Avatar"--}}
                                {{--                                        title="Change the avatar" style="float:right;width: 250px;height: 250px;border-radius: 110px;">--}}
                                {{--                                    @endif--}}

                            </div>
                        </div>
                        <div style="text-align:center">
                            <h3>{{ $user->name }} </h3>
                            @foreach($user->permissions as $permission)
                                @php
                                    $arr = explode('-',$permission->name);
                                @endphp
                                <br> {{$maps[$arr[0]]}} {{$permissions[$arr[1]]}} <br>
                            @endforeach
                            <ul class="list-unstyled user_data">
                                @if($user->shop_name)
                                    <li style="font-size: 18px;">
                                        <i class="fa fa-map-marker user-profile-icon"></i>

                                        <label> العياده</label>
                                        {{ $user->shop_name }}

                                    </li>
                                @endif
                                @if($user->shop_type)
                                    <li style="font-size: 18px;">
                                        <i class="fa fa-map-marker user-profile-icon"></i>
                                        <label> التخصص </label>
                                        {{ $user->shop_type }}
                                    </li>
                                @endif
                                @if($user->address)
                                    <li style="font-size: 18px;">
                                        <i class="fa fa-map-marker user-profile-icon"></i>
                                        <label> العنوان</label>
                                        {{ $user->address }}
                                    </li>
                                @endif
                                @if($user->area)
                                    <li style="font-size: 18px;">
                                        <i class="fa fa-map-marker user-profile-icon"></i>
                                        <label> المنطقه </label>
                                        {{ $user->area }}
                                    </li>
                                @endif


                            </ul>

                            {{-- <a href="{{url('agent/profile/'.$user['id'].'/edit')}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> تعديل البيانات</a> --}}
                            <br/>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
