@extends('layout.admin')
@section('title', '角色管理')
@section('url', 'http://www.ecshop.com/admin/role/index')
@section('title2', '修改角色')
@section('content')
<div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">修改角色</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="/admin/role/{{$data->id}}"  method="post" enctype="multipart/form-data">
                       {{ csrf_field() }}
                       {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">角色名称</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="" name="role_name" required="" type="text" value="{{$data->role_name}}">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                       
                            
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">确认修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection