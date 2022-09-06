<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
   
    /**
     * Display a listing of the district.
     *
     * */
    /**
     * @OA\Get(
     * path="/api/districts",
     *   summary="Get All Districts",
     *   description="Get Districts details",
     *   operationId="GetDistrictsDetails",
     *   tags={"Districts"},
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
        $district = District::orderBy('id', 'DESC')
                    ->get();
        $data = [
            'message' => 'List of Districts',
            'districts' => $district,
        ];
        return $this->successResponse($data, 200);
    }

    /**
     * @OA\Post(
     * path="/api/s",
     *   tags={"Districts"},
     *   security={ {"bearer":{} } },
     *   summary="Register a district",
     *   operationId="registerDistricts",
     *   description="Register a district",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"provinceId"},
     *          required={"name"},
     *          @OA\Property(property="provinceId", type="text"),
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
        $request->validate([
            'provinceId' => ['required', 'integer', 'max:5'],
            'name' => ['required', 'string', 'min:3', 'max:25']
        ]);

        $district = District::create([
            'provinceId' => $request->provinceId,
            'name' => $request->name,
        ]);
        return $this->successResponse(['district'=>$district], 201, 'District created successfully');
    }

    
    /**
     * @OA\Get(
     * path="/api/districts/{district}",
     *   summary="Get A Single District",
     *   description="Get Districts details",
     *   operationId="GetdistrictDetails",
     *   tags={"Districts"},
     *   security={ {"bearer":{} } },
     *   @OA\Parameter(
     *      name="district",
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
    public function show(District $district)
    {
        $data = [
            'message' => 'District Detail',
            'district' => $district
        ];

        return $this->successResponse($data, 200);

    }

    /**
     * @OA\Put(
     * path="/api/districts/{district}",
     *   tags={"Districts"},
     *   security={ {"bearer":{} } },
     *   summary="Update a district",
     *   operationId="UpdateDistrict",
     *   description="update a district",
     * @OA\Parameter(
     *      name="district",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"name"},
     *          required={"privinceId"},
     *          @OA\Property(property="name", type="text"),
     *          @OA\Property(property="provinceId", type="text"),
     *        )
     *       ),
     *   ),
     *   @OA\Response(
     *    response=200,
     *    description="Successfully updated",
     *    @OA\JsonContent(),
     *   )
     * )
     */

    public function update(Request $request, District $district)
    {
        $request->validate([
            'provinceId'=>['required', 'integer', 'min:10'],
            'name'=>['required', 'string', 'min:3', 'max:25']
        ]);

        $district->update([
            'provinceId' => $request->provinceId,
            'name' => $request->name,
        ]);

        $data = [
            'message' => 'District updated successfully',
            'district' => $district,
        ];
        return $this->successResponse($data, 200);
    }


    /**
     * Delete the specified resource.
     /**
     * @OA\Delete(
     * path="/api/districts/{district}",
     *   summary="Delete A Single District",
     *   description="Delete District details",
     *   operationId="DeleteDistrictDetails",
     *   tags={"Districts"},
     *   security={ {"bearer":{} } },
     *   @OA\Parameter(
     *      name="district",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *     response=200,
     *       description="Deleted successfully",
     *     @OA\MediaType(
     *        mediaType="application/json",
     *      )
     *   )
     * )
    */

    public function destroy(District $district)
    {
        $district->delete();

        $data = [
            'message' => 'District deleted successfully'
        ];

        return $this->successResponse($data, 200);
    }

    
}
