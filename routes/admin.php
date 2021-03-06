<?php 
// 前台用户控制器
Route::resource('user','UsersController');

//后台框架
Route::get('/index', function () {
    return view('layout/admin');
});

 // 后台首页
 Route::view('/index', 'index.index');
// 管理员退出路由
Route::get('/oulogin','AdminController@outlogin');
//权限的提醒信息
Route::get('/remind','AdminsController@remind');
//'middleware'=>'RolePer'
/*路由组开始*/
Route::group([],function(){

/**
* 张宇童负责的模块
*/
// 修改邮箱
Route::view('/editemail','admin.admin.editemail');
// 发送邮件
Route::post('/sendemail/{id}','AdminController@sendemail');
// 商品品牌图标上传路由
Route::post('/goodsbrand/files','GoodsBrandController@files');
// 商品品牌 状态调整 路由
Route::get('/goodsbrand/editstatus/{id}','GoodsBrandController@editstatus');
// 商品品牌管理路由
Route::resource('/goodsbrand','GoodsBrandController');
/*** 管理员个人中心路由 ***/
// 执行发送修改手机号短信
Route::post('/admin/revise/{id}','AdminController@revise');
// 执行发送修改密码短信
Route::post('/admin/editpwd/{id}','AdminController@editpwd');
// 执行更换头像
Route::post('/admin/pic/{id}','AdminController@pic');
Route::resource('/admin','AdminController');
/*** 分类操作 ***/
// 操作分类上衣
Route::get('/goodscategory/prev/{id}','GoodsCategoryController@prev');
// 操作分类下移
Route::get('/goodscategory/next/{id}','GoodsCategoryController@next');
Route::resource('/goodscategory','GoodsCategoryController');
/*** 订单主表路由 ***/
Route::resource('/goodsorder','GoodsOrderController');
/*** 地址管理 ***/
Route::resource('/useraddr','UserAddrController');
/*** 管理员管理模块 ***/
/*** 管理员Ajax上传头像路由 ***/
Route::post('/admins/files','AdminsController@files');
//管理员里面链接角色的路由
Route::get('/userrole/{id}','AdminsController@userrole');
Route::post('/douserrole/{id}','AdminsController@douserrole');
Route::resource('/admins','AdminsController');
/*** 系统设置 ***/
Route::post('/conf/files','ConfController@files');
Route::resource('/conf','ConfController');
/*** 优惠卷管理 ***/
// 查看发放详情
Route::get('/discount/indexdetail','DiscountController@indexdetail');
Route::resource('/discount','DiscountController');
/**
* 冯雪娇负责的模块
*/

//轮播图管理
//管理轮播图Ajax上传路由
Route::any('lunbo/profile','LunboController@profile');
Route::resource('lunbo','LunboController');
//文章管理
//管理文章Ajax上传路由
Route::any('articles/profile','ArticlesController@profile');
Route::resource('articles','ArticlesController');
//属性管理
Route::resource('goodsattr','GoodsAttrController');
//商品类型
Route::resource('goodstype','GoodsTypeController');
//回收站
Route::get('goods/hs','GoodsController@hs');
//回收站恢复
Route::get('goods/huifu/{id}','GoodsController@huifu');
//回收站彻底删除
Route::get('goods/shanchu/{id}','GoodsController@shanchu');
//商品管理
//管理商品Ajax上传路由
Route::any('goods/profile','GoodsController@profile');
Route::resource('goods','GoodsController');
//添加在角色里面添加权限的路由
Route::get('roleper/{id}','RoleController@roleper');
//处理角色里面权限的路由
Route::post('doroleper/{id}','RoleController@doroleper');
//角色管理
Route::resource('role','RoleController');

//权限管理
Route::resource('permission','PermissionController');

/**
* 张忠良负责的模块
*/

// 广告图片上传
Route::post('/ad/files','AdvertisingController@files');
// 广告路由
Route::resource('ad','AdvertisingController');
// 导航路由
Route::resource('nav','NavigationController');
// 栏目图片上传
Route::post('/column/files','ColumnController@files');
// 栏目路由
Route::resource('column','ColumnController');
// 活动路由
Route::resource('activity','GoodsActivityController');
// 充值卡路由
Route::resource('recharge','RechargeController');

/**
* 牛宇新负责的模块
*/
 //友情链接部分
 Route::resource('links','LinksController');
 // 后台登录
 Route::get('/admin/login', 'AdminsController@login');

});
