@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> تقارير صافى ارباح فواتير البيع المباشر   </h2>
                <ul class="nav navbar-nav navbar-right">

                    </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>  نوع الفاتوره  </th>
                            <th> حالة الطلب</th>
                            <th>تاريخ الطلب</th>
                            <!--<th>تاريخ التسليم</th>-->
                            <th>اسم العميل</th>
                            <th>اجمالى السعر</th>
                             <!--<th> الاجمالى بعد الخصم  </th>-->
                            <th>المدفوع</th>
                            <th>متبقى</th>
                            <th> صافى الربح </th>
                            <!--<th>المبلغ المستلم من قبل المسئول</th>-->
                            <th width="15%">التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $i => $order)
                            @if($order->received_direct_sell_money_from_f_m==0)
                                @if(Auth::user()->keeper_id!=null && Auth::user()->id!=1)
                        
                                    @else
                          <tr>
                              <th scope="row">{{ ++$i }}</th>
                              <td>
                              @if($order->type=="total")
                                         جمله
                                  @else
                                         قطاعى
                                  @endif
                                </td>
                              
                              <td>
                                  @if($order->invoice_type==1)
                                        بيان اسعار
                                  @elseif($order->invoice_type==2)
                                        فواتير مبيعات
                                  @elseif($order->invoice_type==0)
                                        بيان اسعار
                                  @else
                                        مرتجع مبيعات
                                  @endif
                                  
                                  </td>
                              <td>{{$order->date_of_order}}</td>
                              <!--<td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>-->
                                      @if(isset($order->user))
                                      <td>{{ $order->user->name }}</td>
                                      @else
                                          <td>----</td>
                                      @endif

                               <td>{{ $order->total_price}}</td>
                            <!--<td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid):'----' }}</td>-->
                               <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                               <td>{{ $order->rest_value?$order->rest_value:'----'}}</td>
                                <!--<td>{{ $order->received_direct_sell_money_from_f_m?$order->received_direct_sell_money_from_f_m:'----'}}</td>-->
                                
                                <td>
                                    
                                {{$order->total_price - $order->net_profit}}

                                </td>
                                
                              <td>
                                <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                  {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                      <i class="fa fa-motorcycle"></i>
                                  </a> --}}

                                  
                              </td>
                          </tr>
                                    @endif
                        
                                @else
                        <tr>
                              <th scope="row">{{ ++$i }}</th>
                              <!--<td>{{$order->direct_selle_confirm_delivery_receipt==1?"تم البيع":"لم يكتمل بعد"}}</td>-->
                              <td>
                              @if($order->type=="total")
                                         جمله
                                  @else
                                         قطاعى
                                  @endif
                                </td>
                                  
                              <td>
                              @if($order->invoice_type==1)
                                        بيان اسعار
                                  @elseif($order->invoice_type==2)
                                        فواتير مبيعات
                                  @elseif($order->invoice_type==0)
                                        بيان اسعار
                                  @else
                                        مرتجع مبيعات
                                  @endif
                                  </td>
                              <td>{{$order->date_of_order}}</td>
                              <!--<td>{{isset($order->date_of_receipt)?$order->date_of_receipt:"----"}}</td>-->
                                        @if(isset($order->user))
                              <td>{{ $order->user->name }}</td>
                                        @else
                                  <td>----</td>
                                        @endif

                               <td>{{ $order->total_price}}</td>
                                <!--<td>{{ isset($order->total_minus_paid)?($order->total_price-$order->total_minus_paid):'----' }}</td>-->
                               <td>{{ $order->paid_value?$order->paid_value:'----'}}</td>
                               <td>{{ $order->rest_value?$order->rest_value:'----'}}</td>
                                <!--<td>{{ $order->received_direct_sell_money_from_f_m?$order->received_direct_sell_money_from_f_m:'----'}}</td>-->
                                <td>
                                    
                                    {{$order->total_price - $order->net_profit}}
                                    
                                </td>
                              <td>
                                <a href="{{ url('admin/orders/show/'. $order->id ) }}" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                  {{-- <a href="{{ url('admin/orders/' . $order->id . '/track') }}" class="btn btn-success">
                                      <i class="fa fa-motorcycle"></i>
                                  </a> --}}


                                  
                              </td>
                          </tr>
                        
                                @endif
                          
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
