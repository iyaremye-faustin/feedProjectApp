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

        return response()->json([
            'provinces' => $provinces,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
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
        return response()->json([
            'message' => 'Province created successfully',
            'province' => $province,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Province $province)
    {
        //single province
        return response()->json([
            'province' => $province,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Province $province)
    {
        
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
        return response()->json([
            'message' => 'Province updated successfully',
            'province' => $province,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Province $province)
    {
        $province->delete();

         //return response (updated province data)
        return response()->json([
            'message' => 'Province deleted successfully',
        ], 200);
    }
}
