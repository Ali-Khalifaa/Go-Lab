@extends('layouts.main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@section('content')


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <h2> رسائل العملاء</h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content table-scrollable">

                <table id="table_id" class="table table-striped table-bordered table-advance table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم العميل</th>
                        <th> التواصل</th>
                        <th>الرساله</th>
                        <th>وقت الرساله</th>

                        <th width="15%">التحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $i=>$contact)

                        <tr>
                            <th scope="row">{{++$i}}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->contact_type }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->created_at }}</td>

                            <td>
                                <form method="POST" onclick="return confirm('هل انت متأكد؟')"
                                      action="{{ url('admin/contact_message/'.$contact['id']) }}"
                                      style="display:inline">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button name="_method" new="hidden" value="DELETE"
                                            class="btn btn-outline btn-circle dark btn-sm black">
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
@section('js')
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
