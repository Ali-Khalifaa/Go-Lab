@extends('layouts.main')

@section('content')


    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اعدادات التطبيق</span>
            </li>
        </ul>

    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">جدول عرض تفاصيل اعدادات التطبيق</span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th><i class="fa fa-cogs"></i></th>
                            <th><i class="fa fa-object-group"></i> الاختيار</th>
                            <th><i class="fa fa-bookmark"></i> تفعيل / ايقاف</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($option as $index=>$user)
                            @if($user['id'] != 4)

                                <tr>
                                    <td scope="row">{{ $index + 1}}</td>

                                    <td>{{ $user['option'] }}</td>

                                    <td>
                                        @permission('update-users')
                                        @if($user->is_active == 1)

                                            <form method="POST" onclick="return confirm('هل تريد عمل ايقاف للاختيار ؟')"
                                                  action="{{ url('admin/options/deactive/'.$user['id']) }}"
                                                  style="display:inline">
                                                {{ csrf_field() }}

                                                <button class="btn btn-outline btn-circle btn-sm red">
                                                    <i class="fa fa-edit"></i>ايقاف التفعيل
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST"
                                                  onclick="return confirm('هل انت متأكد من تفعيل الاختيار؟')"
                                                  action="{{ url('admin/options/active/'.$user['id']) }}"
                                                  style="display:inline">
                                                {{ csrf_field() }}
                                                <button href="" class="btn btn-outline btn-circle btn-sm blue">
                                                    <i class="fa fa-edit"></i> تفعيل
                                                </button>

                                            </form>
                                        @endif
                                        @endpermission

                                    </td>

                                </tr>

                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>




@endsection
