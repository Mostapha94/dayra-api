<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    use GeneralTrait;

    public function login(UserLoginRequest $request)
    {
        try {
            //login
            // $credentials = $request->only(['email', 'password']);
            $input = $request->all();
            $fieldType = filter_var($request->phone_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            // $token = auth()->guard('user-api')->attempt($credentials);  //generate token
            $token=auth()->guard('user-api')->attempt(array($fieldType => $input['phone_or_email'], 'password' => $input['password']));

            if (!$token)
                return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=>  __('Pleas make sure the your data is correct')  ]]);

            $user = auth()->guard('user-api')->user();
            $user ->token = $token;
            //return token
            $additional['response']=$this->responseFormat( true , 202 ,  __('Logged in successfully'), '');
            return (new UserResource($user))->additional($additional)->response()->setStatusCode(202);
        } catch (\Exception $ex) {
            return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=> $ex->getMessage() ]]);
        }
    }
    public function register(UserRegisterRequest $request) {
        DB::beginTransaction();
        try
        {
            $user=User::create([
                'name' => $request['name'],
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'password' => Hash::make($request['password']),
            ]);
            $token = JWTAuth::fromUser($user);
            DB::commit();
            $user=User::find($user->id);
            $user ->token = $token;
            //return token
            $additional['response']=$this->responseFormat( true , 201 ,  __('Account created successfully'), '');
            return (new UserResource($user))->additional($additional)->response()->setStatusCode(201);
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=>  __('Some thing went wrongs !')  ]] , 500 );
        }
    }
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=>  __('Some thing went wrongs !')  ]] , 500);
        }
        return response()->json(['response'=>['status' => true ,'code' => 202 ,'message'=>  __('Logged out successfully')  ]]);
    }
}
