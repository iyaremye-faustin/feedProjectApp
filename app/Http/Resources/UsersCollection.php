<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->map(function($user){
            return [
                "name"=>$user->name,
                "email"=>$user->email,
                'roleName'=>$user->role->name,
                "provinceName"=>$user->province->name,
                "createdAt"=>date($user->created_at),
            ];
        });
    }
}
