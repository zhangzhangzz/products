@extends('admin.template.default')
<link rel="stylesheet" href="{{ asset('css/addgoods.css') }}">
@section('content')
    <div class="main">
        <div style="padding:30px;">
            <div class="titleBox">
                <div>编辑基本信息</div>
            </div>

            <div style="padding:0 30px;">
                <form class="layui-form form" action="">
                    <div class="basicBox">基本信息</div>
                    <div class="layui-form-item">
                        <div class="warn">*</div>
                        <label class="layui-form-label" style="text-align:left">商品名称：</label>
                        <div class="layui-input-inline">
                        <input type="text" name="goodsname" required lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">最多30个字</div>
                    </div>
                    <div class="goodsImg">
                        <div class="warn">*</div>
                        <label>商品展示图</label>
                        <div  class="imgBox">
                            <div class="pl">
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="pl">
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="pl">
                                <img src="{{ asset('image/eg.png') }}">
                            </div>
                            <div class="stext">建议尺寸：800 * 800像素，点击图片可设置为商品封面，最多上传10张</div>
                        </div>
                    </div>


                    <div class="layui-form-item">
                        <div class="warn">*</div>
                        <label class="layui-form-label" style="text-align:left">商品类目</label>
                        <div class="layui-input-block">
                        <select name="city" lay-verify="required">
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                        </select>
                        <select name="city" lay-verify="required">
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                        </select>
                        </div>
                    </div>

                    <div>
                        <label>主图视频：</label>
                        <button type="button" class="layui-btn" id="test5"><i class="layui-icon"></i>上传视频</button>
                    </div>

                    <div class="basicBox">价格库存</div>

                    <div>
                        <div class="warn">*</div>
                        <label>商品规格</label>
                        <div class="unitBox">
                            <div class="ubBody">

                            </div>
                            
                            <div class="addBtn">
                                <button class="layui-btn layui-btn-primary addUnit" type="button">添加规格项目</button>
                            </div>
                        </div>
                    </div>

                    <div class="UD">
                        <label>规格明细</label>
                        <div class="undetail">
                            <table class="table-sku-stock">
                                <thead>
                                    <tr>
                                        <!--th>颜色</th-->
                                        <th class="th-price">
                                            <em class="zent-form__required">*</em>
                                            <!-- react-text: 687 -->价格（元）<!-- /react-text -->
                                        </th>
                                        <th class="th-stock">
                                            <em class="zent-form__required">*</em><!-- react-text: 690 -->库存<!-- /react-text -->
                                            <div class="zent-popover-wrapper zent-pop-wrapper" style="display: inline-block;">
                                                <span class="help-circle">
                                                    <i class="zenticon zenticon-help-circle"></i>
                                                </span><!-- react-empty: 694 -->
                                            </div>
                                        </th>
                                        <th class="th-code"><!-- react-text: 696 -->规格编码<!-- /react-text -->
                                            <div class="zent-popover-wrapper zent-pop-wrapper" style="display: inline-block;">
                                                <span class="help-circle">
                                                    <i class="zenticon zenticon-help-circle"></i>
                                                </span><!-- react-empty: 700 -->
                                            </div>
                                        </th>
                                        <th class="text-cost-price"><!-- react-text: 702 -->成本价<!-- /react-text -->
                                            <div class="zent-popover-wrapper zent-pop-wrapper" style="display: inline-block;">
                                                <span class="help-circle">
                                                    <i class="zenticon zenticon-help-circle"></i>
                                                </span><!-- react-empty: 706 -->
                                            </div>
                                        </th>
                                        <th class="text-right">销量</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                   
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" >立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> 

@endsection

