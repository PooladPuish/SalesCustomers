<?php

namespace Modules\Buy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buy\Entities\Buy;
use Modules\Store\Entities\Store;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\ReturnMsgError;
use function App\Providers\ReturnMsgSuccess;

class BuyController extends Controller
{
    //فرستادن درخواست خرید و همگام سازی جدول انبار نماینده ها با این درخواست
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
        ], [
            'number.required' => 'لطفا تعداد سفارش خود را وارد کنید',
        ]);
        $numbers = Store::where('id', $request->id)->get();
        foreach ($numbers as $number)
            if ($request->number > $number->number) {
                return ReturnMsgError('تعداد درخواست شما از موجودی انبار بیشتر میباشد');
            }
        Buy::create([
            'user_id' => auth()->user()->id,
            'store_id' => $number->id,
            'number' => $request['number'],
            'description' => $request['description'],
        ]);
        $stores = Store::where('code', $number->code)->get();
        foreach ($stores as $store)
            Store::find($store->id)->update([
                'number' => $number->number - $request->number,
            ]);

        return ReturnMsgSuccess('درخواست شما با موفقیت ثبت شد');

    }

//نمایش لیست سفارشات هر نماینده
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = Buy::where('user_id', auth()->user()->id)->get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $stores = Store::where('id', $row->store_id)->get();
                    foreach ($stores as $store)
                        return $store->name;
                })
                ->addColumn('code', function ($row) {
                    $stores = Store::where('id', $row->store_id)->get();
                    foreach ($stores as $store)
                        return $email = "<label class=\"btn btn-danger\">{$store->code}</label>";
                })
                ->addColumn('number', function ($row) {
                    if ($row->number == 0) {
                        return $email = "<label class=\"btn btn-info\">موجود نیست</label>";
                    }
                    return $email = "<label class=\"btn btn-primary\">{$row->number}</label>";
                })
                ->addColumn('created_at', function ($row) {
                    $created_at = Jalalian::forge($row->created_at)->ago();
                    return $email = "<label class=\"btn btn-primary\">{$created_at}</label>";
                })
                ->addColumn('replay', function ($row) {
                    if ($row->replay == "1") {
                        return $email = "<label class=\"btn btn-success\">تایید شده</label>";

                    } elseif ($row->replay == "0") {
                        return $email = "<label class=\"btn btn-danger\">تایید نشده</label>";

                    } else
                        return $email = "<label class=\"btn btn-info\">در انتظار پاسخ</label>";
                })
//                ->addColumn('action', function ($row) {
//                    $btn = '<a href="' . route('admin.store.user.wizard', $row->id) . '"><img src="/icon/icons8-click-&-collect-64.png" title="سفارش خرید" width="30" height="30"></a>';
//                    return $btn;
//                })
                ->rawColumns(['code', 'number', 'replay', 'created_at'])
                ->make(true);
        }

        return view('buy::index');

    }

//دریافت پیام موافقت با سفارش نماینده و ثبت در پروفایل
    public function buy(Request $request)
    {
        $id = $request->get('id');
        $buys = Buy::where('id', $id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'replay' => 1,
            ]);

    }

    //دریافت پیام رد درخواست با سفارش نماینده و ثبت در پروفایل
    public function error(Request $request)
    {
        $id = $request->get('id');
        $buys = Buy::where('id', $id)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'replay' => 0,
            ]);

    }


}
