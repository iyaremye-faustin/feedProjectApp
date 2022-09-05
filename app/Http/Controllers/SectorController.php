<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends ApiController
{

    /**
     * @OA\Get(
     * path="/api/sectors",
     *   summary="Get All Sectors",
     *   description="Get Sectors details",
     *   operationId="GetSectorsDetails",
     *   tags={"Sectors"},
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
        $sectors = Sector::orderBy('id', 'DESC')
                    ->get();
        $data = [
            'message' => 'List of sectors',
            'sectors' => $sectors,
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'districtId' => ['required'],
        ]);

        //data creation
        $sector = Sector::create([
            'name' => $request->name,
            'districtId' => $request->districtId,
        ]);

        //return response (stored sector data)
        $data = [
            'message' => 'Sector created successfully',
            'sector' => $sector,
            'status' => 200,
        ];

        return $this->successResponse($data, 200);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Sector $sector)
    {
        //single sector
        $data = [
            'message' => 'Sector Detail',
            'sector' => $sector,
            'status' => 200,
        ];

        return $this->successResponse($data, 200);
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
        $data = [
            'message' => 'Sector updated successfully',
            'sector' => $sector,
            'status' => 200,
         ];

         return $this->successResponse($data, 200);
    }


}
