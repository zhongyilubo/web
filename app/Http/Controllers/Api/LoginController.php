<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends InitController{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function login(Request $request)
    {

        $appid = 'wxf8d08695c2d862f4'; //填写微信小程序appid
        $secret = 'ea09ddae2a1b1bf743766455181f89ae'; //填写微信小程序secret
        $code = $request->code ?? '';

        $wJson = json_decode(file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code"),true);

        if(!isset($wJson['openid'])){
            return $this->response->error('openid error', 404);
        }

        $user = User::firstOrCreate(['openid' => $wJson['openid']], [
            'type' => User::USER_TYPE_MEMBER
        ]);
        $token = \JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
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
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = $this->guard()->user();
        return $this->response->item($user, new UserTransformer())->withHeader('X-Foo', 'Bar');
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return $this->response->array(['message' => 'Successfully logged out']);
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
        return $this->response->array([
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
        return Auth::guard(config('app.guard.api'));
    }
}