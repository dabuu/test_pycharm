<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Reg</title>
    <style>
        .state1{
            color:#aaa;
        }
        .state2{
            color:#000;
        }
        .state3{
            color:red;
        }
        .state4{
            color:green;
        }
    </style>
    <script type="application/javascript" src="../jquery/jquery-1.11.1.min.js"></script>
    <script>
        $(function(){

            var ok1=false;
            var ok2=false;
            var ok3=false;
            var ok4=false;
            // 验证用户名
            $('input[name="username"]').focus(function(){
                $(this).next().text('用户名应该为3-20位之间').removeClass('state1').addClass('state2');
            }).blur(function(){
                if($(this).val().length >= 3 && $(this).val().length <=12 && $(this).val()!=''){
                    $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                    ok1=true;
                }else{
                    $(this).next().text('用户名应该为3-20位之间').removeClass('state1').addClass('state3');
                }

            });

            //验证密码
            $('input[name="password"]').focus(function(){
                $(this).next().text('密码应该为6-20位之间').removeClass('state1').addClass('state2');
            }).blur(function(){
                if($(this).val().length >= 6 && $(this).val().length <=20 && $(this).val()!=''){
                    $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                    ok2=true;
                }else{
                    $(this).next().text('密码应该为6-20位之间').removeClass('state1').addClass('state3');
                }

            });

            //验证确认密码
            $('input[name="repass"]').focus(function(){
                $(this).next().text('输入的确认密码要和上面的密码一致,规则也要相同').removeClass('state1').addClass('state2');
            }).blur(function(){
                if($(this).val().length >= 6 && $(this).val().length <=20 && $(this).val()!='' && $(this).val() == $('input[name="password"]').val()){
                    $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                    ok3=true;
                }else{
                    $(this).next().text('输入的确认密码要和上面的密码一致,规则也要相同').removeClass('state1').addClass('state3');
                }

            });

            //验证邮箱
            $('input[name="email"]').focus(function(){
                $(this).next().text('请输入正确的EMAIL格式').removeClass('state1').addClass('state2');
            }).blur(function(){
                if($(this).val().search(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/)==-1){
                    $(this).next().text('请输入正确的EMAIL格式').removeClass('state1').addClass('state3');
                }else{
                    $(this).next().text('输入成功').removeClass('state1').addClass('state4');
                    ok4=true;
                }

            });

            //提交按钮,所有验证通过方可提交

            $('#submit').click(function(){
                alert(ok1);
                alert(ok2);
                alert(ok3);
                alert(ok4);
                if(ok1 && ok2 && ok3 && ok4){
                    alert("go");
                    $('form').submit();
                }else{
                    return false;
                }
            });

        });
    </script>
</head>
<body>

<form action='do.php' method='post' >
    用 户 名:<input type="text" name="username">
    <span class='state1'>请输入用户名</span><br/><br/>
    密　　码:<input type="password" name="password">
    <span class='state1'>请输入密码</span><br/><br/>
    确认密码:<input type="password" name="repass">
    <span class='state1'>请输入确认密码</span><br/><br/>
    邮　　箱:<input type="text" name="email">
    <span class='state1'>请输入邮箱</span><br/><br/>
    <input type="button" id="submit" value="注册"/>

</form>
</body>