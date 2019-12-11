<?php

namespace Modules\Store\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Store;
use Morilog\Jalali\Jalalian;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    //دریافت موجودی انبار از سیستم پولاد و ذخیره در سیستم نمایندگان
    public function store(Request $request)
    {
        $name = $request->get('name');
        $code = $request->get('code');
        $number = $request->get('number');
        $stores = Store::where('code', $code)->get();
        foreach ($stores as $store)
            if (!empty($store)) {
                Store::find($store->id)->update([
                    'number' => $number,
                ]);
                return back();
            }
        Store::create([
            'name' => $name,
            'code' => $code,
            'number' => $number,
        ]);
        return back();
    }

    //نمایش لیست انبار
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $checkUsers = Store::get();
            return DataTables::of($checkUsers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('code', function ($row) {
                    return $email = "<label class=\"btn btn-danger\">{$row->code}</label>";
                })
                ->addColumn('number', function ($row) {
                    if ($row->number == 0) {
                        return $email = "<label class=\"btn btn-info\">موجود نیست</label>";

                    }
                    return $email = "<label class=\"btn btn-primary\">{$row->number}</label>";
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.store.user.wizard', $row->id) . '"><img src="/icon/icons8-click-&-collect-64.png" title="سفارش خرید" width="30" height="30"></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'code', 'number'])
                ->make(true);
        }
        return view('store::list');

    }

    //نمایش لیست فرم درخواست سفارش
    public function wizard(Store $id)
    {

        return view('store::wizard', compact('id'));

    }

}
