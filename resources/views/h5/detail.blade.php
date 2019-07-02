<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.5, user-scalable=0">
    <title>详情</title>
    <link href="{{ asset('h5/css/detail.css') }}" rel="stylesheet"/>
</head>
<body>
<div id="detail">
    <div class="warp" id='warp'>
        <ul id="pic">
            <li><img src="{{ asset('h5/image/addre.png') }}"/></li>
            <li><img src="{{ asset('h5/image/good.png') }}"/></li>
            <li><img src="{{ asset('h5/image/diss.png') }}"/></li>
        </ul>
        <ol id="list">
            <li class="on"></li>
            <li></li>
            <li></li>
        </ol>
        <div id="left"><img src="{{ asset('h5/image/back.png') }}"/></div>
        <div id="right"><img src="{{ asset('h5/image/cart.png') }}"></div>
    </div>


    <hr/>
    <p id="desc">精品进口不锈钢多功能料理勺尝味勺叉多功能料理勺</p>
    <div id="price">
        <p><strong>券后价</strong><em>￥</em><i>990</i></p>
        <p><strong>淘宝价</strong><em>￥</em><i>990</i></p>
        <span>
            <img src="{{ asset('h5/image/coll.png') }}"/>
            <i>已售：23</i>
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
<script src="{{ asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ asset('h5/js/jq.js') }}"></script>
<script src="{{ asset('h5/js/js.js') }}"></script>
</body>
</html>
