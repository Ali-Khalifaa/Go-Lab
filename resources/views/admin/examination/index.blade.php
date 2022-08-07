@extends('layouts.main')
@section('content')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/admin')}}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">سجل فواتير الشراء
                </a>

            </li>

        </ul>

    </div>
    <h2 class="page-title"> سجل فواتير الشراء لمخزن
        {{ $store->name==null ? "------" :  $store->name }}</h2>


    <form method="GET" action="{{route('examinations.index')}}" class="form-inline">
        <label for="from"> من </label>
        <input required class="form-control" id="from" type="date" name="from_date"
               value="{{request()->from_date}}">
        <label for="to">الى</label>
        <input required id="to" class="form-control" type="date" name="to_date"
               value="{{request()->to_date}}">
        <input class="btn btn-primary mb-2" type="submit" value="جرد">
    </form>

    @if(!empty(Auth::user()->manager_store))

        <a href="{{ route('examinations.create') }}" class="btn green"> عمل فاتورة شراء
            <i class="fa fa-plus"></i>
        </a>
    @endif


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">

                <table class="table table-striped">
                    @foreach($examinations as $examination)
                        <?php
                        $total_receipt = 0;
                        $total_recall = 0;
                        ?>
                        <thead class="thead-light">
                        <tr>
                            <th colspan="2"># {{$examination->id}}</th>
                            <th colspan="3" class="text-center"> تفاصيل المحضر</th>
                            <th colspan="3" class="text-center">
                                <strong>تاريخ المحضر : {{$examination->date_of_examination}}</strong>
                            </th>
                            <th colspan="2" class="text-center">

                                <strong>المورد : {{$examination->supplier->name}}</strong>
                            </th>
                            <th colspan="3" class="text-center">

                                <strong>المسؤل
                                    : {{is_null($examination->manager)? '---' : $examination->manager->name}}</strong>
                            </th>
                            @if(Auth::user()->keeper_id==null)
                                <th colspan="2" class="text-center">
                                    <strong>الاجمالي : {{$examination->total}}</strong>
                                </th>
                                <th colspan="2" class="text-center">
                                    <strong>تم دفع : {{$examination->paid}}</strong>
                                </th>
                                <th colspan="2" class="text-center">
                                    <strong>متبقى : {{$examination->total - $examination->paid}}</strong>
                                </th>
                            @endif
                            @if($examination->is_received==1)
                                <th colspan="1" class="text-center"
                                    style="position: relative;top: 100px;display: table;">
                                    <strong style="background-color:red;">تم التسليم </strong>
                                </th>
                            @endif
                            <td style="position: relative;top: 100px;display: table;">
                            @if(!$examination->is_received_keeper==1)
                                <!--@if(!Auth::user()->keeper_id==null)-->
                                <!--<form method="POST" action="{{ Route('is_recived')}}" -->
                                    <!--    class="form-horizontal form-label-left" >-->
                                    <!--    @csrf-->
                                    <!--<input class="btn btn-primary mb-2" type="submit" value="استلمت ">-->
                                <!--<input class="btn btn-primary mb-2" type="hidden" name="id" value="{{$examination->id}}">-->
                                    <!--</form>-->
                                    <!--@endif-->



                                    @endif
                                    <a href="{{url('admin/examination/'.$examination['id'].'/bill')}}"
                                       class="btn btn-info">
                                        <span class="glyphicon glyphicon-print">  </span>
                                    </a>

                                    <a href="{{url('admin/examination/'.$examination['id'].'/fatora')}}"
                                       class="btn btn-warning">
                                        <span class="fa fa-print">  </span>
                                    </a>

                                    @if(Auth::user()->finance_manager==$store->id)
                                        @if(!$examination->is_paid==1)
                                            <form method="POST" action="{{ Route('is_paid')}}"
                                                  class="form-horizontal form-label-left">
                                                @csrf
                                                <input class="btn btn-primary mb-2" type="submit" value="دفعت">
                                                <input style="width: 70px;display: block;" name="paid_count"
                                                       type="number" value="">
                                                <input class="btn btn-primary mb-2" type="hidden" name="id"
                                                       value="{{$examination->id}}">
                                            </form>
                                        @else
                                            <sapn style="display:block">تم الدفع</sapn>
                                        @endif
                                    @endif

                                    @if(!$examination->is_received_keeper==1)
                                        @if(Auth::user()->keeper_id!=null)
                                            <?php
                                            $keeper_id = Auth::user()->id;
                                            ?>
                                            <form method="POST"
                                                  action="{{ url('/is-recived/'.$examination->id.'/'.$keeper_id)}}"
                                                  class="form-horizontal form-label-left">
                                                @csrf
                                                <input class="btn btn-primary mb-2" type="submit"
                                                       value="استلمت البضاعه">
                                            <!--<input class="btn btn-primary mb-2" type="hidden" name="id" value="{{$examination->id}}">-->
                                            </form>
                                        @endif
                                    @else
                                        <strong style="background-color:yellow;">تم الاستلام من قبل الامين </strong>
                                    @endif
                            </td>


                        </tr>
                        </thead>
                        <tbody class="mb-3">
                        <tr>
                            <th> #</th>
                            <th colspan="2"> اسم المنتج</th>
                            <th colspan="2"> اسم الشركة</th>
                            <th colspan="2"> تم استلام</th>
                            @if(Auth::user()->keeper_id==null)
                                <th>باجمالي سعر شراء</th>
                            @endif
                            <th> بحالة</th>
                            <!--<th> تم استرحاع</th>-->
                            <!--<th> بسبب انها</th>-->
                            <th colspan="2"> الكمية الموجودة قبل</th>
                            <th colspan="2"> الكمية الموجودة بعد</th>
                        @foreach($examination->examination_units as $i => $examination_unit)
                            <tr>
                                <th scope="row">{{++$i}}</th>

                                <td colspan="2">
                                    {{ $examination_unit->product==null ? "----" :  $examination_unit->product->name }}
                                </td>
                                <td colspan="2">
                                    {{ $examination_unit->product==null ? "----" :  $examination_unit->product->company->name }}
                                </td>
                                <td colspan="2">
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
                            <!--<td>
                                    ({{ $examination_unit->recall == 0 ? "------" :  $examination_unit->product->unit_type }}
                                )
{{ $examination_unit->recall == 0 ? "------" : $examination_unit->recall }}
                                </td>-->
                            <?php
                            $total_recall = $total_recall + $examination_unit->recall
                            ?>
                            <!--<td>
                                    @if(isset($examination_unit-> return_reason->status))
                                {{ $examination_unit-> return_reason->status}}
                            @else
                                ------
@endif
                                </td>-->
                                <td colspan="2">{{ $examination_unit->quantity_before == 0 ? "------" : $examination_unit->quantity_before }}</td>
                                <td colspan="2">{{ $examination_unit->quantity_after == 0 ? "------" :$examination_unit->quantity_after}}</td>
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
