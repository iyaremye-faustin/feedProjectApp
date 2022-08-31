<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Sector;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Mail\SendAccountConfirm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends ApiController
{
    /**
     * @OA\Post(
     * path="/api/user",
     *   tags={"Users"},
     *   summary="Register a user",
     *   operationId="registerUsers",
     *   description="Register a user",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"name","email","role","province","identificationnumber"},
     *          @OA\Property(property="name", type="text"),
     *          @OA\Property(property="email", type="text"),
     *          @OA\Property(property="role", type="text"),
     *          @OA\Property(property="province", type="text"),
     *          @OA\Property(property="district", type="text"),
     *          @OA\Property(property="sector", type="text"),
     *          @OA\Property(property="identificationnumber", type="text"),
     *        )
     *       ),
     *   ),
     *   @OA\Response(
     *    response=201,
     *    description="Successfully registered",
     *    @OA\JsonContent(),
     *   )
     * )
     */
    public function userRegister(Request $user)
    {
        $rules=[
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users,email',
            'role'=>'required|string|exists:roles,name',
            'province'=>'required|string|exists:provinces,name',
            'district'=>'string|exists:districts,name',
            'sector'=>'string|exists:provinces,name',
            'identificationnumber'=>'required|string|min:10'
        ];
        $check=Validator::make($user->all(),$rules);
        if($check->fails()){
            $errors=$check->messages();
            return $this->errorResponse($errors,400,"Invalid data in the request");
        }
        $role=Role::where('name',$user->role)->first();
        if(!$role){
            return $this->errorResponse('',400,"Invalid role name");
        }
        $province=Province::where('name',$user->province)->first();
        $district=District::where('name',$user->district)->first();
        $sector=Sector::where('name',$user->sector)->first();
        $newUser=new User();
        $newUser->name=$user->name;
        $newUser->email=$user->email;
        $newUser->roleId=$role->id;
        $newUser->provinceId=$province->id;
        if($district){
            $newUser->districtId=$district->id;
        }
        if($sector){
            $newUser->sectorId=$sector->id;
        }
        $newUser->idNumber=$user->identificationnumber;
        $newUser->password=Hash::make('123456789');
        $newUser->save();
        Mail::to($user->email)->send(new SendAccountConfirm($user->name,'123456789'));
        $data=array('message'=>'User successfully registered','status'=>201);
        return $this->successResponse($data,201);
    }
}
