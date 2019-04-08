<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;">管理(默认展开)</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/admin/index">账号管理</a></dd>
                    <dd><a href="/admin/role/index">角色管理</a></dd>
                    <dd><a href="/admin/menu/index">菜单管理</a></dd>
                </dl>
            </li>
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
                    <dd><a href="/admin/goods/category_index">商品分类</a></dd>
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
                <a href="javascript:;">交易管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/business/index">订单管理</a></dd>
                    <dd><a href="/admin/business/send">发货管理</a></dd>
                    <dd><a href="/admin/business/assess">评价管理</a></dd>
                </dl>
            </li>

            
            <li class="layui-nav-item"><a href="">营销中心</a></li>
            <li class="layui-nav-item"><a href="/admin/after/index">售后</a></li>
        </ul>
    </div>
</div>
