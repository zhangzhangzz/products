<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 10:28
 */

@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/roleedit.css') }}">
    @section('content')
    <div class="main">
        <div style="padding:30px;">

            <form id="formmy" class="layui-form formBox" action="{{url('admin/role/insert')}}" method="post">
                {{ csrf_field()  }}
                <div class="layui-form-item">
                    <label class="layui-form-label">角色名称：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="name" required lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">角色描述：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="descript" required lay-verify="required" placeholder="请输入描述" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">上级名称：</label>
                    <div class="layui-input-inline">
                    <input type="text" name="boss" required lay-verify="required" placeholder="请输入上级名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">状&emsp;&emsp;态：</label>
                    <div class="layui-input-block">
                    <select name="state" lay-verify="required">
                        <option value=""></option>
                        <option value="1">启用</option>
                        <option value="0">禁用</option>
                    </select>
                    </div>
                </div>

                <div style="color:#555;padding: 15px;"><h2>权限设置</h2></div>

                <div class="quanxian">
                    <div class="tables">
@foreach ($list as $v)
                        <div class="list">
@if (substr_count($v -> path, ",") == 1)
                            <p class="title">
                                <input type="checkbox" value="{{ $v -> name }}" data-id="12" lay-skin="primary" title="{{ $v -> name }}" name="" lay-filter="allChoose"
                                    class="allChoose">
                            </p>
@endif
                            <div class="ultable">
                                <ul>
                                    <li>
@if (substr_count($v -> path, ",") == 2)
                                        <input type="checkbox" value="{{ $v -> name }}" data-id="12" lay-skin="primary" title="{{ $v -> name }}" name="menu_role_id[]" lay-filter="choose"
                                            class="aaa">
@endif
                                        <div class="list-three">
                                            <ul>
@if (substr_count($v -> path, ",") == 3)
                                                <li>
                                                    <input type="checkbox" value="{{ $v -> name }}" data-id="12" lay-skin="primary" title="{{ $v -> name }}" name="menu_role_id[]" lay-filter="three-choose">
                                                </li>
@endif
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
@endforeach
                    </div>
		        </div>

                <div class="layui-form-item btnBox">
                    <div class="layui-input-block" style="margin: 0;">
                    <button class="layui-btn pl" lay-submit lay-filter="formDemo" style="margin-left:130px;">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>



        </div>









@endsection

@section('js')
<script>

        layui.use('form', function(){
    var form = layui.form;

    //全选选单选      ----------------------------------------
    form.on('checkbox(allChoose)', function(data) {

        var child = $(data.elem).parents('.list').children('.ultable').find(
                'ul li input[type="checkbox"]:not([name="show"])');

        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        form.render('checkbox');
    });


    //全部选中来确定全选按钮是否选中
    form.on('checkbox(choose)', function(data) {
        var three_child = $(data.elem).siblings().find(
                'ul li input[type="checkbox"]:not([name="show"])');
        three_child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        var child = $(data.elem).parents('.list').children('.ultable').find(
                'ul li input[type="checkbox"]:not([name="show"])');
        var childChecked = $(data.elem).parents('.list').children('.ultable').find(
                'ul li input[type="checkbox"]:not([name="show"]):checked')
                if (childChecked.length == child.length) {
                    $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = true;
                }else if(childChecked.length==0){
                    $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = false;
                }
                else {
                    $(data.elem).parents('.list').children('.title').find(' input.allChoose').get(0).checked = true;
                }
                form.render('checkbox');
                });

    form.on('checkbox(three-choose)', function(data) {
        var child = $(data.elem).parents('li').find(
                'input[type="checkbox"]:not([name="show"])');
        var childChecked = $(data.elem).parents('li').find(
                'ul li input[type="checkbox"]:not([name="show"]):checked')
                    if (childChecked.length == child.length-1) {
                        $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;
                    } else if(childChecked.length==0){
                        $(data.elem).parents('li').find(' input.aaa').get(0).checked = false;

                    }
                    else {
                        $(data.elem).parents('li').find(' input.aaa').get(0).checked = true;

                    }
                        form.render('checkbox');
                });







    //监听提交
    form.on('submit(formDemo)', function(data){
//            layer.msg(JSON.stringify(data.field));
//            return false;
        $("#formmy").submit();
    });
});





    </script>
@endsection
