<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\Links;
use App\Http\Requests\LinksStoreRequest;
use App\common\FileUtil;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取数据
        $data = Links::paginate(5);
        // 引用模板
        return view('admin/links/index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 跳转到admin下links下的add.blade.php
        return view('admin/links/add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinksStoreRequest $request)
    {
        //获取表单提交的数据
        $data = $request->except(['_token']);
        
        // 图片处理
        if($request->hasFile('link_logo')){
            $files = $request->file('link_logo');
            $fileName = $files->store('admin/images/links');
        }

        $data['link_logo'] = $fileName;
        $row = Links::insert($data);
        // dump($data);
        if($row){
            return redirect('admin/links')->with('success','添加成功');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $links = Links::find($id);
        return view('admin/links/edit',['links'=>$links]);
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
        //
        $links = $request->except(['_token','_method']);
        dump($links);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
