@extends('layout.home')
@section('content')
@inject('Erweima', 'App\common\Erweima')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="shop_menu shop_menu_2">

                <ul class="cramb_area cramb_area_5">
                    <li>
                        <a href="javascript:;">
                            {{ $goods->pdcate }} /
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            商品详情
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 上部商品开始 -->
<div class="elavator_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- 商品主图 -->
                <div class="elavetor" id="small">
                    <img id="smallImg" src="/static/admin/images/goods_img/{{$goods->goods_img}}" data-zoom-image="img/elavetor/large/l-8.jpg" alt="" style="width: 360px;height: 360px">
                    <!-- 放大镜的图 -->
                    <div class="proinfo" id="big" style="width: 400px;height: 400px;position: absolute;left:400px;top:0px;display: none;overflow: hidden;z-index: 1000">
                        <img id="bigImg" src="/static/admin/images/goods_img/{{$goods->goods_img}}" style="position: absolute;">
                    </div>
                    <!-- 移动阴影框 -->
                    <div id="move" style="width: 100px;height: 100px;position: absolute;left: 0px;top: 0px;display: none;background: url('/static/admin/images/common/bg.png')">
                    </div>
                
                
                </div>
                <p>
                <!-- 遍历小图相册 -->
                 @foreach($goodsimgs as $k=>$v)
                 <ul id="uls" style="display: inline-block;border: 1px solid blue">
                    <div  class="al_zoom" >
                        <li>
                            <img id="zoom" src="/static/admin/images/goods_imgs/{{$v->goods_imgs}}" data-zoom-image="img/elavetor/large/l-8.jpg" alt="" style="display: inline-block; width: 80px;height: 80px;">
                        </li>
                    </div>
                </ul>
                 @endforeach
                </p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="elav_titel">
                    <div class="elv_heading">
                        <h3>
                            {{$goods->goods_name}}
                        </h3>
                    </div>
                    <div class="price_rating">
                        <a href="#">
                            <i class="fa fa-star">
                            </i>
                        </a>
                        <a href="#">
                            <i class="fa fa-star">
                            </i>
                        </a>
                        <a href="#">
                            <i class="fa fa-star">
                            </i>
                        </a>
                        <a href="#">
                            <i class="fa fa-star">
                            </i>
                        </a>
                        <a class="not-rated" href="#">
                            <i class="fa fa-star-o">
                            </i>
                        </a>
                        <a class="review-link" href="#">
                            (
                            <span class="count">
                                {{$goods->click_num}}
                            </span>
                            点击热度)
                        </a>
                    </div>
                    <div class="evavet_description">
                        <p>
                            {{$goods->goods_title}}
                        </p>
                    </div>
                    <div class="elavetor_social">
                        <h4 class="widget-title">
                            重量
                        </h4>
                        <ul class="social-link">
                            <li>
                             {{$goods->goods_weight}}
                            </li>

                        </ul>
                    </div>
                    <div class="elavetor_social" id="goods_kc">
                        <h4 class="widget-title">
                            库存
                        </h4>
                        <ul class="social-link">
                            <li>
                             {{$goods->goods_num}}&nbsp;件
                            </li>

                        </ul>
                    </div>








                    <form class="cart-btn-area" action="/shoppingcar" method="post">
                        {{ csrf_field() }}

                    @foreach($type as $k=>$v)
                    <div class="elavetor_social">
                        <h2 class="widget-title">
                            {{$v->attr_name}}
                        </h2>
                        <ul class="social-link"> 
                            <?php $array = explode(',', $v->attr_value); ?>
                            @foreach($array as $kk=>$vv)
                            <li onclick="dian(this)" >
                                <input type="radio" name="{{ $v->attr_name }}" class="goods-attr sx" id="attr" value="{{$vv}}">&nbsp;{{$vv}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="elav_info">
                    <div class="price_box price_box_acr">
                        <span class="old- price old- price-2">
                            ￥{{$goods->markte_price}}
                        </span>
                        <span class="spical-price spical-price-2">
                            ￥{{$goods->goods_price}}
                        </span>
                    </div>
                    <input type="text" hidden name="goods_id" value="{{ $goods->id }}">
                    <div class="cart-btn-area">
                        <a name="" class="minus" href="javascript:void(0);"></a>

                        <input type="number" id="nua" value="1" id="buyNum" name="sum">
                        <a name="" class="plus" href="javascript:void(0);"></a>
                        <button class="add-tocart cart_zpf" type="submit">
                            加入购物车
                        </button>
                    </form>
                    </div>
<form action="/goodsorder/create" method="get">
    <input type="text" value="1" hidden name="sum" id="nub">
    <input type="text" hidden name="goods_id" value="{{ $goods->id }}">
    <input type="text" hidden name="attr" class="sxb" value="">
                        <a href="javascript:buyNowTime(this);">


                        <button style="margin-left: 75px;" class="add-tocart cart_zpf" type="submit" id="buyNowAddCart">
                            立即购买
                        </button>
                        </a>
</form>










                    <div class="add_defi">
                        <a href="javascript:;" onclick="tjsc({{ $goods->id }},this);" data-original-title="添加到我的收藏" data-toggle="tooltip">
                            <i class="fa fa-heart another_icon">
                            </i>
                            收藏
                        </a>
                    </div>
                    <div class="new_meta">
                        <!-- <span class="sku_wrapper">
                            服务:
                            <span class="sku">
                                由易c优购商城提供售后服务
                            </span>
                        </span>
                        <span class="sku_wrapper">
                            承诺:
                            
                            <span class="sku">
                                七天无理由退换货
                            </span>
                        </span>

                        <span class="sku_wrapper">
                            提示:
                            
                            <span class="sku">
                                图片仅供参考，以实物为主
                            </span>
                        </span> -->
                        <span class="sku_wrapper">
                            扫码购物:<br>
                            {{ $Erweima::sc('http://www.ecuuu.com/goodlist/'.$goods->id) }}
                            
                                                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 上部商品结束 -->
<script type="text/javascript">
    
        function dian(obj){
            $(obj).click(function(){
            $(obj).attr('checked','checked').siblings().removeAttr('checked');
            });
    }

    <?php session(['ck_goods_id' => $goods->id]) ?>

          function buyNowTime(o)
          {
                var buyNum = $('#buyNum').val();
                var goodsId = '{{ $goods->id }}';
                if (parseInt(buyNum) < 1) {
                    alert('您选择的商品数量不能小于1件');
                    return ;
                 }
                var n = false;
                var attr = $('.goods-attr').each(function(index, el) {
                    
                    if ($(this).parent().attr('checked') == 'true') {
                       n = true;
                    }

                });;

                if (!n) {
                    alert('请选择商品属性!')
                    return ;
                }

                var kc = $('#goods_kc').attr('value');

                if (parseInt(buyNum) > parseInt(kc)) {
                    alert('您选择的商品数量已经超过库存!');
                    $('#buyNum').val(kc);
                    return ;
                }

</script>
<!-- 详情开始 -->
<div class="tab_area_start">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <div class="my-tabs">
                            <!-- Nav tabs -->
                            <ul class="favtabs favtabs-2 favtabs-nytr" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">商品介绍</a></li>
                                <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">商品评价</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="center" align="center">
                                                
                                                <p>{!!$goods->goods_desc!!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="tb_desc">
                                                <div class="review_area_heading">
                                                    <div id="comnt">
                                                        <h2>商品的评论</h2>
                                                        <ol class="commentlist" style="padding-left: 0px;">
@foreach($data as $k=>$v)
<li class="comment even thread-even depth-1" itemscope="" id="res">
    <div class="comment_container">
        <div class="comment-text" style="margin-left: 0px;">
            <div class="star-rating" title="Rated 4 out of 5" itemscope="">
            </div>
            <p class="meta">
                <strong>{{$v->users->nicheng}}</strong>
                –
                <time datetime="2015-12-16T15:26:49+00:00">{{date('Y/m/d H:i:s',$v->goods_create_time)}}</time>
            </p>
            <div class="description">
                <p>{{$v->goods_content}}</p>
            </div>
        </div>
    </div>
</li>
@endforeach

<li style="display: none;" class="comment even thread-even depth-1 ooooo" itemscope="" id="res">
    <div class="comment_container">
        <div class="comment-text" style="margin-left: 0px;">
            <div class="star-rating" title="Rated 4 out of 5" itemscope="">
            </div>
            <p class="meta">
                <strong id="yhnc"></strong>
                <time datetime="2015-12-16T15:26:49+00:00" id="fbsj"></time>
            </p>
            <div class="description">
                <p id="yhnr"></p>
            </div>
        </div>
    </div>
</li>

                                                        </ol>
                                                        {{ $data->links() }}
                                                    </div>
                                                    <div class="review_form_area">
                                                        <div class="review_form">
                                                            <div class="revew_form_content">
                                                                <h3 id="reply-title" class="comment-reply-title">
                                                                    请添加一条评论
                                                                    <small>
                                                                    <a id="cancel-comment-reply-link" style="display:none;" href="#" rel="nofollow">Cancel reply</a>
                                                                    </small>
                                                                </h3>
<div id="commentform" class="comment-form">
    <div class="comment-form-comment">
        <label class="comment">你的评论</label>
        <textarea id="comment" aria-required="true" rows="8" cols="45" name="goods_content"></textarea>
    </div>
    <div class="form-submit">
        <input id="sub" class="submt" type="submit" value="评论">
    </div>
</div>
<script>
    $('#sub').click(function(){
        $.post("/reply",{
            "_token": "{{ csrf_token() }}",
            goods_content:$('#comment').val(),
            gid:{{$goods->id}}
        },function(data){
            if(data.code == 0){
                layui.use(['layer', 'form'], function(){
                    var layer = layui.layer
                    ,form = layui.form;
                    layer.msg(data.msg);
                });
            }else if(data.code == 1){
                layui.use(['layer', 'form'], function(){
                    var layer = layui.layer
                    ,form = layui.form;
                    layer.msg(data.msg);
                    $('#comment').val('');// 当评论成功时 让文本域里的值为空
                    var abcd = $('#res').append($('.ooooo')); //获取
                    $(abcd).find('#yhnc').html("{{ session('user.nicheng') }}"); //填充用户名
                    $(abcd).find('#fbsj').html('- 刚刚'); //发表时间
                    $(abcd).find('#yhnr').html(data.goods_content); //发表内容
                    $('.ooooo').css('display','block'); //显示出来
                    $('.commentlist').prepend(abcd);//插入到ol里
                });
            }else if(data.code == 2){
                layui.use(['layer', 'form'], function(){
                    var layer = layui.layer
                    ,form = layui.form;
                    layer.msg(data.msg);
                });
            }
        },'json')
    });
</script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 </div>

<!-- 底部同品牌推荐开始 -->
<section class="product_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="all_product">
                            <div class="new_product">
                                <div class="product_heading">
                                    <i class="fa fa-paper-plane-o"></i>
                                    <span>同品牌排行</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="product_tx">
                                    @foreach($goods_brand as $k=>$v)
                                    <div class="col-md-3">
                                        <div class="all-pros">
                                            <div class="single_product single_product_2">
                                                <span>hot</span>
                                            </div>
                                            <div class="sinle_pic">
                                                <a href="/goodlist/{{$v->id}}">
                                                <img class="primary-img" src="/static/admin/images/goods_img/{{$v->goods_img}}" alt="" style="width: 260px;height: 170px">
                                                <img class="secondary-img" src="/static/admin/images/goods_img/{{$v->goods_img}}" alt="" style="width: 260px;height: 170px">
                                                </a>
                                            </div>
                                            <div class="product-action" data-toggle="modal" data-target="#myModal">
                                            </div>
                                            <div class="product_content">
                                                <div class="usal_pro">
                                                    <div class="product_name_2" >
                                                        <h2 style="height: 50px;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">
                                                            <a href="#">{{$v->goods_name}}</a>
                                                        </h2>
                                                    </div>
                                                    <div class="product_price">
                                                        <div class="price_rating">
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                            <div class="price_box">
                                <span class="spical-price">￥{{ $v->markte_price }}</span>
                            </div>
                                                    <div class="last_button_area last_button_area_px">
                                                        <ul class="add-to-links clearfix">
                                                            <li class="addwishlist">
                                                                <div class="yith-wcwl-add-button show">
                                                                    <a onclick="tjsc({{ $v->id }},this);" class="add_to_wishlist" href="javascript:;" rel="nofollow" data-product-id="45" data-product-type="external" data-toggle="tooltip" title="" data-original-title="添加到收藏"><i class="fa fa-heart"></i></a>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="new_act">
                                                                    <a class="button_act" data-quick-id="45" href="/goodlist/{{ $v->id }}" target="_blank" title="" data-toggle="tooltip" data-original-title="更快捷的添加购物车">查看商品详情</a>
                                                                </div>
                                                            </li>
                                                            <li class="addcompare">
                                                                <div class="woocommerce product compare-button">
                                                                    <a class="compare button" href="" data-product_id="45" rel="nofollow" data-toggle="tooltip" title="" data-original-title="Compare"><i class="fa fa-refresh"></i></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- 底部同品牌推荐结束 -->

<!-- 最底部同类型推荐开始 -->
<section class="product_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="all_product">
                            <div class="new_product">
                                <div class="product_heading">
                                    <i class="fa fa-coffee"></i>
                                    <span>同类型推荐</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="product_tx">
                                    @foreach($goods_type as $k=>$v)
                                    <div class="col-md-3">
                                        <div class="all-pros">
                                            <div class="single_product single_product_2">
                                                <span>hot</span>
                                            </div>
                                            <div class="sinle_pic">
                                                <a href="/goodlist/{{$v->id}}">
                                                <img class="primary-img" src="/static/admin/images/goods_img/{{$v->goods_img}}" alt="" style="width: 260px;height: 170px">
                                                <img class="secondary-img" src="/static/admin/images/goods_img/{{$v->goods_img}}" alt="" style="width: 260px;height: 170px">
                                                </a>
                                            </div>
                                            <div class="product-action" data-toggle="modal" data-target="#myModal">  
                                            </div>
                                            <div class="product_content">
                                                <div class="usal_pro">
                                                    <div class="product_name_2" >
                                                        <h2 style="height: 50px;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">
                                                            <a href="#">{{$v->goods_name}}</a>
                                                        </h2>
                                                    </div>
                                                    <div class="product_price">
                                                        <div class="price_rating">
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                            <a href="#"><i class="fa fa-star"></i></a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                            <a href="#">
                                                            <i class="fa fa-star"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="price_box">
                                                        <span class="spical-price">￥{{$v->markte_price}}</span>
                                                    </div>
                                                    <div class="last_button_area last_button_area_px">
                                                        <ul class="add-to-links clearfix">
                                                            <li class="addwishlist">
                                                                <div class="yith-wcwl-add-button show">
                                                                    <a onclick="tjsc({{ $v->id }},this);" class="add_to_wishlist" href="javascript:;" rel="nofollow" data-product-id="45" data-product-type="external" data-toggle="tooltip" title="" data-original-title="添加到收藏"><i class="fa fa-heart"></i></a>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="new_act">
                                                                    <a class="button_act" data-quick-id="45" href="/goodlist/{{ $v->id }}" target="_blank" title="" data-toggle="tooltip" data-original-title="更快捷的添加购物车">查看商品详情</a>
                                                                </div>
                                                            </li>
                                                            <li class="addcompare">
                                                                <div class="woocommerce product compare-button">
                                                                    <a class="compare button" href="" data-product_id="45" rel="nofollow" data-toggle="tooltip" title="" data-original-title="Compare"><i class="fa fa-refresh"></i></a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- 最底部同类型推荐结束 -->
@endsection

@section('js')
    <script>

        $('.minus').click(function(){
            var num = $('#buyNum').val();
            num--;
            if(num <= 1){
                num =1;
            }
            $('#buyNum').val(num);
        });
        $('.plus').click(function(){
            var num = $('#buyNum').val();
            num++;
            var goods_kc = $('#goods_kc').text();
            if(num >= goods_kc){
                num = goods_kc;
            }
            $('#buyNum').val(num);
        });
       //放大镜
        $('#small').mouseover(function(){
            $('#move,#big').show();

            $('#move').mousemove(function(e){
                //获取移动时获取各项的值
                var x = e.pageX;
                var y = e.pageY;

                var l = $('#small').offset().left;
                var t = $('#small').offset().top;

                var mw = $('#move').width() /2;
                var mh = $('#move').height() /2;

                var sl = x - l - mw;
                var sh = y -t - mh;
                if(sl <= 0){
                    sl =0;
                }
                if(sh <= 0){
                    sh =0;
                }
                var maxl = $('#small').width()-$('#move').width();
                var maxt = $('#small').height()-$('#move').height();
                if(sl >= maxl){
                    sl = maxl;
                }
                if(sh >= maxt){
                    sh = maxt;
                }
                //设置偏移量
                $('#move').css('left',sl+'px');
                $('#move').css('top',sh+'px');


                //2.大图片 移动
                var bl = sl / $('#small').width() * $('#bigImg').width();
                var bt = sh / $('#small').height() * $('#bigImg').height();

                $('#bigImg').css('left',-bl+'px');
                $('#bigImg').css('top',-bt+'px');
            });
        });


        $('#small').mouseout(function(){
            $('#move').css('display','none');
            $('#big').css('display','none');
        });

        //更换图片
        $('#uls img').click(function(){
            var src = $(this).attr('src');
            $('#bigImg').attr('src',src);
            $('#smallImg').attr('src',src);
        });



        $('#nua').change(function(){
            $('#nub').val($('#nua').val());
        });


        $('.sx').click(function(){
            $('.sxb').val('');
            $('.sx').each(function(){
                if($(this).prop('checked') == true){
                    $('.sxb').val($('.sxb').val() + $(this).val() +','); 
                }
            });
        });



        function tjsc(id,ud)
        {
            $.post("/goodshouse", {    
               "_token": "{{ csrf_token() }}",
               'gid':id
            }, function(data) {
                if(data.code == 0){
                    layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg(data.msg);
                    });
                }else{
                    layui.use(['layer', 'form'], function(){
                      var layer = layui.layer
                      ,form = layui.form;
                      layer.msg(data.msg);
                    });
                }
            },'json');
        }
    </script>
<script src="/static/home/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="/static/home/js/iziToast.min.js" type="text/javascript"></script>
<script src="/static/home/js/demo.js" type="text/javascript"></script>
<link rel="stylesheet" href="/static/home/css/iziToast.min.css">
<!-- <link rel="stylesheet" href="/static/home/css/dem.css"> -->
<script type="text/javascript">
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
        iziToast.show({
        icon: 'icon-contacts',
        title: "错误提示",
        message: ' {{ $error }}',
        position: 'topCenter',
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
        progressBarColor: 'rgb(0, 255, 184)',
        image: '/static/home/img/avatar.jpg',
        imageWidth: 70,
        layout:2,
        onClose: function(){
            console.info('onClose');
        },
        iconColor: 'rgb(0, 255, 184)'
    });
        @endforeach
    @endif
    @if(session('error'))
        iziToast.show({
        icon: 'icon-contacts',
        title: "友情提示",
        message: "{{ session('error') }}",
        position: 'topCenter',
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
        progressBarColor: 'rgb(0, 255, 184)',
        image: '/static/home/img/avatar.jpg',
        imageWidth: 70,
        layout:5,
        onClose: function(){
            console.info('onClose');
        },
        iconColor: 'rgb(0, 255, 184)'
    });
    @endif
    @if(session('success'))
        iziToast.show({
        icon: 'icon-contacts',
        title: "成功提示",
        message: "{{ session('success') }}",
        position: 'topCenter',
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
        progressBarColor: 'rgb(0, 255, 184)',
        image: '/static/home/img/avatar.jpg',
        imageWidth: 70,
        layout:5,
        onClose: function(){
            console.info('onClose');
        },
        iconColor: 'rgb(0, 255, 184)'
    });
    @endif
</script>
@stop


