<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class RoleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     * path="/api/roles",
     *   summary="Get All Roles",
     *   description="Get roles details",
     *   operationId="GetRolesDetails",
     *   tags={"Roles"},
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
    public function index()
    {
        $roles=Role::all();
        $data = [
            "message" => "List of roles",
            "roles" => $roles,
        ];
        return $this->successResponse($data,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }
    public function changeRole(Request $data)
    {
        $rules=[
            'email'=>'required|string|email|unique:users,email',
            'role'=>'required|string|exists:roles,name',
        ];
        $check=Validator::make($data->all(),$rules);
        if(!$check){
            return $this->errorResponse($check->messages(),400,"Invalid data in the request");
        }
    }
}
