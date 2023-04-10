<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (request()->password) {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        } else {

            $user = User::where('uuid', request()->uuid)->where('email', request()->email)->first();
            if ($user) {
                $token = JWTAuth::fromUser($user);
            }
            return response()->json(['token' => $token, 'user' => $user], 200);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }




    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'sometimes|unique:users',
            'email' => 'sometimes|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['Validation Erorrs' => $validator->messages()], 200);
        } else {
            if (!$request->password) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'uuid' => $request->uuid,
                    'password' => bcrypt('testpas'),

                ]);
                $myuser = User::findOrFail($user->id);
                $token = Auth::guard('api')->login($user);

                return response()->json([
                    'message' => 'User successfully registered ',
                    'user' => $myuser,
                    'token' => $token
                ], 200);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                ]);
                $myuser = User::findOrFail($user->id);
                $token = Auth::guard('api')->login($user);
                return response()->json([
                    'message' => 'User successfully registered ',
                    'user' => $myuser,
                    'token' => $token
                ], 200);
            }
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
