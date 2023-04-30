<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Rules\Password;
use Illuminate\Validation\ValidationException;



class UserController extends Controller
{




    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', new Password],
                'roles' => ['required', 'in:ibuhamil,kader,komunitas']
            ]);
    
            User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
            ]);
    
            $user = User::where('username', $request->username)->first();
    
            $tokenResult = $user->createToken('authToken')->plainTextToken;
    
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (ValidationException $e) {
            $errorMessages = $e->validator->errors()->getMessages();
            return ResponseFormatter::error([
                'message' => 'Validation Error',
                'errors' => $errorMessages
            ], 'User Registration Failed', 422);
        } catch (Exception $error) {
            Log::error('Registration error: ' . $error->getMessage() . ', Trace: ' . $error->getTraceAsString());
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
    


    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);
    
            $credentials = request(['username', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
    
            $user = User::where('username', $request->username)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }
    
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (ValidationException $validationError) {
            return ResponseFormatter::error([
                'message' => 'Validation Error',
                'error' => $validationError,
                'input_data' => $request->all(),
                'validator_errors' => $validationError->errors(),
            ], 'Authentication Failed', 422);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
    



    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }
}
