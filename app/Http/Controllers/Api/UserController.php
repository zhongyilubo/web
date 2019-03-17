<?php
namespace App\Http\Controllers\Api;

use App\Transformers\MyCustomTransformer;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    use Helpers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(Request $request)
    {

        $user = User::first();
        $token = \JWTAuth::fromUser($user);

//        $user = User::first();
//        $token = auth()->login($user);

//        $token = auth()->tokenById(1);
        return $this->respondWithToken($token);

//        $credentials = $request->only('email', 'password');
//
//        if ($token = $this->guard()->attempt($credentials)) {
//            return $this->respondWithToken($token);
//        }
//
//        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = $this->guard()->user();
        return $this->response->item($user, new MyCustomTransformer())->withHeader('X-Foo', 'Bar');
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
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
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}