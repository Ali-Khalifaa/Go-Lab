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
    use ApiResponceTrait ;
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
        $shop_type=Shop_Type::all();
        return response()->json($shop_type);

    }

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }


    public function login()
    {

        $credentials = request(['id', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->ApiResponce(response()->json(['error' => 'Unauthorized'], 401),false,'Unauthorized');
        }

        return $this->ApiResponce($this->respondWithToken($token));
        // return $this->ApiResponce(
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

    public function register(Request $request){



        //start new register

        $validator =Validator::make($request->all(),[
            'id'    =>  'required|unique:users',
            'name'    =>  'required',
            'email'    =>  'required',
            'password'    =>  'required',
            'address'    =>  'required',
            'location'    =>  'required',
            'token'    =>  'required',
            'client_type'=>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ], 400);
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
            'client_type' => $request['client_type'],
            'token' => $request['token'],
        ]);
        $user->save();
        $user->attachRole('user');

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->ApiResponce(response()->json(['error' => 'Unauthorized'], 401),false,'Unauthorized');
        }

        $filename = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $filename);

        $user->image=$filename;
        $user->save();

        return $this->ApiResponce($this->respondWithToken($token));
        // end new register

    }

    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'id'    =>  'required',
            'secound_phone'    =>  'required',
            'name'    =>  'required',
            'email'    =>  'required',
            'image'    =>  'required',
            'password'    =>  'required',
            'shop_name'    =>  'required',
            'shop_type'    =>  'required',
            'place_id'    =>  'required',
            'address'    =>  'required',
            'location'    =>  'required',
            'token'    =>  'required',
        ]);
        if ($validation->fails())
        {
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

    public function search(Request $request){

        if ($search = $request->name) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->first();
        }else{
            $users = User::latest()->paginate(5);
        }

        return $users;

    }


    public function update(Request $request ,$id)
    {


        $user =User::find($id);
        $current_time = Carbon::now()->format('Y-m-d');
        if ($user){
            $user->update([
                // 'id' => $id,
                'name' => $request['name'],
                // 'email' => $request['email'],
                // 'image' => $request['image'],
                // 'password' => Hash::make($request['password']),
                'shop_name' => $request['shop_name'],
                'shop_type' => $request['shop_type'],
                'place_id' => $request['place_id'],
                'address' => $request['address'],
                'location' => $request['location'],
                'token' => $request['token'],
                // 'last_update' => $user->updated_at,
                // 'updated_at' => $current_time,
            ]);
            return $this->ApiResponce($user,['تم تحديث المستخدم بنجاح']);
        }
        return $this->ApiResponce(['هذا المستخدم غير موجود']);

    }




    public function calculateTokenLastUpdatedDate(Request $request ,$id)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $user =User::find($id);
        dd($user->updated_at);
        $updated_at=$user->updated_at;
        foreach($updated_at as $updated)
        {
          dd($updated->updated_at);
        }
         $to=$user->last_date;
       return $from=$user['updated_at'];
        $diff_in_days = $to->diffInDays($from);
        return $diff_in_days;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
            ['id','=',intval($request->phone_number)],
        ])->get()->first();
//        dd($request->phone);
        if (!is_null($user))
        {
            if (Hash::check($request->password, $user->password))
            {
                return $user;
            }
        }
        return 0;
    }
    /*
     * User Change Password
     * */
    public function userChangePassword( Request $request){

        $user =auth()->user();

        if ($user == null)
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'old_password' =>'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors,400);
        }

        if (Hash::check($request->old_password, $user->password))
        {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);
            return $this->ApiResponce(response()->json(['error' => 'change password successfully'], 200),true,'0');
//            return response()->json("change password successfully");

        }else{
            return $this->ApiResponce(response()->json(['error' => 'sorry the old password is not correct'], 400),false,'1');
        }
    }

    /*
     * user upload image
     */
    public function userUploadImage(Request $request ,User $user){
        $request->validate([
            'image' =>  'required',
        ]);
        $filename = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $filename);

        $user->image=$filename;
        $user->save();
        return $user;
    }

    protected function respondWithToken($token)
    {
        return response()->json([

            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user'=>auth()->user(),
        ]);
    }


}
