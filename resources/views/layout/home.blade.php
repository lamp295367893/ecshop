@inject('Sp', 'App\Http\Controllers\Home\ShoppingCarController')
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $data_conf['seo_title'] }}</title>
        <meta name="description" content="">
        <meta name="description" content="{{ $data_conf['seo_content'] }}" />
  <meta name="Keywords" content="{{ $data_conf['seo_key'] }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <!-- all css here -->
        <!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="/static/home/index/css/bootstrap.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="/static/home/index/css/animate.css">
        <!-- jquery-ui.min css -->
        <link rel="stylesheet" href="/static/home/index/css/jquery-ui.min.css">
        <!-- meanmenu css -->
        <link rel="stylesheet" href="/static/home/index/css/meanmenu.min.css">
        <!-- nivo slider css -->
        <link rel="stylesheet" href="/static/home/index/lib/css/nivo-slider.css" type="text/css" />
        <link rel="stylesheet" href="/static/home/index/lib/css/preview.css" type="text/css" />
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="/static/home/index/css/owl.carousel.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" href="/static/home/index/css/font-awesome.min.css">
        <!-- style css -->
        <link rel="stylesheet" href="/static/home/index/style.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="/static/home/index/css/responsive.css">
        <!-- <link rel="stylesheet" type="text/css" href="/static/admin/assets/layui/css/layui.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="/static/admin/assets/layui/css/layui.mobile.css"> -->
        <!-- modernizr js -->
        <!-- <link rel="stylesheet" href="/static/home/css/common.css"> -->
        <script src="/static/home/index/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="/static/admin/assets/layui/layui.js"></script>
        <script type="text/javascript" src="/static/admin/assets/js/jquery.js"></script>
    </head>
    <body>

{{-- $a =encrypt('123123') --}}


