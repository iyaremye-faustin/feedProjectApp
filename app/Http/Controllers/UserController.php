<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
     /**
     * @OA\Post(
     * path="/api/login",
     *   tags={"Users"},
     *   summary="Login a user",
     *   operationId="loginUser",
     *   description="Login a user",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"email","password"},
     *          @OA\Property(property="email", type="text"),
     *          @OA\Property(property="password", type="text"),
     *        )
     *       ),
     *   ),
     *   @OA\Response(
     *    response=201,
     *    description="Successfully logged in",
     *    @OA\JsonContent(),
     *   )
     * )
     */

    function login(Request $request){
        $rules=[
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string',
        ];
        $check=Validator::make($request->all(),$rules);
        if($check->fails()){
            return $this->errorResponse($check->messages(),400,"Invalid data in the request");
        }

        $user=User::where('email',$request->email)->first();
        if(!$user){
            return $this->errorResponse('',401,"Invalid email Address");
        }
        if(!Hash::check($request->password,$user->password)){
            return $this->errorResponse('',401,"Invalid email or password");
        }

        $token  = $user->createToken('error')->plainTextToken;
        $response=[
            'message'=>"Logged in successfully",
            'token'=>$token,
            'user'=>new UserResource($user)];
        return $this->successResponse($response,200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     * path="/api/logout",
     *   summary="Logging out a user",
     *   description="Log out",
     *   operationId="Logout",
     *   tags={"Users"},
     *   security={ {"bearer":{} } },
     *
     *   @OA\Response(
     *     response=200,
     *       description="Loggedout successfully",
     *     @OA\MediaType(
     *        mediaType="application/json",
     *      )
     *   )
     * )
     */
    function logout(Request $request){
        $request->user()->tokens()->delete();
        $data=['message'=>'logged out'];
        return $this->successResponse($data,200);
    }
      /**
     * @OA\Get(
     * path="/api/users",
     *   summary="Get All Users",
     *   description="Get users details",
     *   operationId="GetUsersDetails",
     *   tags={"Users"},
     *   security={ {"bearer":{} } },
     *
     *   @OA\Response(
     *     response=200,
     *       description="Fetched successfully",
     *     @OA\MediaType(
     *        mediaType="application/json",
     *      )
     *   )
     * )
     */
    public function users(){
        try {
            $users=User::all();
            $data=["message"=>'List of users',"users"=>new UsersCollection($users)];
            return $this->successResponse($data,200);
        } catch (\Throwable $th) {
            return $this->errorResponse($th,500,"Internal server error");
        }
    }
}
