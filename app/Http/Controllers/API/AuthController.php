<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * User create method
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        if($user) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'User created successfully',
                    'user'    => $user
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create user',
                ]
            );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * API based authentication
     */
    public function login(Request $request)
    {
        $data = $request->all();

        if(!Auth::attempt($data)) {
            return response()->json(
                [
                    'message' => 'Invalid email/password'
                ]
            );
        } else {
            $user = $request->user();
            $tokenResult = $user->createToken('blog');
            $token = $tokenResult->token;
            $token->save();

            return response()->json(
                [
                    'message' => 'Login successfully',
                    'token'   => $tokenResult->accessToken,
                    'user'    => $user
                ]
            );
        }
    }
}
