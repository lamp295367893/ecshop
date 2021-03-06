<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Admin\GoodsAttr;
use App\Http\Model\Admin\GoodsType; 
use App\Http\Requests\GoodsAttrRequest;

class GoodsAttrController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search','');
        
        $data = GoodsAttr::where('attr_name','like','%'.$search.'%')->orderBy('id','desc')->paginate(7);
        //dd($data);
        
       return view('admin/goodsattr/index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = GoodsType::orderBy('id','asc')->get();
        //dd($res);
       return view('admin/goodsattr/add',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsAttrRequest $request)
    {
        /* $res = $request->all();
        dd($res);*/
        /*$res = $request->input('type_id');
        dd($res);*/
       $data = $request->except(['_token']);

       //dd($data);
       GoodsAttr::insert($data);
       
       
       return redirect('/admin/goodsattr');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $res = GoodsType::orderBy('id','asc')->get();
        $data = GoodsAttr::find($id);
       //dd($data);
       return view('admin/goodsattr/edit',['res'=>$res,'data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoodsAttrRequest $request, $id)
    {
        $data  = $request->except(['_token','_method']);
        //dd($data);
        GoodsAttr::where('id',$id)->update($data);
                //dump($res);
        

        return redirect('/admin/goodsattr');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = GoodsAttr::destroy([$id]);
        if($res){
            echo '<script>alert("删除成功");location.href="/admin/goodsattr"</script>';
        }
    }
}
