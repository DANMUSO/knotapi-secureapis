<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
class AuthController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/register",
     *   tags={"Register User"},
     *   summary="Register User",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *      @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
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
        public function register(Request $request)
        {
            try{
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                
            ]);
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $success['token'] =  $user->createToken('authToken')->accessToken;
   
            return response()->json(['success' => $success]);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);
        }
        }
        /**
          * @OA\Post(
          * path="/api/login",
          * operationId="authLogin",
          * tags={"Login"},
          * summary="User Login",
          * description="Login User Here",
          *     @OA\RequestBody(
          *         @OA\JsonContent(),
          *         @OA\MediaType(
          *            mediaType="multipart/form-data",
          *            @OA\Schema(
          *               type="object",
          *               required={"email", "password"},
          *               @OA\Property(property="email", type="email"),
          *               @OA\Property(property="password", type="password")
          *            ),
          *        ),
          *    ),
          *      @OA\Response(
          *          response=201,
          *          description="Login Successfully",
          *          @OA\JsonContent()
          *       ),
          *      @OA\Response(
          *          response=200,
          *          description="Login Successfully",
          *          @OA\JsonContent()
          *       ),
          *      @OA\Response(
          *          response=422,
          *          description="Unprocessable Entity",
          *          @OA\JsonContent()
          *       ),
          *      @OA\Response(response=400, description="Bad request"),
          *      @OA\Response(response=404, description="Resource Not Found"),
          * )
          */
        public function login(Request $request)
        {

            try{
            $validator = $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            if (!auth()->attempt($validator)) {
                return response()->json(['error' => 'Unauthorised'], 401);
            } else {
                $success['token'] = auth()->user()->createToken('authToken')->accessToken;
               
                return response()->json(['success' => $success])->setStatusCode(200);
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);
        }
        }
}
