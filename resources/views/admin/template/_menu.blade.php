<?php
    $sql = "select * from action order by concat(path, id)";
    $list = DB::select($sql);
?>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            @foreach($list as $v)
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item layui-nav-itemed">
                @if(substr_count($v -> path, ",") == 1)
                    @if(in_array($v -> name, session("route")))
                        <a href="javascript:;">{{ $v -> name }}</a>
                    @endif
                @endif
                <dl class="layui-nav-child">
                    @if(substr_count($v -> path, ",") == 2)
                        @if(in_array($v -> name, session("route")))
                            <dd><a href="{{ $v -> a }}">{{ $v -> name }}</a></dd>
                        @endif
                    @endif
                </dl>
            </li>
<<<<<<< HEAD
            @endforeach
=======
            <li class="layui-nav-item">
                <a href="javascript:;">会员</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/user/index">会员列表</a></dd>
                    <dd><a href="/admin/user/add">会员添加</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">店铺管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/shop/index">审核列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;">商品</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/goods/index">商品列表</a></dd>
                    <dd><a href="/admin/category/index">商品分类</a></dd>
                    <dd><a href="/admin/goods/manage">商品管理</a></dd>
                    <dd><a href="/admin/goods/recycle ">回收站</a></dd>
                </dl>
            </li>

            <li class="layui-nav-item">
                <a href="javascript:;">设置</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/setting/index">平台提现设置</a></dd>
                </dl>
            </li>

            <li class="layui-nav-item">
                <a href="javascript:;">解决方案</a>
                <dl class="layui-nav-child">
                    <dd><a href="">移动模块</a></dd>
                    <dd><a href="">后台模版</a></dd>
                    <dd><a href="">电商平台</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="">产品</a></li>
            <li class="layui-nav-item"><a href="">大数据</a></li>
>>>>>>> 0ff3c02c2670c39a9679638cedd8f632f9ac1d42
        </ul>
    </div>
</div>
