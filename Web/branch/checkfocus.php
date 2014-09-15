<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-13
 * Time: 上午10:13
 */
namespace sf_wx_questions;

if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
    require_once "db_helper.php";
    $mysql_helper = new \sf_wx_questions\db_helper();
    // get user focus on status, 1 is focus or 0 is NOT focus SF
    echo $mysql_helper->HasFocusOnSFWX($_POST['user_id']);
}
else
{
    echo -1;
}



?>