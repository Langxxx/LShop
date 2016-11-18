@extends('home.layouts.app')

@section('title', '订单')
@section('content')
	<div class="clear"></div>
	<div class="concent">
		<!--地址 -->
		<div class="paycont">
			<div class="address">
				<h3>确认收货地址 </h3>
				<div class="control">
					<div class="tc-btn createAddr theme-login am-btn am-btn-danger">使用新地址</div>
				</div>
				<div class="clear"></div>
				<ul>
					<div class="per-border"></div>
					<li class="user-addresslist defaultAddr">

						<div class="address-left">
							<div class="user DefaultAddr">

										<span class="buy-address-detail">
                   <span class="buy-user">小明 </span>
										<span class="buy-phone">15871145629</span>
										</span>
							</div>
							<div class="default-address DefaultAddr">
								<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <span class="province">福建省</span>
										<span class="city">龙岩市</span>
										<span class="dist">新罗区</span>
										<span class="street">龙岩学院</span>
										</span>

								</span>
							</div>
							<ins class="deftip">默认地址</ins>
						</div>
						<div class="address-right">
							<a href="../person/address.html">
								<span class="am-icon-angle-right am-icon-lg"></span></a>
						</div>
						<div class="clear"></div>

						<div class="new-addr-btn">
							<a href="#" class="hidden">设为默认</a>
							<span class="new-addr-bar hidden">|</span>
							<a href="#">编辑</a>
							<span class="new-addr-bar">|</span>
							<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
						</div>

					</li>
					<div class="per-border"></div>
					<li class="user-addresslist">
						<div class="address-left">
							<div class="user DefaultAddr">

										<span class="buy-address-detail">
                   <span class="buy-user">小王 </span>
										<span class="buy-phone">15871145629</span>
										</span>
							</div>
							<div class="default-address DefaultAddr">
								<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   <span class="province">湖南省</span>
										<span class="city">株洲市市</span>
										<span class="dist">芦淞区区</span>
										<span class="street">东湖路75号众环大厦2栋9层902</span>
										</span>

								</span>
							</div>
							<ins class="deftip hidden">默认地址</ins>
						</div>
						<div class="address-right">
							<span class="am-icon-angle-right am-icon-lg"></span>
						</div>
						<div class="clear"></div>

						<div class="new-addr-btn">
							<a href="#">设为默认</a>
							<span class="new-addr-bar">|</span>
							<a href="#">编辑</a>
							<span class="new-addr-bar">|</span>
							<a href="javascript:void(0);"  onclick="delClick(this);">删除</a>
						</div>

					</li>

				</ul>

				<div class="clear"></div>
			</div>
			<!--物流 -->
			<div class="logistics" id="post_method">
				<h3>选择物流方式</h3>
				<ul class="op_express_delivery_hot">
					<li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
					<li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
					<li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
					<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
					<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
				</ul>
			</div>
			<div class="clear"></div>

			<!--支付方式-->
			<div class="logistics" id="pay_method">
				<h3>选择支付方式</h3>
				<ul class="pay-list">
					<li class="pay card"><img src="/images/wangyin.jpg" />银联<span></span></li>
					<li class="pay qq"><img src="/images/weizhifu.jpg" />微信<span></span></li>
					<li class="pay taobao"><img src="/images/zhifubao.jpg" />支付宝<span></span></li>
				</ul>
			</div>
			<div class="clear"></div>

			<!--订单 -->
			<div class="concent">
				<div id="payTable">
					<h3>确认订单信息</h3>
					<div class="cart-table-th">
						<div class="wp">

							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-oplist">
								<div class="td-inner">配送方式</div>
							</div>

						</div>
					</div>
					<div class="clear"></div>


				</div>
				{{-- */$totalPrice=0;/* --}}
				@foreach($allGoodsList as $goodsInfo)
					<tr class="item-list">
						<div class="bundle  bundle-last">

							<div class="bundle-main">
								<ul cart_id="{{ $goodsInfo->id }}" goods_id="{{ $goodsInfo->goods_id }}" goods_attr_id="{{ $goodsInfo->goods_attr_id }}" class="item-content clearfix">
									<div class="pay-phone">
										<li class="td td-item">
											<div class="item-pic">
												<a href="#" class="J_MakePoint">
													<img src="/images/kouhong.jpg_80x80.jpg" class="itempic J_ItemImg"></a>
											</div>
											<div class="item-info">
												<div class="item-basic-info">
													<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{ $goodsInfo->goods->name }}</a>
												</div>
											</div>
										</li>
										<li class="td td-info">
											<div class="item-props">
												@foreach($goodsInfo->attributes as $attribute)
													<span class="sku-line">{{ $attribute->name }}：{{ $attribute->pivot->attr_value }};</span>
												@endforeach
											</div>
										</li>
										<li class="td td-price">
											<div class="item-price price-promo-promo">
												<div class="price-content">
													<em class="J_Price price-now">{{ $goodsInfo->goods->shop_price }}</em>
												</div>
											</div>
										</li>
									</div>

									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<span class="phone-title">购买数量</span>
												<div class="sl">
													<input class="min am-btn reduce_num" name="" type="button" value="-" />
													<input id="amount" class="" name="" type="text" value="{{ $goodsInfo->number }}" style="width:30px;" />
													<input class="add am-btn add_num" name="" type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{ $goodsInfo->goods->shop_price * $goodsInfo->number }}</em>
										</div>
									</li>
									<li class="td td-oplist">
										<div class="td-inner">
											<span class="phone-title">配送方式</span>
											<div class="pay-logis">
												快递<b class="sys_item_freprice">10</b>元
											</div>
										</div>
									</li>

								</ul>
								<div class="clear"></div>

							</div>
					</tr>
					<div class="clear"></div>
					{{-- */$totalPrice += $goodsInfo->goods->shop_price * $goodsInfo->number;/* --}}
				@endforeach

			</div>
			<div class="clear"></div>
			<div class="pay-total">
				<!--留言-->
				<div class="order-extra">
					<div class="order-user-info">
						<div id="holyshit257" class="memo">
							<label>买家留言：</label>
							<input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close">
							<div class="msg hidden J-msg">
								<p class="error">最多输入500个字符</p>
							</div>
						</div>
					</div>

				</div>
				<!--优惠券 -->
				<div class="buy-agio">
					<li class="td td-coupon">

						<span class="coupon-title">优惠券</span>
						<select data-am-selected>
							<option value="a">
								<div class="c-price">
									<strong>￥8</strong>
								</div>
								<div class="c-limit">
									【消费满95元可用】
								</div>
							</option>
							<option value="b" selected>
								<div class="c-price">
									<strong>￥3</strong>
								</div>
								<div class="c-limit">
									【无使用门槛】
								</div>
							</option>
						</select>
					</li>

					<li class="td td-bonus">

						<span class="bonus-title">红包</span>
						<select data-am-selected>
							<option value="a">
								<div class="item-info">
									¥50.00<span>元</span>
								</div>
								<div class="item-remainderprice">
									<span>还剩</span>10.40<span>元</span>
								</div>
							</option>
							<option value="b" selected>
								<div class="item-info">
									¥50.00<span>元</span>
								</div>
								<div class="item-remainderprice">
									<span>还剩</span>50.00<span>元</span>
								</div>
							</option>
						</select>

					</li>

				</div>
				<div class="clear"></div>
			</div>
			<!--含运费小计 -->
			<div class="buy-point-discharge ">
				<p class="price g_price ">
					合计（含运费） <span>¥</span><em id="J_Total" class="pay-sum">{{ $totalPrice }}</em>
				</p>
			</div>

			<!--信息 -->
			<div class="order-go clearfix">
				<div class="pay-confirm clearfix">
					<div class="box">
						<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{ $totalPrice }}</em>
											</span>
						</div>

						<div id="holyshit268" class="pay-address">

							<p class="buy-footer-address">
								<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="buy--address-detail">
								   <span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												</span>
								</span>
							</p>
							<p class="buy-footer-address">
								<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">
                                         <span class="buy-user">艾迪 </span>
												<span class="buy-phone">15871145629</span>
												</span>
							</p>
						</div>
					</div>

					<div id="holyshit269" class="submitOrder">
						<div class="go-btn-wrap">
							<a id="J_Go" onclick="submitOrder(this)" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>

		<div class="clear"></div>
	</div>
	@include("home.layouts.footer")
	<div class="theme-popover-mask"></div>
	<div class="theme-popover">

		<!--标题 -->
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
		</div>
		<hr/>

		<div class="am-u-md-12">
			<form class="am-form am-form-horizontal">

				<div class="am-form-group">
					<label for="user-name" class="am-form-label">收货人</label>
					<div class="am-form-content">
						<input type="text" id="user-name" placeholder="收货人">
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">手机号码</label>
					<div class="am-form-content">
						<input id="user-phone" placeholder="手机号必填" type="email">
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-phone" class="am-form-label">所在地</label>
					<div class="am-form-content address">
						<select data-am-selected>
							<option value="a">浙江省</option>
							<option value="b">湖北省</option>
						</select>
						<select data-am-selected>
							<option value="a">温州市</option>
							<option value="b">武汉市</option>
						</select>
						<select data-am-selected>
							<option value="a">瑞安区</option>
							<option value="b">洪山区</option>
						</select>
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-intro" class="am-form-label">详细地址</label>
					<div class="am-form-content">
						<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
						<small>100字以内写出你的详细地址...</small>
					</div>
				</div>

				<div class="am-form-group theme-poptit">
					<div class="am-u-sm-9 am-u-sm-push-3">
						<div class="am-btn am-btn-danger">保存</div>
						<div class="am-btn am-btn-danger close">取消</div>
					</div>
				</div>
			</form>
		</div>

	</div>

	<div class="clear"></div>

@endsection
@section('HeaderCSSAndJS')
	<meta name="_token" content="{{ csrf_token() }}">

	<link href="/css/cartstyle.css" rel="stylesheet" type="text/css" />

	<link href="/css/jsstyle.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="/js/address.js"></script>

	{{--<script type="text/javascript" src="/js/jquery.js"></script>--}}
	<script type="text/javascript" src="/js/cart.js"></script>

	<script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
	<link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
@endsection
@section('FooterCSSAndJS')
	<script>
		function ajaxUpDateCartData(cartID, goodsNumber) {
			var url = "{{ url('/cart/ajaxUpDateCartData') }}" + '/' + cartID + '/' + goodsNumber;
			$.get(url)
		}
		function submitOrder(e) {
			/**********************收集订单信息***********************/
			var orderInfo = {};
			/*------------------收集收货人信息------------------*/
			var addressLi = $(".defaultAddr");
			orderInfo['shr_name'] = $(addressLi).find(".buy-user").text();
			orderInfo['tel'] = $(addressLi).find(".buy-phone").text();

			/*------------------收集收货人地址信息------------------*/
			orderInfo['province'] = $(addressLi).find(".province").text();
			orderInfo['city'] = $(addressLi).find(".city").text();
			orderInfo['dist'] = $(addressLi).find(".dist").text();
			orderInfo['address'] = $(addressLi).find(".street").text();

			var postMethod = $('#post_method').find(".selected").text();
			if (postMethod == "") {
				swal("请选物流方式", "", "error");
				return false;
			}
			orderInfo['post_method'] = postMethod;

			var payMethod = $('#pay_method').find(".selected").text();
			if (payMethod == "") {
				swal("请选支付方式", "", "error");
				return false;
			}
			orderInfo['pay_method'] = payMethod;

			orderInfo['total_price'] = $("#J_ActualFee").text();
			orderInfo['user_id'] = {{ auth()->user()->id  }};

			/**********************收集订单商品信息***********************/
			var goodsOrderInfos = {};

			var cartIDs = [];
			$('.bundle-main').each(function (e, v) {
				var goodsOrderInfo = {};
				goodsOrderInfo['goods_attr_id'] = $(v).find('ul').attr('goods_attr_id');
				goodsOrderInfo['goods_id'] = $(v).find('ul').attr('goods_id');

				var cartID = $(v).find('ul').attr('cart_id');
				cartIDs.push(cartID);

				var attrStr = "";
				$(v).find('.td-info span').each(function (e, v) {
					attrStr += $(v).text()
				});
				goodsOrderInfo['goods_attr_str'] = attrStr;
				goodsOrderInfo['goods_price'] = $(v).find('.td-price em').text();
				goodsOrderInfo['goods_number'] = $(v).find('#amount').attr('value');

				goodsOrderInfo['user_id'] = orderInfo['user_id'];

				goodsOrderInfos[e] = goodsOrderInfo;
			});

			var orderData = {};
			orderData['order_info'] = orderInfo;
			orderData['goods_infos'] = goodsOrderInfos;

			$.ajax({
				type: "post",
				data: orderData,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				url: "{{ url('/order') }}" + "/" + cartIDs.toString(),
				dataType: 'json',
				success: function (response) {
					if (response['status']) {
						window.location.href = "{{ url('/order/success') }}"
					}else {
						swal("添加失败!", response['error'], "error");

					}
				}
			});
		}
	</script>
@endsection