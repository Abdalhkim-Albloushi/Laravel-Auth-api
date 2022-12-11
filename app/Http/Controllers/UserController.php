<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;

use App\Traits\MessTraits;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use App\Models\User;



class UserController extends Controller
{
   use MessTraits;

   public function register(StoreUserRequest $request){

    $request->validated($request->all());

    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),

    ]);
return $this->success([
'user'=>$user,
'token'=>$user->createToken('Token of '.$request->name)->plainTextToken
],'success',201);
    
}


    public function login(LoginRequest $req){
        $req->validated($req->all());

        if(!Auth::attempt($req->only(['email', 'password']))){
            return $this->error(
                '',
                'password or email is Un Corrcet',
                401
            );
        }
      
        $user = User::where('email',$req->email)->first();
        
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('Token of '.$req->name)->plainTextToken
            ],'successful login');
        
    }
}
