<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use Hash;
use Auth;
use App\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function option()
    {
        $option=Option::all();
        return view('option', compact('option'));
    }

    public function activeOption($id)
    {
        $option=Option::where('id',$id)->first();
        $option->is_active=1;
        $option->save();
        session()->flash('success','تم التفعيل بنجاح');
        // return view('option', compact('option'));
        return back();
    }

    public function deActiveOption($id)
    {
        $option=Option::where('id',$id)->first();
        $option->is_active=0;
        $option->save();
        session()->flash('success','تم ايقاف التفعيل بنجاح');
        // return view('option', compact('option'));
        return back();
    }


    public function passwords($id)
    {
        $user= User::find($id);
        return view('admin.passwords',compact('user'));

    }
    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required_with:password_confirmation|min:8|different:password|same:password_confirmation',
        ]);
        $user= User::find($id);

        if (Hash::check($request->password, Auth::user()->password)) {
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

           Session::flash('message', 'تم تغيير كلمة المرور');
           return redirect('passwords/'.Auth::id());

        } else {
            Session::flash('message',  'تاكد من كلمة المرور القديمه');
            return redirect('passwords/'.Auth::id());

        }
    }

}
