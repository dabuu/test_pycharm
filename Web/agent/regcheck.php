<?php

print_r($_POST);
echo "<br/>";
print_r($_FILES['wx_pic']);
exit;

/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-21
 * Time: 下午4:40
 */
//$response = array();
//$response['status'] = false;
//$response['content'] = "token出错，请退回去登录后继续填写!";
//$response['token'] = -1;
//echo json_encode($response);
//exit;
//
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

    echo json_encode($response);
    exit;
}
if(isset($_POST["nick"]))
{
    $user_name = trim($_POST['nick']);
    $pwd = trim($_POST['password']);
    $pwd_confirm = trim($_POST['password_confirm']);
    $response = array();
    $response['status'] = false;
////    $response['status'] = true;
////    $response['content'] ="登录成功";
//    $response['content'] = "用户名已被使用！";
////    $response['content'] = "密码不一致";
//    $response['token'] = "1qaz2wssx";
//    echo json_encode($response);
//    exit;
    if(!empty($user_name) && !empty($pwd)&& !empty($pwd_confirm))
    {
        if(strcmp($pwd,$pwd_confirm) == 0) // 比较 相等， 继续
        {
            $mysql = new dba_helper();
            if(!$mysql->GetDupAgentName($user_name))
            {
                $token = $mysql->InsertAgent($user_name,$pwd);
                if($token)
                {
                    $response['status'] = true;
                    $response['content'] = "登录成功";
                    $response['token'] = $token;
                }
            }
            else
            {
                $response['content'] = "用户名已被使用！";
            }
        }
        else
        {
            $response['content'] = "密码不一致";
        }
    }
    echo json_encode($response);
    exit;
}

if(isset($_POST['username']))
{
    $user_name = trim($_POST['username']);
    $pwd = trim($_POST['password']);
    $response = array();
    $response['status'] = false;
////    $response['content'] = "请输入正确的用户名密码！";
//    $response['status'] = true;
//    $response['content'] ="登录成功";
//
//    $response['token'] = "3qaz4wssx";
//    echo json_encode($response);
//    exit;

    //todo: 检查 是否 填写详细信息
    if(!empty($user_name ) && !empty($pwd ))
    {
        $mysql = new dba_helper();
        $token = $mysql->GetAgentToken($user_name, $pwd);
        //check user's valid
        if($token)
        {
            $response['status'] = true;
            $response['content'] = "登录成功";
            $response['token'] = $token;
        }
    }
    $response['content'] = "请输入正确的用户名密码";

    echo json_encode($response);
    exit;
}

?>