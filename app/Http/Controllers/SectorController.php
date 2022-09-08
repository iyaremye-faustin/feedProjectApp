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
     *   security={{"bearerAuth":{}}},
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
     /**
     * @OA\Post(
     * path="/api/sectors",
     *   tags={"Sectors"},
     *   security={{"bearerAuth":{}}},
     *   summary="Register a sector",
     *   operationId="registerSectors",
     *   description="Register a sector",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"districtId"},
     *          required={"name"},
     *          @OA\Property(property="districtId", type="text"),
     *          @OA\Property(property="name", type="text"),
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
    /**
    * @OA\Get(
        * path="/api/sectors/{sector}",
        *   summary="Get A Single Sector",
        *   description="Get Sector details",
        *   operationId="GetSectorDetails",
        *   tags={"Sectors"},
        *   security={{"bearerAuth":{}}},
        *   @OA\Parameter(
        *      name="sector",
        *      in="path",
        *      required=true,
        *      @OA\Schema(
        *           type="string"
        *      )
        *   ),
        *   @OA\Response(
        *     response=200,
        *       description="Fetched successfully",
        *     @OA\MediaType(
        *        mediaType="application/json",
        *      )
        *   )
        * )
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
