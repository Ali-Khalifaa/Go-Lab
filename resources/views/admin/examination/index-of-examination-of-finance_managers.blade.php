@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> سجل فواتير الشراء لمخزن {{$store->name}} </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <form method="GET" action="{{route('examinations.index')}}" class="form-inline">
                            <label for="from"> من </label>
                            <input required class="form-control" id="from" type="date" name="from_date"
                                   value="{{old('from_date' , date('Y-m-d'))}}">
                            <label for="to">الى</label>
                            <input required id="to" class="form-control" type="date" name="to_date"
                                   value="{{old('to_date', date('Y-m-d') )}}">
                            <input class="btn btn-primary mb-2" type="submit" value="جرد">
                        </form>
                    </li>
                <!--    @if(!empty(Auth::user()->manager_store))-->
                <!--        <li><a href="{{ route('examinations.create') }}"> <i class="fa fa-plus"></i>عمل فاتورة شراء</a>-->
                    <!--        </li>-->
                    <!--    @endif-->


                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table class="table table-striped">
                    @foreach($examinations as $examination)
                        <?php
                        $total_receipt = 0;
                        $total_recall = 0;
                        ?>
                        <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th colspan="4" class="text-center"> تفاصيل المحضر</th>
                            <th colspan="2" class="text-center">
                                <strong>تاريخ المحضر : {{$examination->date_of_examination}}</strong>
                            </th>
                            <th colspan="2" class="text-center">

                                <strong>المورد : {{$examination->supplier->name}}</strong>
                            </th>
                            <th colspan="2" class="text-center">

                                <strong>المسؤل
                                    : {{is_null($examination->manager)? '---' : $examination->manager->name}}</strong>
                            </th>

                            <th colspan="2" class="text-center">
                                <strong>الاجمالي : {{$examination->total}}</strong>
                            </th>
                            <th colspan="2" class="text-center">
                                <strong>تم دفع : {{$examination->paid}}</strong>
                            </th>
                            <th colspan="2" class="text-center">
                                <strong>متبقى : {{$examination->total - $examination->paid}}</strong>
                            </th>

                            @if($examination->is_received==1)
                                <th colspan="1" class="text-center">
                                    <strong style="background-color:red;">تم التسليم </strong>
                                </th>
                            @endif
                            <td>
                                @if(!$examination->is_received==1)
                                    @if(!Auth::user()->keeper_id==null)
                                        <form method="POST" action="{{ Route('is_recived')}}"
                                              class="form-horizontal form-label-left">
                                            @csrf
                                            <input class="btn btn-primary mb-2" type="submit" value="استلمت ">
                                            <input class="btn btn-primary mb-2" type="hidden" name="id"
                                                   value="{{$examination->id}}">
                                        </form>
                                    @endif




                                    @if(Auth::user()->finance_manager==$store->id)
                                        <form method="POST" action="{{ Route('is_paid')}}"
                                              class="form-horizontal form-label-left">
                                            @csrf
                                            <input class="btn btn-primary mb-2" type="submit" value="دفعت">
                                            <input style="width: 70px;display: block;" name="paid_count" type="number"
                                                   value="">
                                            <input class="btn btn-primary mb-2" type="hidden" name="id"
                                                   value="{{$examination->id}}">
                                        </form>
                                    @endif

                                @endif
                            </td>


                        </tr>
                        </thead>
                        <tbody class="mb-3">
                        <tr>
                            <th> #</th>
                            <th> اسم المنتج</th>
                            <th> اسم الشركة</th>
                            <th> تم استلام</th>
                            @if(Auth::user()->keeper_id==null)
                                <th>باجمالي سعر شراء</th>
                            @endif
                            <th> بحالة</th>
                            <th> تم استرحاع</th>
                            <th> بسبب انها</th>
                            <th> الكمية الموجودة قبل</th>
                            <th> الكمية الموجودة بعد</th>
                        @foreach($examination->examination_units as $i => $examination_unit)
                            <tr>
                                <th scope="row">{{++$i}}</th>

                                <td>
                                    {{ $examination_unit->product==null ? "----" :  $examination_unit->product->name }}
                                </td>
                                <td>
                                    {{ $examination_unit->product==null ? "----" :  $examination_unit->product->company->name }}
                                </td>
                                <td>
                                    @if(!$examination_unit->product==null)
                                        ({{ $examination_unit->receive == 0 ? "------" :  $examination_unit->product->unit_type     }}
                                        )
                                        {{ $examination_unit->receive == 0 ? "------" :  $examination_unit->receive }}
                                    @endif
                                </td>

                                <?php
                                $total_receipt = $total_receipt + $examination_unit->receive
                                ?>
                                @if(Auth::user()->keeper_id==null)
                                    <td>
                                        {{$examination_unit->total_price}}
                                    </td>
                                @endif
                                <td>
                                    @if(isset($examination_unit-> receipt_status->status))
                                        {{ $examination_unit-> receipt_status->status}}
                                    @else
                                        ------
                                    @endif
                                </td>
                                <td>
                                    ({{ $examination_unit->recall == 0 ? "------" :  $examination_unit->product->unit_type }}
                                    )
                                    {{ $examination_unit->recall == 0 ? "------" : $examination_unit->recall }}
                                </td>
                                <?php
                                $total_recall = $total_recall + $examination_unit->recall
                                ?>
                                <td>
                                    @if(isset($examination_unit-> return_reason->status))
                                        {{ $examination_unit-> return_reason->status}}
                                    @else
                                        ------
                                    @endif
                                </td>
                                <td>{{ $examination_unit->quantity_before == 0 ? "------" : $examination_unit->quantity_before }}</td>
                                <td>{{ $examination_unit->quantity_after == 0 ? "------" :$examination_unit->quantity_after}}</td>
                                <td>
                                    {{--                          <a href="{{url('admin/stores/'.$store['id'].'/edit')}}" class="btn btn-success" >--}}
                                    {{--                              <span class="glyphicon glyphicon-edit"></span>--}}
                                    {{--                          </a>--}}
                                    {{--                          <a href="{{ url('admin/stores/product_info',$store->id) }}">--}}
                                    {{--                              <i class="fa fa-plus"></i>اسعار المنتجات--}}
                                    {{--                          </a>--}}


                                    {{--                          <form method="POST" onclick="return confirm('هل انت متأكد؟')" action="{{ url('admin/stores/'.$store['id']) }}"  style="display:inline" >--}}

                                    {{--                              <button name="_method" type="hidden" value="DELETE" class="btn btn-default btn-sm">--}}
                                    {{--                                  <span class="glyphicon glyphicon-remove"></span>--}}
                                    {{--                              </button>--}}
                                    {{--                              <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                    {{--                          </form>--}}

                                </td>


                            </tr>
                            @endforeach
                            </tr>
                            <tr>
                                <th id="total" colspan="3" class="text-center">المجموع :</th>
                                <td colspan="2">{{$total_receipt}}</td>
                                <td>{{$total_recall}}</td>

                            </tr>

                        </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </div>


@endsection
