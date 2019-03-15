<?php
namespace App\Fractal;

use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Binding;
use Dingo\Api\Contract\Transformer\Adapter;

class MyCustomTransformer implements Adapter
{
    public function transform($response, $transformer, Binding $binding, Request $request)
    {
        // 在这里可以使用你的转换层转换给出的响应
        return [
            'name' => 'duan'
        ];
    }
}