<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the sector.
     *
     * */
    public function index()
    {
        $sector = Sector::orderBy('id', 'DESC')
                    ->get();

        return response()->json([
            'sector' => $sector,
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'districtId' => ['required']
        ]);
        
        //data creation
        $sector = Sector::create([
            'name' => $request->name,  
            'districtId' => $request->districtId,
        ]);

        //return response (stored sector data)
        return response()->json([
            'message' => 'Sector created successfully',
            'sector' => $sector,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Sector $sector)
    {
        //single sector
        return response()->json([
            'sector' => $sector,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Sector $sector)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Sector $sector)
    {
        //data validation
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'districtId' => ['required']
        ]);
        
        //update data
        $sector->update([
            'name' => $request->name,
            'districtId' => $request->districtId,  
        ]);

        //return response (updated sector data)
        return response()->json([
            'message' => 'Sector updated successfully',
            'sector' => $sector,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();

         //return response (updated sector data)
        return response()->json([
            'message' => 'Sector deleted successfully',
        ], 200);
    }
}
