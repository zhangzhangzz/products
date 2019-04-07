<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
            <li class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;">管理(默认展开)</a>
                <dl class="layui-nav-child">
                    <dd><a href="/admin/admin_user/index">账号管理</a></dd>
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
                    <dd><a href="/admin/goods/classify">商品分类</a></dd>
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
        </ul>
    </div>
</div>