<!--header top area start-->
<div class="header_area">
    <div class="header_border">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <div class="header_heaft_area">
                        <div class="header_left_all">
                            <div class="mean_al_dv">
                                <div class="littele_menu"><a href="#">语言: 英语 <i class="fa fa-caret-down"></i></a> </div>
                                <ul class="option">
                                    <li><a href="#">法语</a></li>
                                    <li><a href="#">德语</a></li>
                                    <li><a href="#">日语</a></li>
                                </ul>
                            </div>
                            <div class="usd_area">
                                <div class="littele_menu"><a href="#">
                                    Currency: USD
                                    <i class="fa fa-caret-down"></i>
                                    </a>
                                </div>
                                <ul class="option">
                                    <li><a href="#">EUR - Euro</a></li>
                                    <li><a href="#">GBP - British Pound</a></li>
                                    <li><a href="#">INR - Indian Rupee</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <div class="header_right_area">
                        <ul style="margin-left: -30px;">
                        @if (session('userlogin'))
                            <li>
                                <a class="Shopping cart" href="/grzx">欢迎您{{session('user.nicheng')}}</a>
                            </li>
                            <li>
                                <a class="Shopping cart" href="/logout">退出</a>
                            </li>
                            <li>
                                <a class="Shopping cart" href="/grzx">我的账户</a>
                            </li>
                        @else
                            <li>
                                <a class="Shopping cart" href="/login">登录</a>
                            </li>
                            <li>
                                <a class="Shopping cart" href="/register">注册</a>
                            </li>
                        @endif
                            <li>
                                <a class="Shopping cart" href="/goodshouse">我的收藏</a>
                            </li>
                            <li>
                                <a class="Shopping cart" href="/goodshistory">我的足迹</a>
                            </li>
                            <li>
                                <a class="Shopping cart" href="/shoppingcar">购物车</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header top area end-->
    <!--header middle area start-->
    <div class="header_middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo_area">
                        <a href="/"><img src="/static/home/index/img/logo-pic/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header_all search_box_area">
                        <form class="new_search" role="search" method="get" action="/search">
                            <input id="mix_search" class="search-field" placeholder="搜索您想找的商品名称" value="{{ $request['search'] or '' }}" name="search" title="Search for:" type="search">
                            <input value="Search" type="submit">
                        </form>
                    </div>
                    <div class="header_all shopping_cart_area">
                        <div class="widget_shopping_cart_content">
                            <div class="topcart">
                                <a class="cart-toggler" href="">
                                    <i class="icon"></i>
                                    <span class="my-cart">@if(session('userlogin'))购物车@else请您先登录@endif</span>
                                    <span class="qty">@if(session('userlogin'))购物车共{{ count($gwc = $Sp::quanjugwc()) }}件商品@else您的专属购物车@endif</span>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                @if(session('userlogin'))
                                <div class="new_cart_section">
                                    <ol class="new-list">
                                        <!-- single item -->
                                        <?php $zgjg = 0; ?>
                                        @foreach($gwc = $Sp::quanjugwc() as $k => $v)
                                        @if($k <= 1)
                                        <li class="wimix_area">
                                            <a class="pix_product" href="/goodlist/{{ $v->goods_id }}">
                                                <img alt="" src="/static/admin/images/goods_img/{{ $v->goods->goods_img }}">
                                            </a>
                                            <div class="product-details">
                                                <a href="/goodlist/{{ $v->goods_id }}">{{ $v->goods->goods_name }}</a>
                                                <span class="sig-price">{{ $v->car_num }}×￥{{ $v->goods->goods_price }}</span>
                                            </div>
                                        </li>
                                        @endif
                                        <?php 
                                        $zgjg += $v->car_num * $v->goods->goods_price;
                                         ?>
                                        @endforeach
                                        <!-- single item -->
                                    </ol>
                                    <div class="top-subtotal">
                                        合计: <span class="sig-price">￥{{ $zgjg }}</span>
                                    </div>
                                    <div class="cart-button">
                                        <ul>
                                            <li>
                                                <a href="/shoppingcar">去我的购物车 <i class="fa fa-angle-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header footer area start-->
    <div class="all_menu_area">
        <div class="menu_inner">
            <div class="container">
                <div class="full_menu clearfix">
                    <div class="new_menu">
                        <div class="drp-menu">
                            <div class="col-md-3 pr pl">
                                <div class="all_catagories">
                                    <div class="enable_catagories">
                                        <i class="fa fa-bars"></i>
                                        <span>EC优购</span>
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </div>
          
    <div class="catagory_menu_area">
        <div class="catagory_mega_menu">
            <div class="cat_mega_start">
                <ul class="list">
    <!-- 导航开始 -->
    @foreach($common_cate as $k=>$v )

        <li class="next_area" >
                <a class="item_link" href="goodlist?cate_pid={{$v->id}}">
                    <span class="link_content">
                        <span class="link_text">
                    {{ $v->cate_name }}
                    <span class="link_descr">{{ $v->cate_desc }}</span>
                        </span>
                    </span>
                </a>

            <ul class="electronics_drpdown">
                <li class="parent">
                    <a href="#"></a>
                        <div class="mega_menu">
                            @foreach($v->sum as $kk => $vv)
                                <div class="mega_menu_coloumn">
                                    <ul>
                                        <li><a href="/goodlist?cate_id={{$vv->id}}">{{ $vv->cate_name }}</a></li>
                                            @foreach($vv->sum as $kkk=>$vvv)
                                            
                                            <li><a href="/goodlist?cate_id={{$vvv->id}}">{{ $vvv->cate_name }}</a></li>
                                            @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                </li>
            </ul>
        </li>
    @endforeach
    <!-- 导航结束 -->                                    
            </ul>
        </div>
    </div>
    </div>
