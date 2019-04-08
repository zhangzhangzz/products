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
        $(".addUnit").click(function(){
            var ublen = $(".ubBody").find(".ub").length;
            if(ublen ==3 ){
                layer.msg("最多支持3组规格");
                return false;
            }
<<<<<<< HEAD
            
            html=`<div class="ub" data-index=${uindex} >
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
        var index2 = 0;
        var index3 = 0;

        window.addUdata = function(x) {
            var uuid = $($($($(x).parent()).parent()).parent()).parent().data("index");
            var flag = $(x).prev().length;
            var dex = 0;
            if(uuid==1){
                index+=1;
                dex = index;
            }else if(uuid==2){
                index2+=1;
                dex = index2;
            }else if(uuid==3){
                index3+=1;
                dex = index3;
            }

            $(x).before(`<div class="addunBox" onmouseout="reHide(this);" onmouseover="reShow(this);">
                            <input type="text" name="unit" required lay-verify="required" placeholder="kg" 
                            autocomplete="off" class="layui-input inBox " onchange="changeUdata(this);" data-index=${dex} data-flag=${flag}>
                            <span class="reinput remove" onclick="remInput(this);">x</span>
                        </div>`);
=======
// ------------------------------------------------------------------------
            html+=`<div class="ub1 ub">
                                <div class="unitname">
                                    <label class="labelText">规格名：</label>
                                    <input type="text" name="unit" required lay-verify="required" placeholder="净含量" autocomplete="off" class="layui-input inBox">
                                </div>
                                <div class="unitdata">
                                    <div>
                                        <label class="labelText">规格值：</label>
                                        <div class="setUnitBox">
                                            <a class="addUdata" style="color:#38f;" onclick="addUdata()">添加规格值</a>
                                        </div>
                                        
                                    </div>
                                    
                                    <span class="reudata remove">x</span>
                                </div>
                            </div>`;
            $(".ubBody").html(html);

        });
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200

        window.addUdata = function() {
            // var inLen = $(".setUnitBox").find("input").length;
            // if(inLen==3){
            //     layer.msg("最多支持3组规格");
            //     return false;
            // }
            $(".addUdata").before(`<div class="addunBox" onmouseout="reHide();" mouseover="reShow();">
                                        <input type="text" name="unit" required lay-verify="required" placeholder="kg" autocomplete="off" class="layui-input inBox">
                                        <span class="reinput remove">x</span>
                                    </div>`);
        }

        $(".ub").mouseover(function(){
            $(this).find(".remove").css({display:"block"});
        });

        $(".ub").mouseout(function(){
            $(this).find(".remove").css({display:"none"});
        });

        window.reShow = function() {
            $(this).find(".remove").css({display:"block"});
        }

        window.reHide = function() {
            $(this).find(".remove").css({display:"block"});
        }

        $(".reudata").click(function(){
            $($(this).parent()).parent().remove();
        });

<<<<<<< HEAD
        window.changeUnit = function(x) {
            $($(x).parent()).next().find(".addUdata").css({display:"inline-block"});
        }

        function addTable(){

        }

        var arr = [];
        var aindex = 1;
        var harr1 = [];
        window.changeUdata = function(x) {
            //规格值序号，用来判断是否为第一个规格值
            var flag = $(x).data("flag");
            //规格值的text
            var text = $(x).val();
            //规格值整体div的对象
            var  unitdata = $($($($(x).parent()).parent()).parent()).parent();
            var bigMaMa = $(unitdata).parent()
            var bindex = bigMaMa.data("index");
            $(x).attr("class",`layui-input inBox cudata${bindex}`);
            //规格的text
            var thtext = $(unitdata).prev().find("input").val();
            //赋值给列
            var th = `<th>${thtext}</th>`;
            var tr = `<td class="addhere">
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
            var ublen = $(".ub1").length;
            //为第一个规格值时
            if(!flag){
                //第一个规格
                if(bindex==1){
                    $(".th-price").before(th);
                    var tr1 = `<tr class="hang">
                                    <td rowspan="1" class="ud${bindex}" >${text}</td>
                                `+tr;
                    $("tbody").append(tr1);
                //不是第一个规格 增加列
                }else{
                    if(ublen==1){
                        harr1.push(text);
                    }
                    arr.push(thtext);
                    $(".th-price").before(th);
                    $(`.ud${bindex-1}`).after(`<td rowspan="1" class="ud${bindex}">${text}</td>`);
                }
            //不是第一个规格值时 并且为第一个规格里的规格值    
            }else if(flag && bindex==1 ){
                //只有一种规格
                if(ublen==1){
                    var tr1 = `<tr class="hang">
                                    <td rowspan="1" class="ud${bindex}" >${text}</td>
                                `+tr;
                //有2-3种规格    
                }else if(ublen==2){
                    //--------------------
                    var td2='';
                    var len = harr1.length;
                    $.each(harr1, function(i,val){      
                        var tag = i==0?len:'';
                        //var cla = len-1==i ?'hang2':'hang';
                        var td = i==0?`<tr class="hang"><td rowspan="${tag}" class="ud${bindex}" >${text}</td>
                                <td rowspan="1" class="ud${bindex}" >${val}</td>`:`<tr class="hang"><td rowspan="1" class="ud${bindex}" >${val}</td>`;
                        td2+=td+tr;
                    });   

                    var tr1 = td2;
                }
                $("tbody").append(tr1);
            }else if(flag && bindex==2 ){
                var one = $(".ub").eq(0).find(".cudata1 ").length;
                
                var two = $(".ub").eq(1).find(".cudata2 ").length;
                console.log(one+"--one--"+two+"--two--");
                harr1.push(text);
                var td3 = ublen==2?`<td rowspan="1" class="ud${bindex}" >${text}</td>`:`<td rowspan="1" class="ud${bindex}" >${text}</td>
                                                                                        <td rowspan="1" class="ud${bindex}" >${arr[1]}</td>`
                var tr1 = `<tr class="hang">`+td3+tr;
                if(two-1==1){
                    $("tr[class=hang]:last").after(tr1);
                    $($(".hang").eq(0)).find("td").eq(0).attr("rowspan",2);
                }else{
                    //$("tr[class=hang2]:last").after(tr1);
                    for(var i=0;i<one;i++){
                        $(".hang").eq(two*i+1).after(tr1);
                        console.log((i+1)*two+"---------------------");
                        $($(".hang").eq(i)).find("td").eq(0).attr("rowspan",two);
                    }
                }
                //aindex+=1;

                //$(".hang").find("td").eq(0).attr("rowspan",aindex);
                console.log($($(".hang").eq(1)).find("td").eq(0));
                console.log($(".hang").find("td").eq(0));
            }
            $(".UD").css({display:"block"});
            bigMaMa.attr("class","ub ub1");
        }


=======
>>>>>>> 531bc972e24293fcf7bd32d688e55e81659f0200

    });
</script> 
@endsection