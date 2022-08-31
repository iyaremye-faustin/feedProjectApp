<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    // function register(Request $request){
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => [
    //             'required',
    //             'string',
    //             'email',
    //             'max:255',
    //             Rule::unique(User::class),
    //         ],
    //         //'password' =>['required'],
    //         'national_id' => ['required','digits:10','numeric'],
    //         'address' => ['required'],
    //         'role' => ['required']
    //     ]);

        
    //     $newuser = User::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'national_id' => Hash::make($request['national_id']),
    //         'provinceId' => $request['provinceId'],
    //         'districtId' => $request['districtId'],
    //         'sectorId' => $request['sectorId'],
    //         'password' => Hash::make($request['password']),
    //         //'phone_number' => $request['address'],
    //         'address' =>$request['address'],
    //         'roleId' =>$request['roleId'], 
    //     ])->save();

    //     return response()->json('Thank you welcom!');
   
        
    // }

    function login(Request $request){
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);


        $user=User::where('email',$request->email)->first();
        if(!$user){
            return response(['message'=>'User not found'],401);
        }

        elseif(!Hash::check($request->password,$user->password)){

            return response(['message'=>'wrong password'],401);
        }

        $token  = $user->createToken('error')->plainTextToken;

        return response([
            'token'=>$token,
            'user'=>$user
        ]);

    }

    function logout(Request $request){
        $request->user()->tokens()->delete();

        return response(['message'=>'logged out'],201);
    }
}
