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
                <strong>100</strong>
                <span>
                    <i>使用期限</i>
                    <i>2019年01月01日-03日</i>
                </span>
            </div>
            <a id="btn">立即领券</a>
        </div>
        <hr/>
        <a href="" id="inte">2000积分立即兑换</a>
    </div>
@endif

<script src="{{ asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ asset('h5/js/jq.js') }}"></script>
<script src="{{ asset('h5/js/js.js') }}"></script>

</body>
</html>
