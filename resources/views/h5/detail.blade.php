<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.5, user-scalable=0">
    <title>详情</title>
    <link href="{{ asset('h5/css/detail.css') }}" rel="stylesheet"/>
</head>
<body>

@if(isset($taoBaoKeInfo))
    <div id="detail">
        <div class="warp" id='warp'>
            <ul id="pic">
                @foreach($taoBaoKeInfo[0]->small_images->string as $value)
                    <li>
                        <a href="{{ $taoBaoKeInfo[0]->item_url }}">
                            <img src="{{ $value }}" />
                        </a>
                    </li>
                @endforeach
            </ul>
            <ol id="list">
                @foreach($taoBaoKeInfo[0]->small_images->string as $key => $value)
                    <li @if($key === 0) class="on" @endif></li>
                @endforeach
            </ol>
            <div id="left"><img src="{{ asset('h5/image/back.png') }}" onclick="history.back();" /></div>
            <div id="right"><img src="{{ asset('h5/image/cart.png') }}"></div>
        </div>

        <hr/>
        <p id="desc">{{ $taoBaoKeInfo[0]->title }}</p>
        <div id="price">
            <p><strong>券后价</strong><em>￥</em><i>{{ $taoBaoKeInfo[0]->zk_final_price }}</i></p>
            <p><strong>淘宝价</strong><em>￥</em><i>{{ $taoBaoKeInfo[0]->reserve_price }}</i></p>
            <span>
                <img src="{{ asset('h5/image/coll.png') }}"/>
                <i>30 天销量：{{ $taoBaoKeInfo[0]->volume }}</i>
            </span>
        </div>

        <div id="dis">
            <div id="limit">
                <em>￥</em>
                <strong>{{ $param['coupon_info'] }}</strong>
                <span>
                    <i style="float: left;">使用期限</i>
                    <i style="float: right;">{{ $param['coupon_start_time'] }} - {{ $param['coupon_end_time'] }}</i>
                </span>
            </div>
            <a id="btn" href="{{ $param['coupon_click_url'] }}" style="text-decoration: none;color: white;">立即领券</a>
        </div>
        <hr/>
{{--        <a href="" id="inte">2000积分立即兑换</a>--}}
    </div>
@endif

@if(isset($pinDuoDuoInfo))
    <div id="detail">
        <div class="warp" id='warp'>
            <ul id="pic">
                <li><img src="{{ $pinDuoDuoInfo['goods_pic'] }}" /></li>
            </ul>
            <ol id="list">
                <li class="on"></li>
            </ol>
            <div id="left" ><img src="{{ asset('h5/image/back.png') }}" onclick="history.back();" /></div>
            <div id="right"><img src="{{ asset('h5/image/cart.png') }}"></div>
        </div>

        <hr />
        <p id="desc">{{ $pinDuoDuoInfo['goods_name'] }}</p>
        <div id="price">
            <p><strong>券后价</strong><em>￥</em><i>{{ ($pinDuoDuoInfo['min_group_price'] - $param['coupon_discount']) / 100 }}</i></p>
            <p><strong>最小单买价</strong><em>￥</em><i>{{ $pinDuoDuoInfo['min_group_price'] / 100 }}</i></p>
            <span>
                <img src="{{ asset('h5/image/coll.png') }}" />
                <i>已售：{{ $param['sold_quantity'] }}</i>
            </span>
        </div>

        <div id="dis">
            <div id="limit">
                <em>￥</em>
                <strong>{{ $param['coupon_discount'] / 100 }}</strong>
                <span>
                    <i style="">使用期限</i>
                    <i>{{ date('Y-m-d', $param['coupon_start_time']) }} - {{ date('Y-m-d', $param['coupon_end_time']) }}</i>
                </span>
            </div>
            <a id="btn" href="{{ $pinDuoDuoShareData['url'] }}" style="text-decoration: none;color: white;">立即领券</a>
        </div>
        <hr />
{{--        <a href="" id="inte">2000积分立即兑换</a>--}}
    </div>
@endif

@if(isset($jdData))
    <div id="detail">
        <div class="warp" id='warp'>
            <ul id="pic">
                <li><img src="{{ $jdData['imgUrl'] }}" /></li>
            </ul>
            <ol id="list">
                <li class="on"></li>
            </ol>
            <div id="left" ><img src="{{ asset('h5/image/back.png') }}" onclick="history.back();" /></div>
            <div id="right"><img src="{{ asset('h5/image/cart.png') }}"></div>
        </div>

        <hr />
        <p id="desc">{{ str_limit($jdData['goodsName'], 82) }}</p>
        <div id="price">
{{--            <p><strong>券后价</strong><em>￥</em><i>{{ ($pinDuoDuoInfo['min_group_price'] - $param['coupon_discount']) / 100 }}</i></p>--}}
            <p><em></em></p>
            <p><strong>京东价</strong><em>￥</em><i>{{ $jdData['unitPrice'] }}</i></p>
            <span>
                <img src="{{ asset('h5/image/coll.png') }}" />
                <i>30 天已售：{{ $jdData['inOrderCount'] }}</i>
            </span>
        </div>

        @foreach($couponInfo['couponList'] as $k => $v)
            <div id="dis">
                <div id="limit">
                    <em>￥</em>
                    <strong>{{ $v['discount'] }}</strong>
                    <span>
                        <i style="">使用期限</i>
                        <i>{{ date('Y-m-d', $v['useStartTime'] / 1000) }} - {{ date('Y-m-d', $v['useEndTime'] / 1000) }}</i>
                    </span>
                </div>
                <a id="btn" href="{{ $v['link'] }}" style="text-decoration: none;color: white;">立即领券</a>
            </div>
        @endforeach
        <hr />
        {{--        <a href="" id="inte">2000积分立即兑换</a>--}}
    </div>
@endif

<script src="{{ asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ asset('h5/js/jq.js') }}"></script>
<script src="{{ asset('h5/js/js.js') }}"></script>

</body>
</html>