@section('js')
<script>
    layui.use(['form','upload'], function(){
        var form = layui.form
        ,upload = layui.upload
            ,$  = layui.$;

        var uploadInst =  upload.render({
                elem: '#test5'
                ,url: '/upload/'
                ,accept: 'video' //视频
                ,done: function(res){
                console.log(res)
                }
            });
        
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });

        var html = "";
        var uindex = 0;
        $(".addUnit").click(function(){
            uindex+=1;
            var ublen = $(".ubBody").find(".ub").length;
            if(ublen ==3 ){
                layer.msg("最多支持3组规格");
                return false;
            }
            
            html=`<div class="ub1 ub" data-index=${uindex} >
                    <div class="unitname">
                        <label class="labelText">规格名：</label>
                        <input type="text" name="unit" required lay-verify="required" placeholder="净含量" 
                        autocomplete="off" class="layui-input inBox" onchange="changeUnit(this)" >
                    </div>
                    <div class="unitdata">
                        <div>
                            <label class="labelText">规格值：</label>
                            <div class="setUnitBox" >
                                <a class="addUdata" onclick="addUdata(this)">添加规格值</a>
                            </div>
                            
                        </div>
                        
                        <span class="reudata remove">x</span>
                    </div>
                </div>`;
            $(".ubBody").append(html);

        });
        var index=0;

        window.addUdata = function(x) {
            var uuid = $($($($(x).parent()).parent()).parent()).parent().data("index");
            var flag = $(x).prev().length;
            index+=1;
            $(x).before(`<div class="addunBox" onmouseout="reHide(this);" onmouseover="reShow(this);">
                            <input type="text" name="unit" required lay-verify="required" placeholder="kg" 
                            autocomplete="off" class="layui-input inBox cudata${uuid}" onchange="changeUdata(this);" data-index=${index} data-flag=${flag}>
                            <span class="reinput remove" onclick="remInput(this);">x</span>
                        </div>`);

        }

        $(".ub").mouseover(function(){
            $(this).find(".remove").css({display:"block"});
        });

        $(".ub").mouseout(function(){
            $(this).find(".remove").css({display:"none"});
        });

        window.reShow = function(x) {
            $(x).find(".remove").css({display:"block"});
        }

        window.reHide = function(x) {
            $(x).find(".remove").css({display:"none"});
        }

        window.remInput = function(x) {
            $(x).parent().remove();
        }

        $(".reudata").click(function(){
            $($(this).parent()).parent().remove();
        });

        window.changeUnit = function(x) {
            $($(x).parent()).next().find(".addUdata").css({display:"inline-block"});
        }

        function addTable(){

        }

        window.changeUdata = function(x) {
            var id = $(x).data("index");
            var  unitdata = $($($($(x).parent()).parent()).parent()).parent();
            var uparent = $(unitdata).parent();
            var uid = $(uparent).data("index");
            var text = $(x).val();
            var flag = $(x).data("flag");
            console.log("flag--"+flag);

            var thtext = $(unitdata).prev().find("input").val();
            var th = `<th>${thtext}</th>`;

            //只有一种规格
            if(id==1 && uid==1){
                console.log("只有一种规格");
                $(".th-price").before(th);
                var tr = `<tr class="hang">
                            <td rowspan="1" class="up${uid}" >${text}</td>
                            <td class="addhere${uid}">
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="price" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="stock_num" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-input-wrapper input-mini2">
                                        <input type="text" class="zent-input" name="code" autocomplete="off" value="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="cost_price" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>0</td>
                        </tr>`;
            }else if(uid!=1 && uid-1!=0){
                console.log("添加列");
                $(".th-price").before(th);
                console.log("here");
                $(`.up${uid-1}`).after(`<th class="up${uid}">${text}</th>`);                
            }else if(id!=1 && uid==1){
                console.log("添加行");
                var lie2 = $(".cudata2").val();
                var lie3 = $(".cudata3").val();
                var langlen = $(".hang").length;
                var html = ``;
                if(langlen==2){
                    $(`.up${langlen-1}`).after(`<td rowspan="1" class="up${uid}" >${lie2}</td>`);
                }else if(langlen==3){
                    $(`.up${langlen-1}`).after(`<td rowspan="1" class="up${uid}" >${lie3}</td>`);
                }
                var tr = `<tr class="hang firTR${uid}">
                            <td rowspan="1" class="up${uid}" >${text}</td>
                            <td class="addhere${uid}">
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="price" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="stock_num" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-input-wrapper input-mini2">
                                        <input type="text" class="zent-input" name="code" autocomplete="off" value="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="widget-form__group-row">
                                    <div class="zent-number-input-wrapper input-mini">
                                        <div class="zent-input-wrapper input-mini">
                                            <input type="text" class="zent-input" name="cost_price" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>0</td>
                        </tr>`;

            }else if(uid!=1 && uid-1!=0){
                console.log("不知道");
                if(uid==2){

                }
                console.log("---===");
                
            }
                $(".UD").css({display:"block"});
                $("tbody").append(tr);
            
        }



    });
</script> 
@endsection