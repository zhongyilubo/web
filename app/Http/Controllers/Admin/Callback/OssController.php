<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/31
 * Time: 12:39
 */

namespace App\Http\Controllers\Admin\Callback;

use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;

class OssController extends InitController
{
    public function index(Request $request){
        info('---------------------------------');
        info($request->all());
    }
}