<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\admin\Column;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取搜索关键字
        $search = $request->input('search','');
        // 获取广告所有数据
        $data = Column::where('column_title','like','%'.$search.'%')
                ->orderBy('id','desc')
                ->paginate(5);
        // 将数据分配到模板
        return view('admin/column/index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示栏目添加页面
        return view('admin/column/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接收数据
        $data = $request->except(['_token']);
        // 向数据库存储数据
        $res = Column::insert($data);

        // 判断是否保存成功
        if($res){
            return redirect('/admin/column')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 查询数据
        $data = Column::where('id',$id)->first();
        // 分配到模板
        return view('admin/column/show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查找数据
        $data = Column::find($id);
        // 分配到模板
        return view('admin/column/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 接收数据
        $data = $request->except(['_token','_method']);
        //修改数据
        $res = Column::where('id',$id)->update($data);

        // 判断是否修改成功
        if($res){
            return redirect('/admin/column')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败,请修改信息或返回上一级');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 删除数据库中数据
        $res = Column::destroy($id);
        // 判断是否成功
        if($res){
            return redirect('/admin/column')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    
}
