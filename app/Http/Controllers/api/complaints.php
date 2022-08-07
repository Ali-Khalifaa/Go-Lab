<?php

namespace App\Http\Controllers\api;

use App\ComplaintType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complaint;
use Illuminate\Support\Facades\Validator;

class complaints extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = $request->header('lang');
        $data = [];
        if ($lang == 'ar')
        {
            $activities = ComplaintType::where('name','!=',null)->get(['id','name']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['name'] =$activity->name;
            }
        }else{
            $activities = ComplaintType::where('name_en','!=',null)->get(['id','name_en']);
            foreach ($activities as $index=>$activity)
            {
                $data[$index]['id'] =$activity->id;
                $data[$index]['name'] =$activity->name_en;
            }
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|min:11',
            'complaint_type_id' => 'required||exists:complaint_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'error' =>
                    $validator->errors()->toArray()
            ], 400);
        }
        return Complaint::create([
            'user_id' => $request['user_id'],
            'comment' => $request['comment'],
            'complaint_type_id' => $request['complaint_type_id'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        dd($id);
        $complaints = Complaint::findOrFail($id);
        $complaints = Complaint::destroy($id);
        return back();

    }
}