</div>
             <!--menu area start-->
                            <div class="col-md-9 pl">
                                <div class="menu_area">
                                    <div class="menu">
                                        <nav>
                                            <ul>
                                                @foreach(App\Http\Model\Admin\Navigation::get() as $k =>$v)
                                                    <li><a href="{{ $v->nav_link }}">{{$v->nav_title}}</a></li>
                                                @endforeach
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- mobile-menu-area-start -->
<div class="mobile-menu-area hidden-md hidden-lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul id="nav">
                            <li><a href="index.html">Home</a></li>
							<li><a href="about-us.html">About</a></li>
							<li><a href="cart.html">Cart</a></li>
							<li><a href="list-view.html">List</a></li>
							<li><a href="my.account.html">Account</a></li>
							<li><a href="simple-product.html">Product</a></li>
							<li><a href="contact-us.html">Contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu-area-end -->
<!--slider area start-->
@section('content')

@show
        <!--newsletter area start-->

        <!--newsletter area end-->
        <!--footer top area start-->
        <div class="footer_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer_menu">
                            <div class="news_heading_2">
                                <h3>栏目一</h3>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    @foreach($data_column as $k=>$va)
                                    @if($va->column_sort==0)
                                    <li>
                                        <a href="{{ $va->column_url }}">{{ $va->column_title }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer_menu">
                            <div class="news_heading_2">
                                <h3>栏目二</h3>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    @foreach($data_column as $k=>$val)
                                    @if($val->column_sort==1)
                                    <li>
                                        <a href="{{ $val->column_url }}">{{ $val->column_title }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer_menu">
                            <div class="news_heading_2">
                                <h3>栏目三</h3>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    @foreach($data_column as $k=>$value)
                                    @if($value->column_sort==2)
                                    <li>
                                        <a href="{{ $value->column_url }}">{{ $value->column_title }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer_menu footer_menu_2">
                            <div class="news_heading_2">
                                <h3> EC优购 </h3>
                            </div>
                            <ul>
                                <li>
                                    <i class="fa fa-home"></i>
                                    <p>网站备案号：{{ $data_conf->conf_record }}</p>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <p>商务洽谈: (010) 56595733</p>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <p>Email: 295367893@qq.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer top area end-->
            <!--footer middle area start-->
            <div class="footer_middle">
                <div class="container">
                    <div class="fotter_inner">
                        <div class="middele_pic">
                            <img src="/static/home/index/img/icon/payment-300x30.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer middle area end-->
 
        <!--modal content start-->

		
		
		
		
		
		
        <!-- all js here -->
        <!-- jquery latest version -->
        <script src="/static/home/index/js/vendor/jquery-1.12.0.min.js"></script>
        <!-- bootstrap js -->
        <script src="/static/home/index/js/bootstrap.min.js"></script>
        <!-- nivo slider js -->
        <script src="/static/home/index/lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
        <script src="/static/home/index/lib/home.js" type="text/javascript"></script>
        <!-- owl.carousel js -->
        <script src="/static/home/index/js/owl.carousel.min.js"></script>
        <!-- meanmenu js -->
        <script src="/static/home/index/js/jquery.meanmenu.js"></script>
        <!-- jquery-ui js -->
        <script src="/static/home/index/js/jquery-ui.min.js"></script>
        <!-- easing js -->
        <script src="/static/home/index/js/jquery.easing.1.3.js"></script>
        <!-- mixitup js -->
        <script src="/static/home/index/js/jquery.mixitup.min.js"></script>
        <!-- jquery.countdown js -->
        <script src="/static/home/index/js/jquery.countdown.min.js"></script>
        <!-- wow js -->
        <script src="/static/home/index/js/wow.min.js"></script>
        <!-- popup js -->
        <script src="/static/home/index/js/jquery.magnific-popup.min.js"></script> 
        <!-- plugins js -->
        <script src="/static/home/index/js/plugins.js"></script>
        <!-- main js -->
        <script src="/static/home/index/js/main.js"></script>

@section('js')
@show

    </body>
    @if(session('login'))
    <?php session(['login'=>false]) ?>
    <script type="text/javascript">
        layui.use(['layer', 'form'], function(){
          var layer = layui.layer
          ,form = layui.form;
          out = 1;
          layer.msg('session('login')');
        });
    </script>
    @endif
</html>


