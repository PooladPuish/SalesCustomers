<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Buy\Entities\Buy;
use Modules\Store\Entities\Store;

class UserController extends Controller
{
    //گرفتن تاییده از سیستم پولاد و دادن تاییده دسترسی به نماینده فروش
    public function success(Request $request)
    {
        $agent_id = $request->get('agent_id');
        $users = User::where('agent_id', $agent_id)->get();
        foreach ($users as $user)
            User::find($user->id)->update([
                'success' => 1,
            ]);
    }

    //گرفتن رد درخواست نمایندگی مشتری از سیستم پولاد و گرفتن دسترسی های نماینده فروش
    public function error(Request $request)
    {
        $agent_id = $request->get('agent_id');
        $users = User::where('email', $agent_id)->get();
        foreach ($users as $user)
            User::find($user->id)->update([
                'success' => 0,
            ]);
    }

    //ارسال درخواست های تایید نشده نمایندگان فروش برای سیستم پولاد
    public function SalesCustomers()
    {
        $salescustomers = \App\User::whereNull('success')->get();
        return response()->json($salescustomers);
    }

//گرفتن اطلاعات ویرایش شده نماینده از طرف پولاد و ثبت ان در پروفایل پرسنل
    public function EditUser(Request $request)
    {

        $agent_id = $request->get('agent_id');
        $users = User::where('agent_id', $agent_id)->get();
        foreach ($users as $user)
            User::find($user->id)->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'success' => $request->get('success'),
                'password' => $request->get('password'),
            ]);

    }

    public function api()
    {

        $api = Store::get();
        return \response()->json($api);


    }

    public function buy()
    {

        $buys = Buy::where('status', null)->get();
        foreach ($buys as $buy)
            Buy::find($buy->id)->update([
                'status' => 1,
            ]);

        return \response()->json($buys);


    }


}
