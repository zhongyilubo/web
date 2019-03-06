<?php
namespace App\Presenters\Admin;

class MenuPresenter{

    private $date = [

    ];

    public function init(){
        return view( 'admin.presenters.'. __FUNCTION__);
    }
}