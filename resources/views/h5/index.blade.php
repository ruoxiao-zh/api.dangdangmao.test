<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=0.5, user-scalable=0">
    <title>列表</title>
    <link href="{{ asset('h5/css/index.css') }}" rel="stylesheet"/>
</head>
<body>
<div id="main">
    <ul id="nav-list">
        <li>京东</li>
        <li class="nav-list">淘宝</li>
        <li>拼多多</li>
    </ul>

    <div class="list" style="display: none">
        @foreach($jdData as $key => $value)
            <a href="">
                <div class="list-img">
                    <div id="img">
                        <img src="{{ $value['imageInfo']['imageList'][0]['url'] }}" style="width: 345px; height: 210px;"/>
                    </div>
                    <p style="background: url({{ asset('h5/image/jd.png') }}) no-repeat 0 5px;">{{ str_limit($value['skuName'], 42) }}</p>
                    <strong>淘宝价：￥999</strong>
                    <div id="tick">
                        <span>券后价<em>￥</em><i>{{ $value['skuName'] }}</i></span>
                        <div id="btn">
                            @if(isset($value['couponInfo']['couponList'][0]))
                                {{ $value['couponInfo']['couponList'][0]['discount'] }}
                            @endif元券</div>
                    </div>
                    <img src="{{ asset('h5/image/hot.png') }}" id="right">
                </div>
            </a>
        @endforeach
    </div>


    <div class="list">
        @foreach($taoBaoKeCoupons as $key => $value)
            <a href="">
                <div class="list-img">
                    <div id="img">
                        <img src="{{ $value->pict_url }}" style="width: 345px; height: 210px;"/>
                    </div>
                    <p style="background: url({{ asset('h5/image/tb.png') }}) no-repeat 0 5px;">{{ str_limit($value->title, 40) }}</p>
                    <strong></strong>
                    {{--                <strong>淘宝价：￥999</strong>--}}
                    <div id="tick">
                        <span>券后价<em>￥</em><i>{{ $value->zk_final_price }}</i></span>
                        <div id="btn">{{ $value->coupon_info }}</div>
                    </div>
                    <img src="{{ asset('h5/image/hot.png') }}" id="right">
                </div>
            </a>
        @endforeach
    </div>


    <div class="list" style="display: none">
        <a href="">
            <div class="list-img">
                <div id="img">
                    <img/>
                </div>
                <p style="background: url({{ asset('h5/image/pdd.png') }}) no-repeat 0 5px;">技术宅经典款数据充值线线数据充值线线</p>
                <strong>淘宝价：￥999</strong>
                <div id="tick">
                    <span>券后价<em>￥</em><i>990</i></span>
                    <div id="btn">900元券</div>
                </div>
                <img src="{{ asset('h5/image/hot.png') }}" id="right">
            </div>
        </a>

        <a href="">
            <div class="list-img">
                <div id="img">
                    <img/>
                </div>
                <p>技术宅经典款数据充值线线数据充值线线</p>
                <strong>淘宝价：￥999</strong>
                <div id="tick">
                    <span>券后价<em>￥</em><i>990</i></span>
                    <div id="btn">900元券</div>
                </div>
                <img src="{{ asset('h5/image/hot.png') }}" id="right">
            </div>
        </a>

        <a href="">
            <div class="list-img">
                <div id="img">
                    <img/>
                </div>
                <p>技术宅经典款数据充值线线数据充值线线</p>
                <strong>淘宝价：￥999</strong>
                <div id="tick">
                    <span>券后价<em>￥</em><i>990</i></span>
                    <div id="btn">900元券</div>
                </div>
                <img src="{{ asset('h5/image/hot.png') }}" id="right">
            </div>
        </a>
    </div>

</div>

<script src="{{ asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ asset('h5/js/jq.js') }}"></script>

</body>
</html>
