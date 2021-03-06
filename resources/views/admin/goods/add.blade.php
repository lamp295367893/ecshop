@extends('layout.admin')
@section('title', '商品管理')
@section('url', 'http://www.ecshop.com/admin/goods')
@section('title2', '添加商品')
@section('content')
<div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">添加商品</span>
            </div>
            <div class="widget-body" style="height: 1570px">
                <div id="horizontal-form">


                    @if (count($errors) > 0)
                        <div class="alert alert-warning fade in">
                            <ul>
                                <button class="close" data-dismiss="alert">
                                ×
                                </button>
                                    @foreach ($errors->all() as $error)
                                        <i class="fa-fw fa fa-warning"></i>
                                            <strong>Warning</strong> {{ $error }}
                                         <br>
                                    @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" id="art_form" action="/admin/goods"  method="post" enctype="multipart/form-data" >                    
                        <meta name="csrf-token" content="{{ csrf_token() }}">  
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">商品名称</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="请填写名称" name="goods_name"  type="text" value="{{old('goods_name')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">商品标语</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="请填写标语" name="goods_title"  type="text" value="{{old('goods_title')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">商品主图</label>
                            <div class="col-sm-6">
                                <input placeholder="" id="file_upload" name="goods_img" type="file"  value="{{old('goods_img')}}">
                                <img src="/static/admin/images/onclick.jpg" style="width: 100px" alt="上传后显示图片" id="img1">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">商品相册</label>
                            <div class="col-sm-6">
                                <input placeholder="" name="goods_imgs[]" type="file"  multiple   >
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right">上架</label>
                        <div class="col-sm-10">
                            <label class="col-sm-offset-1">
                                <input type="radio" class="colored-blue" name="goods_status" checked="checked" value="1">
                                <span class="text">是</span>
                            </label>
                            <label style="margin-left: 20px;">
                                <input type="radio" class="colored-danger" name="goods_status" value="2">
                                <span class="text">否</span>
                            </label>
                            </div> 
                        </div> 

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">所属分类</label>
                            <div class="col-sm-6" >
                                <select name="cate_id" class="form-control">
                                <option disabled value="0">顶级分类</option>
                                @foreach($cate as $k => $v)
                                 
                                    <option {{ $v->Catejz_no }} value="{{ $v->id }}">{{ $v->catenamea }}</option>
                                @endforeach
                            </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必选</p>
                        </div>



                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">所属类型</label>
                            <div class="col-sm-6">
                                <select name="type_id"  class="form-control">
                                    <option value="0" disabled> -- 请选择 -- </option>
                                     @foreach($type as $k => $v)
                                    <option value="{{ $v->id }}" @if($v->id == old('type_pid')) selected @endif> |-- {{ $v->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必选</p>
                        </div>

                         <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">所属品牌</label>
                            <div class="col-sm-6">
                                <select name="brand_id"  class="form-control">
                                    <option value="0" disabled> -- 请选择 -- </option>
                                     @foreach($brand as $k => $v)
                                    <option value="{{ $v->id }}" @if($v->id == old('brand_id')) selected @endif> |-- {{ $v->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必选</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">市场价</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="￥:124.11(保留小数点后两位)" name="markte_price"  type="text" value="{{old('markte_price')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 市场价必须为数字且小数点后保留两位</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">本店价</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="￥:124.11(保留小数点后两位)" name="goods_price"  type="text" value="{{old('goods_price')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 本店价必须为数字且小数点后保留两位</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">浏览量</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="请填写点击数量" name="click_num"  type="text" value="0" readonly>
                            </div>
                            <p class="help-block col-sm-4 red">* 无需填写，默认为0</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">商品重量</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="请填写商品重量" name="goods_weight"  type="text" value="{{old('goods_weight')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 商品重量需填写至少一位数字</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">库存</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="请填写库存数量" name="goods_num"  type="text" value="{{old('goods_num')}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 库存需填写至少一位数字</p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right" name="goods_desc">商品详情</label>
                            <div class="col-sm-6">
                                <!-- 加载编辑器的容器 -->
                            <script id="container" name="goods_desc" type="text/plain" style="width: 800px;height: 500px"><p value="{{old('goods_desc')}}">{!!old('goods_desc')!!}</p></script>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                         <!-- <p class="help-block col-sm-4 red">* 必填</p> -->
                    
                           
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">保存商品</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- 配置文件 -->
    <script type="text/javascript" src="/static/admin/udit/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/static/admin/udit/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{ initialFrameWidth: null , autoHeightEnabled: false});
    </script>

    <script type="text/javascript">
        
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(function () {
        $("#file_upload").change(function () {
            uploadImage();
        })
    })

    function uploadImage() {
//  判断是否有选择上传文件
        var imgPath = $("#file_upload").val();

        if (imgPath == "") {
            alert("请选择上传图片！");
            return;
        }
        //判断上传文件的后缀名
        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif'
            && strExtension != 'png' && strExtension != 'jpeg') {
            alert("请选择正确的图片类型文件");
            return;
        }

        var formData = new FormData($('#art_form')[0]);
        $.ajax({
            type: "POST",
            url: "/admin/goods/profile",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //console.log(data);
                $('#img1').attr('src',data);
                //$('#art_thumb').val(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("上传失败，请检查网络后重试");
            }
        });
    }

</script>
@endsection
