<ul class="top-suspension">
    <li class="li-left top-picture">
        <a href="javascript:;">
            <img src="#" alt=""/>
        </a>
    </li>
    <li class="li-left sixty"><a href=""> <i class="iconfont">&#xe640;</i></a></li>
    <li class="li-left sixty"><a href="#"> <i class="iconfont">&#xe604;</i></a></li>
    <li class="li-right hundred-three">
        {{$user['name'] ?? ' -- '}}<sup></sup>
        <div class="account-information">
            <a href="{{url('base/account/log')}}">登录日志</a>
            <a href="{{url('base/account/password')}}">修改密码</a>
            <a href="{{url('logout')}}">退出</a>
        </div>
    </li>
    <!-- 系统设置 -->
    <li class="li-right sixty znx">
        <i class='iconfont'>&#xe605;</i>
        <div class="con-mail">
            <a href="">@widget('message')</a>
        </div>
    </li>

</ul>
@inject('system','App\Presenters\Common\MenuPresenter')
<?php $items = $system->init('admin');?>

<div class="nav_wrap_ch">

    <div class="nav_first_ch">
        <ul>
            @foreach ($items as $item)
                <?php $item = $system->currentMenu($item);?>
                <a href="{{$system->getNodeLink($item)}}" target="_self">
                    <li  class="{!! $item['current'] ?? '' !!}">
                        {!! $item['icon_class'] ?? '' !!}
                        {!! $item['display_name'] ?? '' !!}
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
    <div class="nav_second_ch">
        <ul class="nav_left_second sidenav">
            <li class="on">
                <div class="nav_tit  selected ">
                    <a href="#">
                        进销管理
                    </a>
                </div>
                <div class="nav_children">
                    <a href="/stock/inventory/index" class=" current ">
                        库存查询
                    </a>
                    <a href="/stock/inventory/godownentry" class="">
                        入库管理
                    </a>
                    <a href="/stock/inventory/placingentry" class="">
                        出库管理
                    </a>
                    <a href="/stock/inventory/purchase" class="">
                        采购管理
                    </a>
                    <a href="/stock/inventory/transfer" class="">
                        调拨管理
                    </a>
                </div>
            </li>
            <li class="">
                <div class="nav_tit ">
                    <a href="#">
                        设置管理
                    </a>
                </div>
                <div class="nav_children">
                    <a href="#" class="">
                        供应商管理
                    </a>
                    <a href="#" class="">
                        仓库管理
                    </a>
                    <a href="#" class="">
                        物流管理
                    </a>
                </div>
            </li>
        </ul>
    </div>

</div>

