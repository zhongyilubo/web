<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/2/28
 * Time: 22:47
 */
/**
 * 获取域名
 */
if(!function_exists('get_domain')){
    function get_domain($name)
    {
        $url = env('APP_URL');
        $suffix = strpos($url, 'localhost') ? '.cw100.la' : strstr($url, '.');
        return $name=='web' ? 'www'.$suffix : strtolower($name).$suffix;
    }
}