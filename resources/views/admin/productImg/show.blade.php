@extends('layout.dashboard.app')

@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>الفئة </span>
            </li>
        </ul>

    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp sbold">عرض تفاصيل الفئة </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td> الصورة الشخصية</td>
                            <td>
                                <img class="image" src="{{asset('uploads/category/'.$category->img)}}" alt="Image"
                                     style="width:100px;height:100px;margin-left:320px;">
                            </td>
                        </tr>
                        <tr>
                            <td> أسم الفئة باللغة العربية</td>
                            <td>
                                <h5> {{ $category->name_ar }} </h5>
                            </td>
                        </tr>
                        <tr>
                            <td> أسم الفئة باللغة الأنجليزية</td>
                            <td>
                                <h5> {{ $category->name_en }} </h5>
                            </td>
                        </tr>


                        <a href="{{route('dashboard.category.index')}}" class="btn default">الغاء</a>

                        </tbody>
                    </table>
                    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="modal fade" id="full" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Responsive &amp; Scrollable</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="slimScrollDiv"
                                         style="position: relative; overflow: hidden; width: auto; height: 300px;">
                                        <div class="scroller" style="height: 300px; overflow: hidden; width: auto;"
                                             data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Some Input</h4>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Some More Input</h4>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                    <p>
                                                        <input type="text" class="col-md-12 form-control"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slimScrollBar"
                                             style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; left: 1px;"></div>
                                        <div class="slimScrollRail"
                                             style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; left: 1px;"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
                    <div class="modal fade" id="ajax" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="../assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                                    <span> &nbsp;&nbsp;Loading... </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                    <div id="stack1" class="modal fade" tabindex="-1" data-width="400">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Stack One</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Some Input</h4>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                        </div>
                                    </div>
                                    <a class="btn green" data-toggle="modal" href="#stack2"> Launch modal </a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close
                                    </button>
                                    <button type="button" class="btn red">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="stack2" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Stack Two</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Some Input</h4>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                            <p>
                                                <input type="text" class="col-md-12 form-control"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close
                                    </button>
                                    <button type="button" class="btn yellow">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Confirmation</h4>
                                </div>
                                <div class="modal-body">
                                    <p> Would you like to continue with some arbitrary task? </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel
                                    </button>
                                    <button type="button" data-dismiss="modal" class="btn green">Continue Task</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="long" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">A Fairly Long Modal</h4>
                                </div>
                                <div class="modal-body">
                                    <img style="height: 800px" alt="" src="http://i.imgur.com/KwPYo.jpg"></div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade draggable-modal ui-draggable" id="draggable" tabindex="-1" role="basic"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ui-draggable-handle">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true"></button>
                                    <h4 class="modal-title">Start Dragging Here</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
