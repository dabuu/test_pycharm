<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-21
 * Time: 下午4:40
 */

$_POST;
echo json_encode($_POST);
exit;


require_once "db_helper.php";

if(isset($_POST['details']))
{
    // check token is valid;
    if(isset($_GET['token']) && !empty($_GET['token']))
    {
        $token = $_GET['token'];
        $c_name = trim($_POST['name']);
        $c_province = trim($_POST['province']);
        $c_city = trim($_POST['city']);
        $phone = trim($_POST['phone']);
        $charger = trim($_POST['charger']);
        $wx_name = trim($_POST['wx_id']);

        if(!empty($c_name) &&!empty( $c_province) &&!empty($c_city) &&
            !empty($phone) &&!empty($charger) &&!empty($wx_name) && !empty($_FILES['wx_pic']))
        {

            // step1: upload image and return NOT null path
            $file_path = db_helper::InsertPic2SaeStorage($token."png",$_FILES['wx_pic']);
            if($file_path)
            {
                $mysql = new db_helper();
                // step2: update DB data;
                if($mysql ->InsertAgentDetails($token, $c_name,$c_province,$c_city, $phone, $charger, $wx_name,$file_path))
                {
                    echo "登录成功 跳转。。";
                    time(4);
                    header("Location: http://details?u=xxxx");
                    exit;
                }
            }
        }
        time(4);
        header("Location: http://home.php");
    }

}
if(isset($_POST["register"]))
{
    $user_name = trim($_POST['nick']);
    $pwd = trim($_POST['password']);
    $pwd_confirm = trim($_POST['password_confirm']);
    if(!empty($user_name) && !empty($pwd)&& !empty($pwd_confirm))
    {
        if(strcmp($pwd,$pwd_confirm) == 0) // 比较 相等， 继续
        {
            $mysql = new db_helper();
            if(!$mysql->GetDupAgentName($user_name))
            {
                $token = $mysql->InsertAgent($user_name,$pwd);
                if($token)
                {
                    echo "登录成功 跳转。。";
                    time(4);
                    header("Location: http://details?u=xxxx");
                    exit;
                }
            }
        }
//        else{
//            echo "密码 不一致";
//            time(4);
//            header("Location: http://home.php");
//        }
        time(4);
        header("Location: http://home.php");
    }
}

if(isset($_POST['signin']))
{
    $user_name = trim($_POST['username']);
    $pwd = trim($_POST['password']);
    if(!empty($user_name ) && !empty($pwd ))
    {
        $mysql = new db_helper();
        $token = $mysql->GetAgentToken($user_name, $pwd);
        //check user's valid
        if($token)
        {
            echo "登录成功 跳转。。";
            time(4);
            header("Location: http://xxxx?u=xxxx".$token);
            exit;
        }
//        else{
//            echo "用户名密码出错，请重新登录。。";
//            time(4);
//            header("Location: http://home.php");
//        }
    }
    time(4);
    header("Location: http://home.php");
}

?>