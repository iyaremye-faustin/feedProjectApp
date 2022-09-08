<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     /**
     * @OA\Get(
     * path="/api/seasons",
     *   summary="Get All Seasons",
     *   description="Get Seasons details",
     *   operationId="GetSeasonsDetails",
     *   tags={"Seasons"},
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
        $seasons = Season::orderBy('id', 'DESC')->get();
            $data = [
            'message' => 'List of Seasons',
            'seasons' => $seasons,
            ];
        return $this->successResponse($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     **
     * @OA\Post(
     * path="/api/seasons",
     *   tags={"Seasons"},
     *   security={{"bearerAuth":{}}},
     *   summary="Register a season",
     *   operationId="registerSeasons",
     *   description="Register a season",
     *   @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *          type="object",
     *          required={"name"},
     *          required={"description"},
     *          required={"startDate"},
     *          required={"endDate"},
     *
     *          @OA\Property(property="name", type="text"),
     *          @OA\Property(property="description", type="text"),
     *          @OA\Property(property="startDate", type="text"),
     *          @OA\Property(property="endDate", type="text"),
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
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'description' => ['required'],
            'startDate' => ['required', 'string', 'min:8', 'max:13'],
            'endDate' => ['required', 'string', 'min:8', 'max:13'],
        ]);

        $season = Season::create([
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate
        ]);
        return $this->successResponse(['season'=>$season], 201, 'Season created successfully');
    }

    /**
     * Display the specified resource.
     /**
     * @OA\Get(
     * path="/api/seasons/{season}",
     *   summary="Get A Single Season",
     *   description="Get Season details",
     *   operationId="GetSeasonDetails",
     *   tags={"Seasons"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *      name="season",
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

    public function show(Season $season)
    {
        $data = [
            'message' => 'Season Detail',
            'season' => $season
        ];

        return $this->successResponse($data, 200);
    }

    /**
     * UPDATE A SEASON
    /**
     * @OA\Put(
     * path="/api/seasons/{season}",
     *   tags={"Seasons"},
     *   security={{"bearerAuth":{}}},
     *   summary="Update a season",
     *   operationId="UpdateSeason",
     *   description="update a season",
     * @OA\Parameter(
     *      name="season",
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
     *          @OA\Property(property="name", type="text"),
     *          @OA\Property(property="description", type="text"),
     *          @OA\Property(property="startDate", type="text"),
     *          @OA\Property(property="endDate", type="text"),
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

    public function update(Request $request, Season $season)
    {
        $request->validate([
            'name' => ['string', 'min:3', 'max:20'],
            'description' => ['string'],
            'startDate' => ['string', 'min:8', 'max:13'],
            'endDate' => ['string', 'min:8', 'max:13'],
        ]);

        $season->update([
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate
        ]);
        $data = [
            'message' => 'Season updated successfully',
            'Season' => $season,
        ];
        return $this->successResponse($data, 200);
    }


    /**
     * Delete the specified resource.
     **
     * @OA\Delete(
     * path="/api/seasons/{season}",
     *   summary="Delete A Single Season",
     *   description="Delete Season details",
     *   operationId="DeleteSeasonDetails",
     *   tags={"Seasons"},
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *      name="season",
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

    public function destroy(Season $season)
    {
        $season->delete();

        $data = [
            'message' => 'Season deleted successfully'
        ];

        return $this->successResponse($data, 200);
    }
}
