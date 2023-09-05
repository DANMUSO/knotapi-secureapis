<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CardSwitcher;
class CardSwitcherController extends Controller
{
        /**
      * @OA\Post(
      ** path="/api/finishedtask",
      *   tags={"Mechant finished task"},
      *   summary="Mechant finished task",
      *   operationId="Mechant finished task",
      *   security={{"bearer":{}}},
      *  @OA\RequestBody(
      *         @OA\JsonContent(),
      *         @OA\MediaType(
      *            mediaType="multipart/form-data",
      *            @OA\Schema(
      *               type="object",
      *               required={"user_id"},
      *               @OA\Property(property="user_id", type="integer")
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
    public function gettasks(Request $request){
        $userId = $request->user_id;

        $task = CardSwitcher::where('user_id', $userId)->where('status', 1)->with('card:id,card_number','merchant:id,name')->get();

     
        $data = json_decode($task, true);

        $filteredData = [];
        
        foreach ($data as $item) {
            $filteredData[] = [
                'card_number' => $item['card']['card_number'],
                'merchant_name' => $item['merchant']['name'],
            ];
        }
        
        // Convert $filteredData to JSON
        $jsonResult = json_encode($filteredData, JSON_PRETTY_PRINT);
        
        // Output the JSON data
        return $jsonResult;
        
        
            
        
      }
         /**
      * @OA\Post(
      ** path="/api/addtask",
      *   tags={"Create Task"},
      *   summary="Create Task",
      *   operationId="Create Task",
      *   security={{"bearer":{}}},
      *  @OA\RequestBody(
      *         @OA\JsonContent(),
      *         @OA\MediaType(
      *            mediaType="multipart/form-data",
      *            @OA\Schema(
      *               type="object",
      *               required={"user_id","card_id","merchant_id","status"},
      *               @OA\Property(property="user_id", type="integer"),
      *               @OA\Property(property="card_id", type="integer"),
      *               @OA\Property(property="merchant_id", type="integer"),
      *               @OA\Property(property="status", type="integer")
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
         $data = $request->all();
         $cardswitcher = CardSwitcher::create($data);
         return response()->json([
             'message' => 'Task added successfully'
             ]);
 
      }
}
