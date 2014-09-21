<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-21
 * Time: 下午4:40
 */

require_once "db_helper.php";

if(isset($_POST['details']))
{
    if(isset($_GET['token']) && !empty($_GET['token']))
    {
        // check token is valid;
    }
    if(!empty(trim($_POST['name'])) &&!empty(trim($_POST['province'])) &&!empty(trim($_POST['city'])) &&
        !empty(trim($_POST['phone'])) &&!empty(trim($_POST['charger'])) &&!empty(trim($_POST['wx_id'])) && !empty(trim($_POST['wx_pic'])))
    {
        // insert pic firstly
        //then insert info
    }
}
if(isset($_POST["register"]))
{
    if(!empty($user_name = trim($_POST['nick'])) && !empty($pwd = trim($_POST['password']))&& !empty($pwd_confirm = trim($_POST['password_confirm'])))
    {
        if(strcmp($pwd,$pwd_confirm) == 0) // 比较 相等， 继续
        {
            $mysql = new db_helper();
            $mysql->InsertAgent()
        }


        //check user's valid
        if(true)
        {
            echo "登录成功 跳转。。";
            time(4);
            header("Location: http://details?u=xxxx");
            exit;
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
    if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password'])))
    {
        //check user's valid
        if(true)
        {
            echo "登录成功 跳转。。";
            time(4);
            header("Location: http://xxxx?u=xxxx");
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