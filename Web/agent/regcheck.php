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
    // check token is valid;
    if(isset($_GET['token']) && !empty($token = $_GET['token']))
    {
        if(!empty($c_name = trim($_POST['name'])) &&!empty( $c_province = trim($_POST['province'])) &&!empty(trim($_POST['city'])) &&
            !empty(trim($_POST['phone'])) &&!empty(trim($_POST['charger'])) &&!empty(trim($_POST['wx_id'])) && !empty($_FILES['wx_pic']))
        {

            // step1: upload image and return NOT null path
            if(($file_path = db_helper::InsertPic2SaeStorage($token."png",$_FILES['wx_pic'])))
            {
                $mysql = new db_helper();
                $mysql ->InsertAgentDetails($token,$)
            }


        // insert pic firstly
        //then insert info
        }
    }

}
if(isset($_POST["register"]))
{
    if(!empty($user_name = trim($_POST['nick'])) && !empty($pwd = trim($_POST['password']))&& !empty($pwd_confirm = trim($_POST['password_confirm'])))
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
    if(!empty($user_name = trim($_POST['username'])) && !empty($pwd = trim($_POST['password'])))
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