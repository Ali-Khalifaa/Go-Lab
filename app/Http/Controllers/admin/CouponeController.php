<?php

namespace App\Http\Controllers\admin;

use App\Coupone;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CouponeController extends Controller
{
    // get all user by activity id
    function getUserByActivety($id)
    {
        $active = \App\ActivityType::find($id);
        $users = User::where([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
            ["shop_type", "=", $active->title],
        ])->orWhere([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
            ["shop_type", "=", $active->title_en],
        ])->get();
        return response()->json($users);
    }

    // get all user by activity id
    function getAllUserBromoCode()
    {
        $users = User::where([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
        ])->get();
        return response()->json($users);
    }

    function getAllUserDate(Request $request)
    {
        $users = User::where([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
            ["created_at",">=",$request->from],
            ["created_at","<=",$request->to],
        ])->get();

        return response()->json($users);
    }

    function getUserByOrder(Request $request)
    {
        $data = [];
        $users = User::where([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
        ])->get();
        foreach ($users as $user)
        {
            if (count($user->orders) > 0)
            {
                if ($user->orders->last()->total_price >= $request->num )
                {
                    $data[] = $user;
                }
            }
        }
        return response()->json($data);
    }

    public function index()
    {
        $types = \App\Coupone::all();
        return view('admin.coupons.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\Coupone::all();
        return view('admin.coupons.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'title_en' => 'required|string|max:100',
            'percentage' => 'required|integer|min:1',
            'end_date' => 'required|date|after:today',
            'code_type' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->code_type == "0") {
            $code = Str::random(8);
        } else {
            $code = $request->code;
        }

        \App\Coupone::create([
            'title' => $request->title,
            'title_en' => $request->title_en,
            'code' => $code,
            'percentage' => $request->percentage,
            'end_date' => $request->end_date,
        ]);

        session()->flash('success', ' تمت الأضافة بنجاح ');
        return redirect('admin/coupons');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = \App\Coupone::find($id);
        $users = User::where([
            ["type", "=", "user"],
            ["location", "!=", null],
            ["token", "!=", null],
            ["status", "=", 1],
        ])->get();

        $activity_type = \App\ActivityType::all();

        return view('admin.coupons.show', compact('coupon','users','activity_type'));
    }

    public function notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users' => 'required',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $users = $request->users;
        $code = Coupone::find($request->coupon_id);

        $SERVER_API_KEY = 'AAAALUzsKi4:APA91bEV9A-d9ri5jjPSa-W5FgjBahD9B3GwuqhrvcNcqSZ5N4m4tf0hFmoFogLEDlyGYdhL8-dagpbMsKBz2fvm2O0GhHkwpwS6G_g0DNR33a-32cjCxylTioGV9sBMC3jFith1V46u';

        foreach ($users as $user_id)
        {
            $user = User::find($user_id);

            $token_1 = $user->token;

            $data = [
                "registration_ids" => [
                    $token_1
                ],
                "data" => [
                    'type' => 'promoCode',
                    'productData' => json_encode($code),
                ],

                "notification" => [

                    "title" => "كوبون خصم",

                    "body" => $request->message,

                    "sound" => "default",// required for sound on ios

                    "click_action"=> "FLUTTER_NOTIFICATION_CLICK"

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


        session()->flash('success',' تمت الارسال بنجاح ');
        return redirect('admin/coupons');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = \App\Coupone::find($id);

        return view('admin.coupons.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'title_en' => 'required|string|max:100',
            'percentage' => 'required|integer|min:1',
            'end_date' => 'required|date',
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $contacts = \App\Coupone::find($id);
        $request_data = $request->all();

        $contacts->update($request_data);
        session()->flash('success', 'تم التعديل بنجاح');
        return redirect('admin/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = \App\Coupone::destroy($id);
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }
}
