<?php
namespace App\Http\Controllers\api;


trait ApiResponceTrait{

    public $paginateNumber=10;
    public function ApiResponce($data=null,$messages=null,$error=null,$code=200){

        $array=[
            'data'=>$data,
            'status'=>$code== in_array( $code, $this->SuccessCode()) ? true : false ,
            'error'=>$error,
            'message'=>$messages,
        ];
        return response($array,$code);

    }


    public function SuccessCode(){
        return[
            200,201,202
        ];
    }


    public function ApiFail(){
        return $this->ApiResponce(null,'not found',404);
    }

}

