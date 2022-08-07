@extends('layouts.main')
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> الشكاوي والمقترحات للمنتج</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table id="table_id" class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم اليوزر</th>
                        <th> اسم المنتج</th>
                        <th>الشكوي</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complaintsproducts as $i=>$complaint)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $complaint->user->name }}</td>
                            <td>{{ $complaint->product->name }}</td>
                            <td>{{ $complaint->comment }}</td>


                            <td>


                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/complaintsproducts/'.$complaint['id']) }}"
                                      style="display:inline">

                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button name="_method" new="hidden" value="DELETE" class="btn btn-outline btn-circle dark btn-sm black">
                                        <span class="fa fa-trash-o"></span> حذف
                                    </button>
                                </form>

                            </td>


                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
