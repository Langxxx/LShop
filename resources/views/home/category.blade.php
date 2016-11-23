<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>全部分类</title>
    <link href="../AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
    <link href="../basic/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="../css/sortstyle.css" rel="stylesheet" type="text/css" />
    <script src="../AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
</head>

<body>


<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="../images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="../images/logobig.png" /></li>
    </div>

    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form>
            <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
        </form>
    </div>
</div>

<div class="clear"></div>
</div>



<!--主体-->

<div id="nav" class="navfull">
    <div class="area clearfix">
        <div class="category-content" id="guide_2">
            <div class="long-title"><span class="all-goods">全部分类</span><span id="meauBack"><a href="home.html">返回</a></span></div>
            <div class="category">
                <ul class="category-list" id="js_climit_li">
                    @foreach($categories as $index => $level1)
                        @if($index == 0)
                            <li class="appliance js_toggle relative first selected">
                                <div class="category-info">
                                    <h3 class="category-name b-category-name"><i><img src="../images/cake.png"></i><a class="ml-22" title="点心">{{ $level1->name }}</a></h3>
                                    <em>&gt;</em></div>
                                <div class="menu-item menu-in top">
                                    <div class="area-in">
                                        <div class="area-bg">
                                            <div class="menu-srot">

                                                <div class="brand-side">
                                                    <dl class="dl-sort"><dt><span>为您推荐</span></dt>
                                                        <img src="../images/TJ.jpg">
                                                    </dl>
                                                </div>

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
                            @else
                            <li class="appliance js_toggle relative first ">
                                <div class="category-info">
                                    <h3 class="category-name b-category-name"><i><img src="../images/cake.png"></i><a class="ml-22" title="点心">{{ $level1->name }}</a></h3>
                                    <em>&gt;</em></div>
                                <div class="menu-item menu-in top">
                                    <div class="area-in">
                                        <div class="area-bg">
                                            <div class="menu-srot">

                                                <div class="brand-side">
                                                    <dl class="dl-sort"><dt><span>为您推荐</span></dt>
                                                        <img src="../images/TJ.jpg">
                                                    </dl>
                                                </div>

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
                        @endif

                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("li").click(function() {
            $(this).addClass("selected").siblings().removeClass("selected");
        })
    })
</script>
<div class="clear"></div>
<!--引导 -->

@include('home.layouts.navCir')
</body>

</html>