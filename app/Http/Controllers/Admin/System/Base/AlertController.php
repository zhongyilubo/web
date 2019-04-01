<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/30
 * Time: 2:48
 */

namespace App\Http\Controllers\Admin\System\Base;

use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;

class AlertController extends InitController
{
    public function __construct(Request $request)
    {
        $this->template = 'admin.system.base.alert.';
    }

    public function oss(Request $request){
        return view( $this->template. __FUNCTION__);
    }
}