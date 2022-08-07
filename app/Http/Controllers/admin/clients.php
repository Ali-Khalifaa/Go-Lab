<?php

namespace App\Http\Controllers\admin;

use App\Place;
use App\User;
use App\Option;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class clients extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', 'user')->when($request->has('from_date'), function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->from_date);
        })->when($request->has('created_at'), function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->to_date);
        })->get();

        foreach ($users as $user) {
            $orders = $user->orders()->where([
                ['is_complete', '=', 1],
            ])->orderBy('date_of_order', 'desc')->get()->first();;
            $user->last_order = $orders;
            if (is_null($user->last_order)) {
                $user->last_order = '---';
            } else {
                $user->last_order = $user->last_order->date_of_order;
            }
        }
        return view('admin.clients.index', compact('users'));
    }

    public function userOreders($id)
    {
        $user = User::find($id);
        $orders = $user->orders()->where([
            ['is_complete', '=', 1],
            // ['is_direct_sell','=',0]
        ])->orderBy('order_stage_id', 'asc')->orderBy('date_of_order', 'desc')->get();

        $drepy = $user->orders()->where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1],
            ['fatora_dripa','=',1]
        ])->count();

        $not_drepy = $user->orders()->where([
            ['is_complete', '=', 1],
            ['is_direct_sell', '=', 1],
            ['fatora_dripa','=',0]
        ])->count();

        $option = Option::findOrFail(2)->is_active;

        if ($user->token == null) {
            return view('admin.Invoices.index', compact('orders', 'option','drepy','not_drepy'));
        } else {
            return view('admin.orders.index', compact('orders', 'option'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $places = Place::all();
        return view('admin.clients.edit', compact('user', 'places'));
    }

    public function update(Request $request, $id)
    {
        $request->id = (int)$request->id;
        $request->validate([
            'id' => ["required", Rule::unique('users')->ignore($id)],
            'name' => ["required", Rule::unique('users')->ignore($id)],
            'shop_name' => 'required',
            'shop_type' => 'required',
            'address' => 'required',
            'place_id' => 'required',
        ]);
        $user = User::findOrFail($id);
        $old_place_id = $user->place_id;
        $user->update($request->all());
        $user->id = $request->id;
//        $user->password = $password;
        $user->save();

        $new_place_id = $user->place_id;

        if ($user->place != null) {
            if ($user->place->store_id != null) {
                $store_id = $user->place->store_id;
            } else {
                $store_id = 0;
            }
        } else {
            $store_id = 0;
        }

        if ($old_place_id != $new_place_id) {
            $SERVER_API_KEY = 'AAAAO-WalX8:APA91bGiz4YRq_N73FMhLaeWBwnsSmv6FIHTx8PaqeCDmZKTAdaLpOos8t7r3CQ0D6XEPsDEfdVR4FyKt2A3t6zv7K5eaZ0Pi5Akze4aqvnPHzJ4PJr7pVIV5UE5ve9fTk4Vw08WlgXc';

            $token_1 = $user->token;

            $data = [

                "registration_ids" => [
                    $token_1
                ],
                "data" => ['type' => 'update-user-store', "store-id" => $store_id,],
                "notification" => [

                    "title" => 'تغير المنطقه',

                    "body" => ' لقد تم تغير منطقة العميل ',

                    "sound" => "default",// required for sound on ios

                    "image" => asset('images/logo.png'),


                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"

                ],

            ];

            $dataString = json_encode($data);

            $headers = [

                'Authorization: key=' . $SERVER_API_KEY,

                'Content-Type: application/json',

            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

        }
        session()->flash('success',' تم التعديل بنجاح ');

        return redirect('admin/clients');
    }
}
