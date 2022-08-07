<?php

namespace App\Http\Controllers\admin;

use App\Notify;
use App\Notify_user;
use App\Notify_user_unit;
use App\Product;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class user_notifies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $notify_users =  Notify_user::all();
        return view('admin.user_notifies.index',compact('notify_users'));
    }
    public function selectToCreate()
    {
        $users = User::all();
        $notifies = Notify::all();
        return view('admin.user_notifies.select_create',compact('users','notifies'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $request->validate([
            'user_id' =>'required',
            'store_id_notify'=> 'required'
        ]);
        /*
         * Check First If User Have A Notify User On This Notify Or Not
         */
        $user = User::find($request->user_id);
        $user_notify = $user->notify_users()->where('notify_id',$request->store_id_notify)->get()->first();
        if(!is_null($user_notify))
        {
            return redirect()->to('admin/user_notifies/'.$user_notify->id.'/edit')->withErrors('هذا العميل موجود بالفعل من ضمن العملاء المميزين');
        }
        /*
         *  Get The Elements Of The Notify Selected
         */
        $notify = Notify::find($request->store_id_notify);
        $notify_units = $notify->notify_units;

        return view('admin.user_notifies.create_notify', compact('user','notify','notify_units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /*
         * Get The Notify Of The Store
         */
        $notify = Notify::find($request->notify_id);
        $notify_user = new Notify_user($request->all());
        foreach ($request->info as $notify_user_unit){
            // Check Later Unit and Later Total
            // Check Also if now + later discount it equal the discount rete
            $validator = Validator::make($notify_user_unit,[
                'now_total' =>'required',
                'later_total' =>'required',
                'now_unit' =>'required',
                'later_unit' =>'required',
                'discount_unit' =>'required',
                'discount_total' =>'required',
            ]);
            if ($validator->fails())
            {
                $notify_user->notify_user_units()->delete();
                $notify_user->delete();
                return back()->withErrors('نسبة المكافأه والأجلة والفورية مطلوية');
            }
            /*
             *  If The Notify Is Global Dont Check
             */
            if ($notify->store_id != 0)
            {
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_user_unit,[
                    'discount_unit' => 'in:'.($notify_user_unit['now_unit']+$notify_user_unit['later_unit']),
                    'discount_total' => 'in:'.($notify_user_unit['now_total']+$notify_user_unit['later_total']),
                ]);
                if ($validator->fails())
                {
                    $notify_user->notify_user_units()->delete();
                    $notify_user->delete();
                    return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                }
            }
            $notify_user->save();
            $notify_user_unit = new Notify_user_unit($notify_user_unit);
            $notify_user_unit->notify_user_id = $notify_user->id;
            $notify_user_unit->save();

        }
        return redirect('admin/user_notifies/'.$notify_user->id)->with('تم اضافة المكافأه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $notify = Notify_user::find($id);
        return view('admin.user_notifies.show',compact('notify'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $notify_user = Notify_user::find($id);
        $notify = Notify::find($notify_user->notify_id);
        $notify_units = $notify_user->notify_user_units;
        $user = $notify_user->user;
        return view('admin.user_notifies.edit',compact('notify','notify_user','user','notify_units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        /*
         * Get The Notify Of The Store
         */
        $notify_user = Notify_user::find($id);
        $notify = $notify_user->notify;
        foreach ($request->info as $notify_user_unit){
            // Check Later Unit and Later Total
            // Check Also if now + later discount it equal the discount rete
            $validator = Validator::make($notify_user_unit,[
                'now_total' =>'required',
                'later_total' =>'required',
                'now_unit' =>'required',
                'later_unit' =>'required',
                'discount_unit' =>'required',
                'discount_total' =>'required',
            ]);
            if ($validator->fails())
            {
                return back()->withErrors('نسبة المكافأه والأجلة والفورية مطلوية');
            }
            /*
             *  If The Notify Is Global Dont Check
             */
            if ($notify->store_id != 0)
            {
                // Check Also if now + later discount it equal the discount rete
                $validator = Validator::make($notify_user_unit,[
                    'discount_unit' => 'in:'.($notify_user_unit['now_unit']+$notify_user_unit['later_unit']),
                    'discount_total' => 'in:'.($notify_user_unit['now_total']+$notify_user_unit['later_total']),
                ]);
                if ($validator->fails())
                {
                    $notify_user->notify_user_units()->delete();
                    $notify_user->delete();
                    return back()->withErrors('يجب ان يكون نسبة المكافأه الأجلة + الفورية مساوية لنسية المكافأه');
                }
            }
            $notify_user->save();
            $notify_unit = Notify_user_unit::find($notify_user_unit['unit_id']);
            $notify_unit->update($notify_user_unit);
        }
        return redirect('admin/user_notifies/'.$notify_user->id)->with('تم تعديل المكافأه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $notify_user = Notify_user::findOrFail($id);
        $notify_user->notify_user_units()->delete();
        $notify_user->delete();
        return redirect('admin/user_notifies')->with('تم حذف المكافأه بنجاح');
    }
}
