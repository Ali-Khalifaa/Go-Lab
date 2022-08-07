<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactMessage extends Controller
{
    public function index(){
        $contacts=\App\ContactMessage::orderBy('id', 'DESC')->get();;
        return view('admin.contact_message.index',compact('contacts'));
    }

    public function destroy($id)
    {
        \App\ContactMessage::destroy($id);
        session()->flash('success','تم الحذف بنجاح');
        return back();
    }
}
