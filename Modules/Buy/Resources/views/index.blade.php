@extends('layouts.master')

@section('content')
    {{--    @include('massage.msg')--}}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست سفارشات</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped data-table">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام محصول</th>
                            <th>کد محصول</th>
                            <th>تعداد</th>
                            <th>تاریخ درخواست</th>
                            <th>وضعیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: '300px',
                sScrollX: '100%',
                sScrollXInner: '100%',
                scrollCollapse: true,
                paging: false,
                rowReorder: true,
                language: {
                    search: 'جستجو',
                    sZeroRecords: 'موردی با این مشخصات یافت نشد!',

                },
                ajax: "{{ route('admin.buy.user.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'number', name: 'number'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'replay', name: 'replay'},
                ]
            });
        });

    </script>
@endsection
