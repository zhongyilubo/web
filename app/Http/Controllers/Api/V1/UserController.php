<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function show($id = 0){

        return ['name'=>'duan','id'=>$id];
    }
}