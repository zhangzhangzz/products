<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <?php $li = 0; ?>
            @foreach(menu() as $v)
                <?php $li++; ?>
                @if($li != 1 && substr_count($v -> path, ",") == 1)
                    </li>
                @endif
                @if($li == 1 ||  substr_count($v -> path, ",") == 1)
                    <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                    <li class="layui-nav-item layui-nav-itemed">
                @endif

                @if(substr_count($v -> path, ",") == 1)
                    @if(in_array($v -> name, session("route")))
                        <a href="javascript:;">{{ $v -> name }}</a>
                    @endif
                @endif
                    @if(substr_count($v -> path, ",") == 2)
                        <dl class="layui-nav-child">
                            @if(in_array($v -> name, session("route")))
                                <dd><a href="{{ $v -> a }}">{{ $v -> name }}</a></dd>
                            @endif
                        </dl>
                    @endif
            @endforeach
            </li>
        </ul>
    </div>
</div>
