<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * register new user
     * @param Request new user datat
     * @return success message with token
     */
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data['name'] = $user->name;
        // create sanctum token
        $data['access_token'] = $user->createToken('MyApp')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $data
        ], 200);
    }


    /**
     * login user
     * @param Request credentials
     * @return message with token 
     */
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            
            $user = Auth::user();

            $data['name'] = $user->name;
            $data['access_token'] = $user->createToken('MyApp')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully',
                'user' => $data
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data' => $request->email
            ], 401);
        }
        
    }


    /**
     * logout user by removine token
     * @param Request 
     * @return success message
     */
    public function logout(Request $request)
    {
        // deleting user token
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'User logged out'
        ], 200);
    }
}
