<!DOCTYPE html>
<html>
<head>
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css" />
    <script language="javascript" type="text/javascript" src="../jquery/jquery-1.11.1.min.js"></script>
    <script type="application/javascript">

        function switchBox(type){
            if(type=='reg'){
                $('#reg-box').animate({left:'9px'});
                $('#login-box').animate({left:'550px'})}
            else{
                $('#reg-box').animate({left:'550px'});
                $('#login-box').animate({left:'9px'})
            }
        };
        $(document).ready(function(){
            $('#login-link').click(function(){
                switchBox();
            });
            $('#reg-link').click(function(){
                switchBox('reg');
            });
        });

    </script>
</head>
<body>
    <header>
        <h1 class="logo">
            代理商注册页面
        </h1>
    </header>
    <div id="main">
        <div id="reg-box" style="left: 9px;">
            <form class="reg-bg" method="post" action="#" id="sf_form" autocomplete="off">
                <fieldset id="reg-field">
                    <ul>
                        <li>
                            <label for="nick">昵　　称：</label>
                            <input tabindex="4" type="text" name="nick" id="nick" class="signin-text">
                            <p class="errordata" style="display: none;">昵称长度在3-20个字符之间</p>
                        </li>
                        <li>
                            <label for="password">密　　码：</label>
                            <input tabindex="2" type="password" name="password" id="password" class="password signin-text" maxlength="30">
                            <p class="errordata" style="display: none;">最少6个字符</p>
                        </li>
                        <li>
                            <label for="password_confirm">确认密码：</label>
                            <input tabindex="3" type="password" name="password_confirm" id="password_confirm" class="signin-text" maxlength="30">
                            <p class="errordata" style="display: none;">最少6个字符</p>
                        </li>
                    </ul>
                </fieldset>
                <div id="create_account">
                    <button tabindex="7" id="create-btn" class="green-btn" type="submit"><span>注册</span></button>
                </div>
                <p id="have-id">已有管理帐号？<a id="login-link" href="#">点击登录</a></p>
            </form>
        </div>
        <div id="login-box" style="left: 550px;">
            <form id="signin-form" class="reg-bg" method="post" action="http://www.kmsocial.cn/p/login/" autocomplete="off">
                <ul id="signinform">
                    <!-- <li>
                        <label for="username">电子邮箱：</label><input tabindex="8" id="signin-email" name="username" value="" class="signin-text" type="email">
                        <p class="errordata" style="display: none;">请输入正确的电子邮箱</p>
                    </li>-->
                    <li>
                        <label for="nick">昵　　称：</label>
                        <input tabindex="8" type="text" name="username" id="signin-email" class="signin-text">
                        <p class="errordata" style="display: none;">昵称长度在3-20个字符之间</p>
                    </li>
                    <li>
                        <label for="password">密　　码：</label><input tabindex="9" id="signin-pw" name="password" class="signin-text" maxlength="30" type="password">
                        <p class="errordata" style="display: none;">密码输入错误</p>
                    </li>
                </ul>
                <button tabindex="11" title="点击登录" class="green-btn" id="signin-form-submit" type="submit">登录</button>
            </form>
            <p id="user-reg">还没有管理帐号？<a id="reg-link" href="#">点击注册</a></p>

        </div>
    </div>
</body>
</html>