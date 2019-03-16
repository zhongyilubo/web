<?php
namespace App\Fractal;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class MyCustomTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        // 在这里可以使用你的转换层转换给出的响应
        return [
            'name' => $user->id
        ];
    }
}