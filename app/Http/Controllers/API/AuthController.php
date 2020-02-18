<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\RegisterController;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Response;

class AuthController extends RegisterController
{
    // public function register(Request $request){
    //     $input= $request->all();
    //     $validator=Validator::make($input,[
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:6|max:10',
    //     ]);
    //     if($validator->fails()){
    //         return $this->sendError('Validator error',$validator->errors());
    //     }
    //     $this->store($input);
    //     $response=[
    //         'name'=>$input['name'],
    //         'email'=>$input['email']
    //     ];
    //     return $this->sendResponse($response,'Register Successfully');
    // }
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(['user' => $user], Response::HTTP_OK);
    }
}
