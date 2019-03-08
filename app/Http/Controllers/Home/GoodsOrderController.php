<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\UserAddr;
use App\Http\Model\Home\ShoppingCar;
use App\Http\Model\Admin\GoodsOrder;
use App\Http\Model\Admin\ShopDetail;
use App\Http\Model\Admin\Goods;
use App\Http\Model\Admin\Users;
use App\Http\Model\Home\GoodsShare;
use DB;

class GoodsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $uid = session('user.id');
            $data = GoodsOrder::where('user_id',$uid)->paginate(4);
            return view('home.goodsorder.show',['data'=>$data]);
        }catch(\Exception $err){
            return view('error.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            if(!session('userlogin')){
                return back()->with('error','您还没有登录请您先登录！');
            }
            $dangood = $request->all();
            if(!$dangood['attr']){
                return back()->with('error','您还没有选择商品的属性');
            }
            $dangood['attr'] = rtrim($dangood['attr'],',');

            $data[] = [
                    'goods_id' => $dangood['goods_id'],
                    'detail_price' => Goods::find($dangood['goods_id'])->goods_price,
                    'detail_conut' => $dangood['sum'],
                    'goods_name' => Goods::find($dangood['goods_id'])->goods_name,
                    'detail_attr' => $dangood['attr'],
                    'xj' => Goods::find($dangood['goods_id'])->goods_price * $dangood['sum']
                ];
             
            // 保存临时订单
            $code = str_random(10);
            session([$code => $data]);
            session(["{$code}.zongjiaqian" => $data[0]['xj']]);
            session(["{$code}.zongshuliang" => $data[0]['detail_conut']]);
            $attr = UserAddr::where('uid',session('user.id'))->get();
            return view('home.goodsorder.index',['code'=>$code,'zongshuliang'=>$data[0]['detail_conut'],'zongjiaqian'=>$data[0]['xj'],'data'=>$data,'attr'=>$attr]);
        }catch(\Exception $err){
            return view('error.index');
        }
    }

    /**
     * 生成新订单 支付中
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            // 开启事务
            DB::beginTransaction();
            // 判断用户有没有钱
            $user = Users::where('id',session('user.id'))->first();
            if($user->user_balance < session("{$data['code']}.zongjiaqian")){
                // 用户余额不足
                session([$data['code'] => null]);
                return view('success.yuebuzu');
            }
            // 现将用户账户余额扣除
            $user->user_balance = $user->user_balance - session("{$data['code']}.zongjiaqian");

            $goods = session($data['code']);
            // 获取用户地址
            $addr = UserAddr::where('id',$data['dz'])->first();
            // 生成定单号
            $order['rand_id'] = time().mt_rand(100000,999999);
            // 获取订单总价钱
            $order['order_sum'] = session("{$data['code']}.zongjiaqian");
            // 获取订单总数量
            $order['order_count'] = session("{$data['code']}.zongshuliang");
            // 获取用户ID
            $order['user_id'] = session('user.id');
            // 获取收货人
            $order['order_rec'] = $addr['user_take'];
            // 获取收货地址
            $order['order_addr'] = $addr['user_addr'];
            // 获取收货邮编
            $order['order_code'] = $addr['user_code'];
            // 获取收货手机号
            $order['order_phone'] = $addr['user_phone'];
            // 买家留言 扩展性
            $order['user_msg'] = '';
            // 初始化订单状态
            $order['order_status'] = '0';
            // 设置下单时间
            $order['created_at'] = time();
            // 保存订单表
            $orderId = GoodsOrder::insertGetId($order);
            // 更新用户账户余额
            $pdcg = $user->save();
            // 销毁无用数组
            unset($goods['zongjiaqian']);
            unset($goods['zongshuliang']);
            // 遍历插入商品详情
            foreach($goods as $k => $v){
                $detailgoods['order_id'] = $orderId;
                $detailgoods['goods_id'] = $v["goods_id"];
                $detailgoods['detail_price'] = $v["detail_price"];
                $detailgoods['detail_count'] = $v["detail_conut"];
                $detailgoods['detail_attr'] = $v["detail_attr"];
                $judge[] = ShopDetail::insert($detailgoods);
                if(!empty($v['car_id'])){
                    ShoppingCar::destroy($v['car_id']);
                }
            }
            $pd = true;
            // 判断是否全部插入数据库
            foreach($judge as $k => $v){
                if(!$v){
                    $pd = false;
                }
            }
            if($pd && $orderId && $pdcg){
                DB::commit();
                session([$data['code'] => null]);
                $request->session()->flash('oid',$orderId);
                return view('home.goodsorder.share');
            }
            session([$data['code'] => null]);
            DB::rollBack();
        }catch(\Exception $err){
            session([$data['code'] => null]);
            return view('error.index');
        }
    }

    /**
     * 用户确认收货
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = GoodsOrder::where('user_id',session('user.id'))->where('id',$id)->first();
        // var_dump($data->order_status);die;
        if(!$data){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        if($data->order_status != 1){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        $data->order_status = '2';
        try{
            $data->save();
        }catch(\Exception $err){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        $arr = [
            'code' => '1'
        ];
        return json_encode($arr);
    }

    /**
     * 订单详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ShopDetail::where('order_id',$id)->paginate(3);
        $su = ShopDetail::where('order_id',$id)->get();
        return view('home.goodsorder.detail',['su'=>$su,'data'=>$data]);
    }

    /**
     * 预生成新订单
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $goods = $request->all();
            // 总价钱
            $zongjiaqian = 0;
            // 总数量
            $zongshuliang = 0;
            // 商品简情
            $data = [];
            // 在后台重新计算商品数量及价钱，确保数据安全
            foreach($goods['like'] as $k => $v){
                $gouwuchedanjian = ShoppingCar::where('id',$v)->first();
                $zongshuliang += $gouwuchedanjian->car_num;
                $xj = $gouwuchedanjian->goods->goods_price * $gouwuchedanjian->car_num;
                $zongjiaqian += $xj;

                $data[] = [
                    'goods_id' => $gouwuchedanjian->goods_id,
                    'detail_price' => $gouwuchedanjian->goods->goods_price,
                    'detail_conut' => $gouwuchedanjian->car_num,
                    'goods_name' => $gouwuchedanjian->goods->goods_name,
                    'detail_attr' => $gouwuchedanjian->attr,
                    'car_id' => $gouwuchedanjian->id,
                    'xj' => $xj
                ];
            }
            // 保存临时订单
            $code = str_random(10);
            session([$code => $data]);
            session(["{$code}.zongjiaqian" => $zongjiaqian]);
            session(["{$code}.zongshuliang" => $zongshuliang]);

            $attr = UserAddr::where('uid',session('user.id'))->get();
            return view('home.goodsorder.index',['code'=>$code,'zongshuliang'=>$zongshuliang,'zongjiaqian'=>$zongjiaqian,'data'=>$data,'attr'=>$attr]);
        }catch(\Exception $err){
            return view('error.index');
        }
    }

    /**
     * 用户关闭订单
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = GoodsOrder::where('user_id',session('user.id'))->where('id',$id)->first();
        // var_dump($data->order_status);die;
        if(!$data){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        if($data->order_status != 1 && $data->order_status != 0){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        $data->order_status = '3';
        try{
            $data->save();
            // 查询订单价钱 
            $sum = $data->order_sum;
            // 找到关闭订单用户
            $user = Users::where('id',session('user.id'))->first();
            // 将订单金额退还用户
            $user->user_balance = $user->user_balance + $sum;
            // 更新用户信息
            $user->save();
            // 查询错误异常
        }catch(\Exception $err){
            $arr = [
                'code' => '0'
            ];
            return json_encode($arr);
        }
        $arr = [
            'code' => '1'
        ];
        return json_encode($arr);
    }


    // 处理分享订单
    function share(Request $request)
    {
        $data = $request->except(['_token']);
        $data['uid'] = session('user.id');
        $data['time'] = time();
        $order = GoodsShare::where('uid',$data['uid'])->where('oid',$data['oid'])->first();
        if($order){
            return redirect('/goodsorder')->with('share','您已经分享过，请勿重复分享');
        }

        $user = Users::find(session('user.id'));
        $user->jf = $user->jf + 10;
        try{
            $judge = GoodsShare::insert($data);
            $user->save();
            if($judge && $user){
                return redirect('/goodsorder')->with('share','恭喜您分享成功');
            }
        }catch(\Exception $err){
            return redirect('/goodsorder')->with('share','对不起，商品分享失败');
        }
    }





}
