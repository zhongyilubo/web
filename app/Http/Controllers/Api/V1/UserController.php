<?php
namespace App\Http\Controllers\Api\V1;

use App\Fractal\MyCustomTransformer;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    use Helpers;

    public function show($id = 0){
        $user = User::findOrFail($id);
        return $this->response->item($user, new MyCustomTransformer());
    }
}