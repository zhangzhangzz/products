<link rel="stylesheet" href="<?php echo e(asset('css/addgoods.css')); ?>">
<?php $__env->startSection('content'); ?>
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
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
                            </div>
                            <div class="pl">
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
                            </div>
                            <div class="pl">
                                <img src="<?php echo e(asset('image/eg.png')); ?>">
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
                        <div id="special_content">
                            <div class="layui-input-block general-kuang">
                                <div class="control-group">
                                    <div class="controls" style="padding: 10px;">
                                        <a id="add_lv11" class="btn btn-primary" type="button" style="color: #38f;">添加规格项</a>
                                    </div>
                                </div>
                                <div id="lv_table_con1" class="control-group" style="display: none; ">
                                    <label class="control-label">规格项目表</label>
                                    <div class="controls" style="">
                                        <div id="lv_table1" style="padding: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: none"  id="changeUdata">xx</div>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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

        var vals = '';
        var lv1HTML = '';
        lv1HTML += `<div class="control-group lv1" style="padding: 10px;">
                        <div class="controls cBody"  onmouseout="reHide(this);" onmouseover="reShow(this);">
                            <label class="labelText">规格名：</label>
                            <input type="text" name="lv1[]" class="lvv3"  placeholder="规格名称" onchange="showGdata(this)" style="margin:14px 0 14px 8px;"/>
                            <a class="btn btn-primary add_lv2" type="button" style="display:none;color: #38f;margin: 0 10px;">添加规格值</a>
                            <span class="reinput remove remove_lv1"  style="display: none;left:259px">x</span>
                        </div>
                        <div class="controls lv2s cBody" >
                            <label class="labelText lv2stext" style="float:none!important;display:none;">规格值：</label>
                            <div class="lv2sBody" style="display:inline-block"></div>
                        </div>
                    </div>`;

        window.reShow = function(x) {
            $(x).find(".remove").css({display:"block"});
        }

        window.reHide = function(x) {
            $(x).find(".remove").css({display:"none"});
        }

        window.showGdata = function(x) {
            $(x).next().css({display:"inline-block"});
        }
//           专用
        var flag=true;
        $('#add_lv11').on('click', function() {
            var last = $(this).parent().parent().siblings('.control-group.lv1:last');
            var length = $(".lv1").length;
            if(length>=3){
                alert("最多添加3组规格");
                return;
            }

            $('.lvv4').each(function(index, element) {
                if($(this).val()=="") {
                    flag=false;
                }else{
                    flag=true;
                }
            });

            if(!flag){
                alert("请先删除无参数的规格项！");
                return;
            }

            if (!last || last.length == 0) {
                $(this).parent().parent('.control-group').eq(0).after(lv1HTML);
            } else {
                last.after(lv1HTML);
            }
        });
        $("#special_content").on('click', '.remove_lv1', function() {
            $($(this).parent()).parent().remove();
            var lvv1 = $(".lv1");
            if (!lvv1 || lvv1.length == 0) {
                $('#lv_table_con1').hide();
                $('#lv_table1').html('');
            }
            $('#changeUdata').click();
        });
        $("#special_content").on('click', '.add_lv2', function() {
            var vals = $(this).siblings("input").val();
            var lv2HTML = '';
            lv2HTML += `<div class="addunBox">
                            <div style="position:relative;display:inline-block" onmouseout="reHide(this);" onmouseover="reShow(this);">
                                
                                <input type="text" name="' + vals + '[]" class="lvv4" placeholder="参数名称" style="margin:14px 0 14px 4px;" onchange="changexx(this);"/>
                                <span class="reinput remove remove_lv2"  style="display: none;">x</span>
                            </div>
                        </div>`;
            $(this).parents('.lv1').find('.lv2sBody').append(lv2HTML);
            $(this).parents('.lv1').find('.lv2stext').css({display:"inline"});
        });
        $("#special_content").on('click', '.remove_lv2', function() {
            var ab = $($(this).parent()).parent();
            var addunbox = $(ab).parent().find(".addunBox");
            var label = $(ab).parent().prev();
            console.log(label);
            ab.remove();
            console.log(addunbox.length+"-----------------");
            if(addunbox.length-1==0){
                console.log("here");
                label.css({display:"none"});
            }
            $('#changeUdata').click();
        });

        window.changexx = function(x) {
            $('#changeUdata').click();
        }

        $('#changeUdata').click(function() {
            var lv1Arr = $("#special_content").children().children(".lv1").children().children('input[class="lvv3"]');
            if (!lv1Arr || lv1Arr.length == 0) {
                $('#lv_table_con').hide();
                $('#lv_table').html('');
                return;
            }
            // for (var i = 0; i < lv1Arr.length; i++) {
            //     var lv2Arr = $(lv1Arr[i]).parents('.lv1').find('input[class="lvv4"]');
            //     if (!lv2Arr || lv2Arr.length == 0) {
            //         alert('请先删除无参数的规格项！');
            //         return;
            //     }
            // }

            var tableHTML = '';
            tableHTML += '<table class="table table-bordered table-sku-stock">';
            tableHTML += '	<thead>';
            tableHTML += '		<tr>';
            for (var i = 0; i < lv1Arr.length; i++) {
                tableHTML += '			<th width="50"><input value="' + $(lv1Arr[i]).val() + '"  readonly style="border:0;"></th>';
            }
            tableHTML +=`<th class="th-price">
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
            <tbody>`;

            var numsArr = new Array();
            var idxArr = new Array();
            for (var i = 0; i < lv1Arr.length; i++) {
                numsArr.push($(lv1Arr[i]).parents('.lv1').find('input[class="lvv4"]').length);
                idxArr[i] = 0;
            }

            var len = 1;
            var rowsArr = new Array();
            for (var i = 0; i < numsArr.length; i++) {
                len = len * numsArr[i];

                var tmpnum = 1;
                for (var j = numsArr.length - 1; j > i; j--) {
                    tmpnum = tmpnum * numsArr[j];
                }
                rowsArr.push(tmpnum);
            }

            for (var i = 0; i < len; i++) {
                tableHTML += '		<tr data-row="' + (i + 1) + '">';

                var name = '';
                for (var j = 0; j < lv1Arr.length; j++) {
                    var n = parseInt(i / rowsArr[j]);
                    if (j == 0) {} else if (j == lv1Arr.length - 1) {
                        n = idxArr[j];
                        if (idxArr[j] + 1 >= numsArr[j]) {
                            idxArr[j] = 0;
                        } else {
                            idxArr[j]++;
                        }
                    } else {
                        var m = parseInt(i / rowsArr[j]);
                        n = m % numsArr[j];
                    }

                    var text = $(lv1Arr[j]).parents('.lv1').find('input[class="lvv4"]').eq(n).val();
                    if (j != lv1Arr.length - 1) {
                        name += text + ',';
                    } else {
                        name += text;
                    }

                    if (i % rowsArr[j] == 0) {
                        tableHTML += '	<td width="50" rowspan="' + rowsArr[j] + '" data-rc="' + (i + 1) + '_' + (j + 1) + '"><input value="' + text + '"  readonly style="border:0;"></td>';
                    }
                }

                tableHTML +=`<td>
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
            }
            tableHTML += '	</tbody>';
            tableHTML += '</table>';

            $('#lv_table_con1').show();
            $('#lv_table1').html(tableHTML);
        });

       



    });
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.template.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>