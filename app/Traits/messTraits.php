<?php
namespace App\Traits;

Trait MessTraits {

public function error($data, $mess, $code ){
    return  response()->json(
        [
        'status'=>'error',
    'message'=>$mess,

        'data'=> $data,
        ],
        $code 
    );
}

public function success($data, $mess, $code = 200 ){
    return  response()->json([
    'status'=>'success',
    'message'=>$mess,
    'data'=> $data,
    ],
    $code 
    );
}

}