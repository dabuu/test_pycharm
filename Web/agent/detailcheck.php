<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>首页</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css" />
    <script language="javascript" type="text/javascript" src="../jquery/jquery-1.11.1.min.js"></script>

<?php
require_once "dba_helper.php";

if(isset($_POST['name']))
{
    $response = array();
    $response['status'] = false;

    // check token is valid;
    if(isset($_POST['token']) && !empty($_POST['token']))
    {
        $token = $_POST['token'];
        $response['token'] = $token ;

        $c_name = trim($_POST['name']);
        $c_province = trim($_POST['province']);
        $c_city = trim($_POST['city']);
        $phone = trim($_POST['phone']);
        $charger = trim($_POST['charger']);
        $wx_name = trim($_POST['wx_id']);
        //todo: check $token is valid or not
        $mysql = new dba_helper();
        if($mysql->GetAgentDBID($token) != -1)
        {
            if(!empty($c_name) && !strcmp($c_province,"省份") && !strcmp($c_city,"地级市") &&
                !empty($phone) &&!empty($charger) &&!empty($wx_name) && !empty($_FILES['wx_pic']))
            {
                // step1: upload image and return NOT null path
                $file_path = dba_helper::InsertPic2SaeStorage($token."png",$_FILES['wx_pic']);
                if($file_path)
                {
                    // step2: update DB data;
                    if($mysql ->InsertAgentDetails($token, $c_name,$c_province,$c_city, $phone, $charger, $wx_name,$file_path))
                    {
                        $response['content'] = "保存完成!";
                        $response['status'] = true;
                    }
                    else
                    {
                        $response['content'] = "保存数据出错，请重新提交!";
                    }
                }
                else{
                    $response['content'] = "保存图片出错，请重新提交!";
                }
            }
            else
            {
                $response['content'] = "请填写完整信息!".$c_name.$c_province.$c_city.$phone.$charger.$wx_name.$_FILES['wx_pic']['name'];
            }
        }
        else
        {
            $response['content'] = "token出错，请退回去登录后继续填写!";
            $response['token'] = -1;
        }
    }
    else{
        $response['content'] = "token出错，请退回去登录后继续填写!";
        $response['token'] = -1;
    }
}

?>
</head>
<body>
<script type="application/javascript">
    var time = 3;
    var set_time = "";
    function NavPage(page)
    {
        var text = time + "秒后自动跳转";
        time--;
        $("#nav").html(","+text);
        if(time == 0)
        {
           // window.location.href=page;
            clearInterval(set_time);
        }
    }

    $(document).ready(function(){
        $("#hide_value").hide();
        $("#hide_token").hide();

        if( $("#hide_token").val() == '-1')
        {
            set_time = setInterval(function(){
                NavPage("home.html");
            }, 900);
        }
        else
        {
            if($("#hide_value").val() == "true")
            {
                set_time = setInterval(function(){
                    NavPage("d1setting.php?token="+$("#hide_token").val());
                }, 900);
            }
            else{
                set_time = setInterval(function(){
                    NavPage("details.html?token="+$("#hide_token").val());
                }, 900);
            }
        }

    });
</script>
<div id="result">
    <?php
    echo $response['content'];
    ?><span id="nav"></span>
</div>
<div id="hide_value">
    <?php
        echo $response['status'];
    ?>
</div>
<div id="hide_token">
    <?php
    echo $response['token'];
    ?>
</div>
</body>
</html>
