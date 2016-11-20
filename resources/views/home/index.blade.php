@extends('Home.layouts.app')

@section('title', '首页')


@section('content')
	<div class="banner">
		<!--轮播 -->
		<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
			<ul class="am-slides">
				<li class="banner1"><a href="introduction.blade.php"><img src="../images/ad1.jpg" /></a></li>
				<li class="banner2"><a><img src="../images/ad2.jpg" /></a></li>
				<li class="banner3"><a><img src="../images/ad3.jpg" /></a></li>
				<li class="banner4"><a><img src="../images/ad4.jpg" /></a></li>

			</ul>
		</div>
		<div class="clear"></div>
	</div>

	<div class="shopNav">
		<div class="slideall">

			<div class="long-title"><span class="all-goods">全部分类</span></div>
			<div class="nav-cont">
				<ul>
					<li class="index"><a href="#">首页</a></li>
					<li class="qc"><a href="#">闪购</a></li>
					<li class="qc"><a href="#">限时抢</a></li>
					<li class="qc"><a href="#">团购</a></li>
					<li class="qc last"><a href="#">大包装</a></li>
				</ul>
			</div>

			<!--侧边导航 -->
			<div id="nav" class="navfull">
				<div class="area clearfix">
					<div class="category-content" id="guide_2">

						<div class="category">
							<ul class="category-list" id="js_climit_li">
								@foreach($categories as $level1)
									<li class="appliance js_toggle relative first">
										<div class="category-info">
											<h3 class="category-name b-category-name"><a class="ml-22" title="点心">{{ $level1->name }}</a></h3>
											<em>&gt;</em></div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
														<div class="sort-side">
															@foreach($level1->children as $level2)
																<dl class="dl-sort">
																	<dt><span title="蛋糕">{{ $level2->name }}</span></dt>
																	@foreach($level2->children as $level3)
																		<dd><a title="蒸蛋糕" href="{{ route('search', ['category_id' => $level3->id]) }}"><span>{{ $level3->name }}</span></a></dd>
																	@endforeach
																</dl>
															@endforeach
														</div>
													</div>
												</div>
											</div>
										</div>
										<b class="arrow"></b>
									</li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>
			</div>
			<!--轮播 -->
			<script type="text/javascript">
				(function() {
					$('.am-slider').flexslider();
				});
				$(document).ready(function() {
					$("li").hover(function() {
						$(".category-content .category-list li.first .menu-in").css("display", "none");
						$(".category-content .category-list li.first").removeClass("hover");
						$(this).addClass("hover");
						$(this).children("div.menu-in").css("display", "block")
					}, function() {
						$(this).removeClass("hover")
						$(this).children("div.menu-in").css("display", "none")
					});
				})
			</script>


			<!--小导航 -->
			<div class="am-g am-g-fixed smallnav">
				<div class="am-u-sm-3">
					<a href="sort.html"><img src="../images/navsmall.jpg" />
						<div class="title">商品分类</div>
					</a>
				</div>
				<div class="am-u-sm-3">
					<a href="#"><img src="../images/huismall.jpg" />
						<div class="title">大聚惠</div>
					</a>
				</div>
				<div class="am-u-sm-3">
					<a href="#"><img src="../images/mansmall.jpg" />
						<div class="title">个人中心</div>
					</a>
				</div>
				<div class="am-u-sm-3">
					<a href="#"><img src="../images/moneysmall.jpg" />
						<div class="title">投资理财</div>
					</a>
				</div>
			</div>

			<!--走马灯 -->


			<div class="clear"></div>
		</div>
		<script type="text/javascript">
			if ($(window).width() < 640) {
				function autoScroll(obj) {
					$(obj).find("ul").animate({
						marginTop: "-39px"
					}, 500, function() {
						$(this).css({
							marginTop: "0px"
						}).find("li:first").appendTo(this);
					})
				}
				$(function() {
					setInterval('autoScroll(".demo")', 3000);
				})
			}
		</script>
	</div>
	<div class="shopMainbg">
		<div class="shopMain" id="shopmain">

			<!--今日推荐 -->

			<div class="am-g am-g-fixed recommendation">
				<div class="clock am-u-sm-3" ">
				<img src="../images/2016.png "></img>
				<p>今日<br>推荐</p>
			</div>
			<div class="am-u-sm-4 am-u-lg-3 ">
				<div class="info ">
					<h3>真的有鱼</h3>
					<h4>开年福利篇</h4>
				</div>
				<div class="recommendationMain ">
					<img src="../images/tj.png "></img>
				</div>
			</div>
			<div class="am-u-sm-4 am-u-lg-3 ">
				<div class="info ">
					<h3>囤货过冬</h3>
					<h4>让爱早回家</h4>
				</div>
				<div class="recommendationMain ">
					<img src="../images/tj1.png "></img>
				</div>
			</div>
			<div class="am-u-sm-4 am-u-lg-3 ">
				<div class="info ">
					<h3>浪漫情人节</h3>
					<h4>甜甜蜜蜜</h4>
				</div>
				<div class="recommendationMain ">
					<img src="../images/tj2.png "></img>
				</div>
			</div>

		</div>
		<div class="clear "></div>
		<!--热门活动 -->

		<div class="am-container activity ">
			<div class="shopTitle ">
				<h4>活动</h4>
				<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a class="more-link " href="# ">全部活动</a>
                            </span>
			</div>

			<div class="am-g am-g-fixed ">
				<div class="am-u-sm-3 ">
					<div class="icon-sale one "></div>
					<h4>秒杀</h4>
					<div class="activityMain ">
						<img src="../images/activity1.jpg "></img>
					</div>
					<div class="info ">
						<h3>春节送礼优选</h3>
					</div>
				</div>

				<div class="am-u-sm-3 ">
					<div class="icon-sale two "></div>
					<h4>特惠</h4>
					<div class="activityMain ">
						<img src="../images/activity2.jpg "></img>
					</div>
					<div class="info ">
						<h3>春节送礼优选</h3>
					</div>
				</div>

				<div class="am-u-sm-3 ">
					<div class="icon-sale three "></div>
					<h4>团购</h4>
					<div class="activityMain ">
						<img src="../images/activity3.jpg "></img>
					</div>
					<div class="info ">
						<h3>春节送礼优选</h3>
					</div>
				</div>

				<div class="am-u-sm-3 last ">
					<div class="icon-sale "></div>
					<h4>超值</h4>
					<div class="activityMain ">
						<img src="../images/activity.jpg "></img>
					</div>
					<div class="info ">
						<h3>春节送礼优选</h3>
					</div>
				</div>

			</div>
		</div>
		<div class="clear "></div>

		<div class="am-container ">
			<div class="shopTitle ">
				<h4>热卖商品</h4>
				<h3>你是我的优乐美么？不，我是你小鱼干</h3>
							<span class="more ">
                    <a class="more-link " href="# ">更多商品>></a>
                        </span>
			</div>
		</div>
		<div class="am-g am-g-fixed flood method3 ">
			<ul class="am-thumbnails ">
				@foreach($hotGoods as $goods)
					<li>
						<div class="list ">
							<a href="{{ url('/goods/' . $goods->id) }}">
								<img src="../images/cp.jpg " />
								<div class="pro-title ">{{ $goods->name }}</div>
								<span class="e-price ">{{ $goods->shop_price }}</span>
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>

		<div class="am-container ">
			<div class="shopTitle ">
				<h4>新品上架</h4>
				<h3>你是我的优乐美么？不，我是你小鱼干</h3>
							<span class="more ">
                    <a class="more-link " href="# ">更多商品>></a>
                        </span>
			</div>
		</div>
		<div class="am-g am-g-fixed flood method3 ">
			<ul class="am-thumbnails ">
				@foreach($newGoods as $goods)
					<li>
						<div class="list ">
							<a href="# ">
								<img src="../images/cp.jpg " />
								<div class="pro-title ">{{ $goods->name }}</div>
								<span class="e-price ">{{ $goods->shop_price }}</span>
							</a>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
		@include('home.layouts.footer')
	</div>
	</div>
	</div>
	<!--引导 -->

	<div class="navCir">
		<li class="active"><a href="{{ url('/') }}"><i class="am-icon-home "></i>首页</a></li>
		<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
		<li><a href="{{ url('/cart') }}"><i class="am-icon-shopping-basket"></i>购物车</a></li>
		<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>
	</div>

	<script>
		window.jQuery || document.write('<script src="basic/js/jquery.min.js "><\/script>');
	</script>
	<script type="text/javascript " src="../basic/js/quick_links.js "></script>
@endsection