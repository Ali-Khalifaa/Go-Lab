<?php

namespace App\Http\Controllers\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;

class contacts extends Controller
{
    public function index()
    {
        $contacts=Contact::all();
        return view('admin.contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts= Contact::all();
        return view('admin.contacts.create',compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:contacts,phone',
            'is_whats' => 'required',
        ]);
        $contacts = new Contact();
        $contacts->phone = $request->phone;
        $contacts->is_whats = $request->is_whats;
        $contacts->save();

        session()->flash('success','تمت الاضافة بنجاح');

        return redirect('admin/contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacts= Contact::find($id);
        return view('admin.contacts.edit',compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:contacts,phone' . ($id ? ",$id" : ''),
            'is_whats' => 'required',
        ]);
        $contacts = Contact::find($id);
        $contacts->phone = $request->phone;
        $contacts->is_whats = $request->is_whats;
        $contacts->save();
        session()->flash('success','تم التعديل بنجاح');
        return redirect('admin/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = Contact::destroy($id);
        session()->flash('success','تم الحذف بنجاح');
        return back();
    }
}
