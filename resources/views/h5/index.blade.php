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
        <li class="nav-list">淘宝</li>
        <li>拼多多</li>
        <li>京东</li>
    </ul>


    {{--淘宝--}}
    <div class="list">
        @foreach($taoBaoKeCoupons as $key => $value)
            <a href="{{ url('detail?type=taobao&num_iids='.$value->num_iid.'&coupon_click_url='.$value->coupon_click_url.
            '&coupon_end_time='.$value->coupon_end_time.'&coupon_start_time='.$value->coupon_start_time.
            '&coupon_info='.$value->coupon_info) }}">
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

    {{--拼多多--}}
    <div class="list" style="display: none">
        @foreach($pinDuoDuoData as $key => $value)
            <a href="{{ url('detail?type=pinduoduo&goods_id_list='.$value['goods_id'].
            '&coupon_end_time='.$value['coupon_end_time'].'&coupon_start_time='.$value['coupon_start_time'].
            '&coupon_discount='.$value['coupon_discount'].'&sold_quantity='.$value['sold_quantity']) }}">
                <div class="list-img">
                    <div id="img">
                        <img src="
                            @if(!empty($value['goods_image_url']))
                        {{ $value['goods_image_url'] }}
                        @else
                        {{ $value['goods_thumbnail_url'] }}
                        @endif
                            " style="width: 345px; height: 210px;"/>
                    </div>
                    <p style="background: url({{ asset('h5/image/pdd.png') }}) no-repeat 0 5px;">{{ str_limit($value['goods_name'], 40) }}</p>
                    <strong>最小单买价：￥{{ $value['min_group_price'] / 100 }}</strong>
                    <div id="tick">
                        <span>券后价<em>￥</em><i>{{ ($value['min_group_price'] - $value['coupon_discount']) / 100 }}</i></span>
                        <div id="btn">{{ $value['coupon_discount'] / 100 }}元券</div>
                    </div>
                    <img src="{{ asset('h5/image/hot.png') }}" id="right">
                </div>
            </a>
        @endforeach
    </div>

    {{--京东--}}
    <div class="list" style="display: none">
        @foreach($jdData as $key => $value)
            <a href="">
                <div class="list-img">
                    <div id="img">
                        <img src="{{ $value['imageInfo']['imageList'][0]['url'] }}"
                             style="width: 345px; height: 210px;"/>
                    </div>
                    <p style="background: url({{ asset('h5/image/jd.png') }}) no-repeat 0 5px;">{{ str_limit($value['skuName'], 42) }}</p>
                    <strong>京东价：￥{{ $value['priceInfo']['price'] }}</strong>
                    <div id="tick">
                        <span>券后价<em>￥</em><i>
                                @if(isset($value['couponInfo']['couponList'][0]))
                                    {{ $value['priceInfo']['price'] - $value['couponInfo']['couponList'][0]['discount'] }}
                                @else
                                    {{ $value['priceInfo']['price'] }}
                                @endif
                            </i></span>
                        <div id="btn">
                            @if(isset($value['couponInfo']['couponList'][0]))
                                {{ $value['couponInfo']['couponList'][0]['discount'] }}
                            @else
                                0
                            @endif
                            元券
                        </div>
                    </div>
                    <img src="{{ asset('h5/image/hot.png') }}" id="right">
                </div>
            </a>
        @endforeach
    </div>

</div>

<script src="{{ asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ asset('h5/js/jq.js') }}"></script>

</body>
</html>
