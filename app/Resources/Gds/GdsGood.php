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
            'price' => $this->price ?? '',
            'teacher' => $this->teacher ?? '',
            'type' => $this->type ?? '',
            'number' => $this->number ?? 0,
            'type_name' => $this->type == 1 ? '单课' :'系列课',
            'cover' => $this->skus->first()->url ?? '',
        ];
    }

}