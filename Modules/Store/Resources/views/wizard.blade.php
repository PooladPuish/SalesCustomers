@extends('layouts.master')
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">ثبت سفارش</h3>
        </div>
    @include('massage.msg')
    {{--    @include('massage.msg')--}}
    <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('admin.buy.users.store')}}">
                @csrf
                <input type="hidden" name="id" value="{{$id->id}}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>نام محصول</label>
                            <input type="text" name="name" class="form-control" value="{{$id->name}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>کد محصول</label>
                            <input type="text" name="code" class="form-control" value="{{$id->code}}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>تعداد</label>
                            <input type="number" name="number" class="form-control">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea name="description" id="mytextarea"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>


                </div>
                <div class="col-md-1">
                    <input type="submit" value="ثبت" class="form-control btn btn-success">
                </div>
                <div class="col-md-1">
                    <a href="{{route('admin.store.user.list')}}" class="form-control btn btn-danger">برگشت</a>
                </div>
            </form>
        </div>
    </div>


@endsection
