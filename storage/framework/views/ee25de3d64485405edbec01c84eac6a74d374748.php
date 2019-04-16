<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<style>
    .maxDiv{
        min-height: 100vh;
        width: 100%;
        position: relative;
    }
    .centerBox{
        background-color: #fff;
        width: 20%;
        margin: auto;
        position: absolute;
        top: 15%;
        text-align: center;
        padding: 20px;
        left: 0;
        right: 0;
    }

    .lgBox{
        width: 100%;
        margin: 20px auto;
        position: relative;
    }

    .warn{
        display: none;
        height: 25px;
        line-height: 25px;
        text-align: left;
        color: #F1403C;
        font-size: 12px;
    }

    .iBox{
        border-radius: 4px!important;
    }

    .login{
        width: 100%;
        height: 46px;
        font-size: 18px;
    }

    .remBox{
        overflow: hidden;
        height: 25px;
        margin: 20px 0;
    }
    .checkBox{
        width: 25px;
        height: 100%;
        float: left;
        border: 1px solid #ccc;
        margin-right: 10px;
        line-height: 25px;
        display: inline-block;
        border-radius: 50%;
        background-color: #fff;
    }

    .pl{
        float: left;
    }

    .pr{
        float: right;
    }

    .remBox > span{
        line-height: 25px;
        display: inline-block;
    }

    .code{
        width: 100%;
        margin: 20px 0;
        overflow: hidden;
        }
    .input-val{
        width: 100%;
        background: #ffffff;
        height: 45px;
        padding: 0 2%;
        border-radius: 5px;
        float: left;
        border: none;
        border: 1px solid rgba(0,0,0,.2);
        font-size: 1.0625rem;
    }
    #canvas{
        
        display: inline-block;
        border:1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .registered{
        display: inline-block;
        color: #31b0d5;
    }
    .Incode{
        overflow:hidden;
        display: inline-block;
        width: calc(100% - 110px);
    }



</style>
<body>
    <div class="maxDiv">
        
        <div class="centerBox">
            <div class="logo">
                <img src="" alt="">
            </div>

            <div class="input-group input-group-lg lgBox">
                <div class="warn">* 请输入用户名 </div>
                <input type="text" class="form-control iBox uname" placeholder="用户名" aria-describedby="sizing-addon1">
            </div>

            <div class="input-group input-group-lg lgBox">
                <div class="warn">* 请输入密码 </div>
                <input type="password" class="form-control iBox pwd" placeholder="密码" aria-describedby="sizing-addon1">
            </div>
            <div class="remBox">
                <div class="checkBox">
                    <i class="glyphicon glyphicon-ok" style="line-height:25px;top: 0;color: #fff; display: none;"></i>
                </div>
                <span class="pl" style="color:#555;">记住密码</span>
                <span class="pr" style="color:#31b0d5;padding-right: 3px;">忘记密码?</span>
            </div>

            <div class="code">
                <div class="Incode">
                    <input type="text" class="form-control iBox input-val" placeholder="请输入验证码" aria-describedby="sizing-addon1">
                </div>
                <div class="pr">
                    <canvas id="canvas" width="100" height="43"></canvas>
                    <div style="font-size:12px;color:#888; cursor: pointer;" onclick="draw(show_num);">看不清？换一张</div>
                </div>
            </div>

            <?php if(session('errors')): ?>
                <div class="errors">
                    <?php echo e(session('errors')); ?>

                    <br/>
                </div>
            <?php endif; ?>
            <button type="button" class="btn btn-info login " >登录</button>
            <div style="margin:20px 0;font-size: 12px;color: #888;">
                还没有平台账号？
                <div class="registered">去注册</div>
            </div>
            
        </div>
    </div>
    
</body>
<script>
    
    var show_num = [];
    draw(show_num);

    //--------随机验证码--------
    $(function(){
        $("#canvas").on('click',function(){
            draw(show_num);
        })
    })

    $("body").keydown(function() {
        if (event.keyCode == "13") {//keyCode=13是回车键
            $(".login").click();
        }
    });

    $(".checkBox").click(function(){
        var itag = $($(this).find("i"));
        var flag = itag.is(':visible');
        if(flag == true){
            itag.css("display","none");
            $(this).css({backgroundColor:"#fff",borderColor:"#ccc"});
            return;
        }else{
            itag.css("display","block");
            $(this).css({backgroundColor:"#31b0d5",borderColor:"#269abc"});
            return;
        }
    });

    $(".iBox").click(function(){
        $($(this).prev()).css({display:"none"});
    });

    $(".login").on('click',function(){
            var uname = $(".uname").val();
            var pwd = $(".pwd").val();
            if(uname==""){
                $($(".uname").prev()).css("display","block");
                return;
            }

            if(pwd==""){
                $($(".pwd").prev()).css("display","block");
                return;
            }

            var val = $(".input-val").val().toLowerCase();
            var num = show_num.join("");
            if(val==''){
                alert('请输入验证码！');
                return;
            }else if(val != num){
                alert('验证码错误！请重新输入！');
                $(".input-val").val('');
                draw(show_num);
                return;
            }else{
                window.location.href="<?php echo e(url('admin/login/doLogin')); ?>"+"?account=" + uname + "&" + "password=" + pwd;
            }
        })



    function draw(show_num) {
        var canvas_width=$('#canvas').width();
        var canvas_height=$('#canvas').height();
        var canvas = document.getElementById("canvas");//获取到canvas的对象，演员
        var context = canvas.getContext("2d");//获取到canvas画图的环境，演员表演的舞台
        canvas.width = canvas_width;
        canvas.height = canvas_height;
        var sCode = "A,B,C,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0";
        var aCode = sCode.split(",");
        var aLength = aCode.length;//获取到数组的长度
        
        for (var i = 0; i <= 3; i++) {
            var j = Math.floor(Math.random() * aLength);//获取到随机的索引值
            var deg = Math.random() * 30 * Math.PI / 180;//产生0~30之间的随机弧度
            var txt = aCode[j];//得到随机的一个内容
            show_num[i] = txt.toLowerCase();
            var x = 10 + i * 20;//文字在canvas上的x坐标
            var y = 20 + Math.random() * 8;//文字在canvas上的y坐标
            context.font = "bold 23px 微软雅黑";

            context.translate(x, y);
            context.rotate(deg);

            context.fillStyle = randomColor();
            context.fillText(txt, 0, 0);

            context.rotate(-deg);
            context.translate(-x, -y);
        }
        for (var i = 0; i <= 5; i++) { //验证码上显示线条
            context.strokeStyle = randomColor();
            context.beginPath();
            context.moveTo(Math.random() * canvas_width, Math.random() * canvas_height);
            context.lineTo(Math.random() * canvas_width, Math.random() * canvas_height);
            context.stroke();
        }
        for (var i = 0; i <= 30; i++) { //验证码上显示小点
            context.strokeStyle = randomColor();
            context.beginPath();
            var x = Math.random() * canvas_width;
            var y = Math.random() * canvas_height;
            context.moveTo(x, y);
            context.lineTo(x + 1, y + 1);
            context.stroke();
        }
    }

    function randomColor() {//得到随机的颜色值
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return "rgb(" + r + "," + g + "," + b + ")";
    }


    
</script>
</html>