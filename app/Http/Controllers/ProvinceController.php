<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends ApiController
{
    /**
     * Display a listing of the province.
     *
     * */
    /**
     * @OA\Get(
     * path="/api/provinces",
     *   summary="Get All Provinces",
     *   description="Get Provinces details",
     *   operationId="GetProvincesDetails",
     *   tags={"Provinces"},
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
        $provinces = Province::orderBy('id', 'DESC')
                    ->get();
        $data = [
            'message' => 'List of Provinces',
            'provinces' => $provinces,
        ];
        return $this->successResponse($data, 200);
    }

    /**
     * @OA\Post(
     * path="/api/provinces",
     *   tags={"Provinces"},
     *   security={ {"bearer":{} } },
     *   summary="Register a province",
     *   operationId="registerProvinces",
     *   description="Register a province",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"name"},
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
            'name' => ['required', 'string', 'min:3', 'max:20']
        ]);

        $province = Province::create([
            'name' => $request->name,
        ]);
        return $this->successResponse(['province'=>$province], 201, 'Province created successfully');
    }


     /**
     * @OA\Get(
     * path="/api/provinces/{province}",
     *   summary="Get A Single Province",
     *   description="Get Provinces details",
     *   operationId="GetProvinceDetails",
     *   tags={"Provinces"},
     *   security={ {"bearer":{} } },
     *   @OA\Parameter(
     *      name="province",
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
    public function show(Province $province)
    {
        $data = [
            'message' => 'Province Detail',
            'province' => $province
        ];

        return $this->successResponse($data, 200);

    }

    /**
     * @OA\Put(
     * path="/api/provinces/{province}",
     *   tags={"Provinces"},
     *   security={ {"bearer":{} } },
     *   summary="Update a province",
     *   operationId="UpdateProvince",
     *   description="update a province",
     * @OA\Parameter(
     *      name="province",
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
     *          @OA\Property(property="name", type="text"),
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

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name'=>['required', 'string', 'min:3', 'max:20']
        ]);

        $province->update([
            'name' => $request->name,
        ]);

        $data = [
            'message' => 'Province updated successfully',
            'province' => $province,
        ];
        return $this->successResponse($data, 200);
    }

}
