@extends('home.layouts.app')

@section('title', '支付完成')
@section('content')
    <div class="clear"></div>
    <div class="take-delivery">
        <div class="status">
            <h2>您已成功付款</h2>
            <div class="successInfo">
                <ul>
                    <li>付款金额<em>¥999.90</em></li>
                    <div class="user-info">
                        <p>收货人：小明</p>
                        <p>联系电话：15871145629</p>
                        <p>收货地址：福建省 龙岩市 新罗区 龙岩学院</p>
                    </div>
                    请认真核对您的收货信息，如有错误请联系客服

                </ul>
                <div class="option">
                    <span class="info">您可以</span>
                    <a href="../person/order.html" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
                    <a href="../person/orderinfo.html" class="J_MakePoint">查看<span>交易详情</span></a>
                </div>
            </div>
        </div>
    </div>
    @include('home.layouts.footer')
@endsection
@section('HeaderCSSAndJS')
    <link href="../css/sustyle.css" rel="stylesheet" type="text/css" />
@endsection
