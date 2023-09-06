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

      $user_id = $request->user_id;
      $tasks = CardSwitcher::whereHas('card', function ($query) use ($user_id) {
        $query->where('user_id', $user_id);
        })
        ->where('status', 1)
        ->with(['merchant:id,name', 'card:id,card_number'])
        ->latest()
        ->get();

        // Organize tasks by merchant
        $tasksByMerchant = $tasks->groupBy('merchant_id');

        // Extract the latest task for each merchant
        $latestTasks = $tasksByMerchant->map(function ($tasks) {
            return $tasks->first();
        });

        

        return response()->json(['latest_tasks' => $latestTasks]);
              
              
        
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
      *               required={"card_id","merchant_id","status"},
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
