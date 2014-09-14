<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-13
 * Time: 上午10:13
 */
if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
    // get user focus on status, 1 is focus or 0 is NOT focus SF
    echo 1;
}
else
{
    echo -1;
}



?>