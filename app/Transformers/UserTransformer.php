<?php
namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        // 在这里可以使用你的转换层转换给出的响应
        return [
            'mobile' => $user->mobile,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'gender' => $user->gender,
            'email' => $user->email,
            'birthday' => $user->birthday,
            'last_login_time' => $user->last_login_time,
        ];
    }
}