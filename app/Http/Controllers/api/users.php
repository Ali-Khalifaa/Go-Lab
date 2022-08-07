<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Shop_Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class users extends Controller
{
    use ApiResponceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (true) {
            return User::all();
        }
    }

    public function getShopType()
    {
        $shop_type = Shop_Type::all();
        return response()->json($shop_type);

    }

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register', 'forgetPassword']]);
    }


    public function login(Request $request)
    {
        $credentials = request(['id', 'password']);
        $user = User::where('id',request(['id']))->first();

        if ($user)
        {
            if (Hash::check($request->password, $user->password)) {
                if (!$token = auth()->attempt($credentials)) {
                    return $this->ApiResponce(response()->json(['error' => 'Unauthorized'], 401), false, 'Unauthorized');
                }
                if ($request->header('token')){
                    $user->update([
                        "token" => $request->header('token')
                    ]);
                }
                return $this->ApiResponce($this->respondWithToken($token));
            }else{
                return $this->ApiResponce(response()->json(['error' => 1], 401), false, 1);
            }

        }else{

            if (!$token = auth()->attempt($credentials)) {
                return $this->ApiResponce(response()->json(['error' => 'Unauthorized'], 401), false, 'Unauthorized');
            }
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(Request $request)
    {
        //start new register

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'location' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ],400);
        }
        $check_email = User::where('id',$request['id'])->first();
        if ($check_email)
        {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'code' => 1,
                'error' => "قيمة التليفون مُستخدمة من قبل"
            ],400);
        }

        $check_rhone = User::where('email',$request['email'])->first();
        if ($check_rhone)
        {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'code' => 2,
                'error' => "قيمة البريد الالكتروني مُستخدمة من قبل",
            ],400);
        }


        $user = new User([
            'id' => $request['id'],
            'name' => $request['name'],
            'email' => $request['email'],
            'image' => $request['image'],
            'role' => 'user',
            'password' => Hash::make($request['password']),
            'shop_name' => $request['shop_name'],
            'shop_type' => $request['shop_type'],
            'place_id' => $request['place_id'],
            'address' => $request['address'],
            'location' => $request['location'],
            'token' => $request['token'],
        ]);
        $user->save();
        $user->attachRole('user');

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->ApiResponce(response()->json(['error' => 'Unauthorized'], 401), false, 'Unauthorized');
        }

        $filename = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $filename);

        $user->image = $filename;
        $user->save();

        return $this->ApiResponce($this->respondWithToken($token));
        // end new register

    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'secound_phone' => 'required',
            'name' => 'required',
            'email' => 'required',
            'image' => 'required',
            'password' => 'required',
            'shop_name' => 'required',
            'shop_type' => 'required',
            'place_id' => 'required',
            'address' => 'required',
            'location' => 'required',
            'token' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }
        $user = new User([
            'id' => $request['id'],
            'secound_phone' => $request['secound_phone'],
            'name' => $request['name'],
            'email' => $request['email'],
            'image' => $request['image'],
            'role' => 'user',
            'password' => Hash::make($request['password']),
            'shop_name' => $request['shop_name'],
            'shop_type' => $request['shop_type'],
            'place_id' => $request['place_id'],
            'work_time' => $request['work_time'],
            'car_type' => $request['car_type'],
            'address' => $request['address'],
            'location' => $request['location'],
            'token' => $request['token'],
        ]);
        $user->save();
        $user->attachRole('user');
        return $user;
    }

    public function show($id)
    {
        if (true) {
            return User::find($id);
        }
    }

    public function search(Request $request)
    {
        if ($search = $request->name) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->first();
        } else {
            $users = User::latest()->paginate(5);
        }
        return $users;
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $ext = $img->getClientOriginalExtension();
                $image_name = "user-" . uniqid() . ".$ext";
                $img->move(public_path('images/'), $image_name);

            }else{
               $image_name = $user->image;
            }

            $user->update([
                // 'id' => $request['phone'],
                'address' => $request['address'],
                'shop_name' => $request['shop_name'],
                'name' => $request['name'],
                'image' => $image_name,
            ]);

            return $this->ApiResponce($user, ['تم تحديث المستخدم بنجاح']);
        }
        return $this->ApiResponce(['هذا المستخدم غير موجود']);

    }

    public function calculateTokenLastUpdatedDate(Request $request, $id)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $user = User::find($id);
        dd($user->updated_at);
        $updated_at = $user->updated_at;
        foreach ($updated_at as $updated) {
            dd($updated->updated_at);
        }
        $to = $user->last_date;
        return $from = $user['updated_at'];
        $diff_in_days = $to->diffInDays($from);
        return $diff_in_days;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Sign In
     */
    public function signIn(Request $request)
    {
        // Attempt to log the user in
        $user = User::where([
            ['id', '=', intval($request->phone_number)],
        ])->get()->first();
//        dd($request->phone);
        if (!is_null($user)) {
            if (Hash::check($request->password, $user->password)) {
                return $user;
            }
        }
        return 0;
    }

    /*
     * User Change Password
     * */
    public function userChangePassword(Request $request)
    {
        $user = auth()->user();

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'change password successfully',
                'error' =>
                    "0"
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'sorry the old password is not correct',
                'error' =>
                    "1"
            ], 200);

        }
    }

    /*
     * User Change Password
     * */
    public function forgetPassword(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }
        $user = User::find($id);

        if ($user == null){
            $array=[
                'data'=>false,
                'status'=>false ,
                'error'=>1,
                'message'=>"هذا الرقم غير صحيح",
            ];

            return response($array);
        }
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return "successfully";
    }

    /*
     * user upload image
     */
    public function userUploadImage(Request $request, User $user)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $filename = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $filename);

        $user->image = $filename;
        $user->save();
        return $user;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }


}
