<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;
class MerchantController extends Controller
{
          /**
     * @OA\Get(
     ** path="/api/getmerchants",
     *   tags={"Get Merchants' Details"},
     *   summary="Get Merchants' Details",
     *   operationId="Get Merchants' Details",
     *   security={{"bearer":{}}},
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

     public function index(){
       $merchants = Merchant::select('id','name','website_url')->get();
        return response()->json([
            'merchants' => $merchants
            ]);

     }
        /**
     * @OA\Post(
     ** path="/api/addmerchant",
     *   tags={"Add Merchant's Details"},
     *   summary="Add Merchant's Details",
     *   operationId="Add Merchant's Details",
     *   security={{"bearer":{}}},
     *  @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","website_url"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="website_url", type="string")
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
            'name' => 'required|string|unique:merchants',
            'website_url' => 'required|string|unique:merchants',
            
        ]);
        $data = $request->all();
        $merchant = Merchant::create($data);
        return response()->json([
            'message' => 'Merchant added successfully'
            ]);

     }
}
