<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the province.
     *
     * */
    public function index()
    {
        $provinces = Province::orderBy('id', 'DESC')
                    ->get();
        $data = [
            'message' => 'List of Provinces',
            'provinces' => $provinces,
            'status' => 200,
        ];            

        return $this->successResponse($data, 200);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        //data validation
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20']
        ]);
        
        //data creation
        $province = Province::create([
            'name' => $request->name,  
        ]);

        //return response (stored province data)
        return $this->successResponse($province, 200, 'Province created successfully');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Province $province)
    {
        //single sector
        $data = [
            'message' => 'Sector Detail',
            'sector' => $province,
            'status' => 200,
        ];

        return $this->successResponse($data, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Province $province)
    {
        //data validation
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20']
        ]);
        
        //update data
        $province->update([
            'name' => $request->name,  
        ]);

        //return response (updated province data)
        $data = [
            'message' => 'Province updated successfully',
            'province' => $province,
            'status' => 200,
        ];

        return $this->successResponse($data, 200);
    }

}
