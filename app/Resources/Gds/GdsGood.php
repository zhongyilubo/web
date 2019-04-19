<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/18
 * Time: 10:54
 */

namespace App\Resources\Gds;

use App\Resources\Base;

class GdsGood extends Base
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
        ];
    }

}