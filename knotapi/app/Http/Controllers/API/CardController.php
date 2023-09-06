<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
class CardController extends Controller
{
     /**
     * @OA\Post(
     ** path="/api/addcard",
     *   tags={"Add Card's Details"},
     *   summary="Add Card's Details",
     *   operationId="Add Card's Details",
     *   security={{"bearer":{}}},
     *  @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_id","card_number","card_expiry_date", "card_cvv"},
     *               @OA\Property(property="user_id", type="integer"),
     *               @OA\Property(property="card_number", type="integer"),
     *               @OA\Property(property="card_expiry_date", type="string", pattern = "yyyy-MM-dd", example = "5-9-2023"),
     *               @OA\Property(property="card_cvv", type="integer")
     *            ),
     *        ),
     *    ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

     public function store(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'card_number' => 'required|numeric|unique:cards',
            'card_expiry_date' => 'required',
            'card_cvv' => 'required|numeric|unique:cards',
            
        ]);
        $data = $request->all();
        $card = Card::create($data);
        return response()->json([
            'msg' => 'Card added successfully'
        ]);
     }
}
