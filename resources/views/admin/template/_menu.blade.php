<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <?php
                $menu = arr2(arr(menu()));
                $i = 0;
            ?>
            @foreach($menu as $v)
                <?php $i++; ?>
                @if($i == 1)
                <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                <li class="layui-nav-item layui-nav-itemed">
                @else
                <li class="layui-nav-item">
                @endif
                    @if(in_array($v['name'], session("route")))
                        <a href="javascript:;">{{ $v['name'] }}</a>
                    @endif
                    @if(!empty($v['child']))
                        <dl class="layui-nav-child">
                            @foreach($v['child'] as $e)
                                @if(in_array($e['name'], session("route")))
                                    <dd><a href="{{ $e['a'] }}">{{ $e['name'] }}</a></dd>
                                @endif
                            @endforeach
                        </dl>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
