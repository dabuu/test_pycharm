<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-7
 * Time: 下午4:15
 */
$page_title = "问答结果";
include "header.html";

if(!isset($_POST['answers']) || empty($_POST['answers']))
{
    echo "欢迎使用";
    exit;
}



//$answers_array = array();
$user_id = 0;

function HandleAnswers()
{
    //answers=11*4-1_5-1_
    $temp_user_id = explode("*", $_POST['answers'],2);
//    $GLOBALS['user_id'] = $temp_user_id[0];
    $user_db_id = $temp_user_id[0];
    $insert_answers_array = array();
//    $insert_answers_str = "";

    $temp_array = explode("_", $temp_user_id[1], -1);
    $temp_total_answer_count = count($temp_array);
    foreach($temp_array as $correct_answer)
    {
        $correct = explode("-", $correct_answer, 2);
//        $GLOBALS['answers_array'][$correct[0]] = $correct[1];
        $user_answer_id = $_POST["$correct[0]"];
        if($user_answer_id !=  $correct[1])
        {
            $temp_total_answer_count --;
        }

        // handle insert answers string : ( %d, %d,%d)  == ( %d=qt_id, %d=user_id,%d=answer_id),
        $insert_answers_array[] = sprintf("( %d, %d,%d)",$correct[0],$user_db_id, $user_answer_id);

    }
    $insert_answers_str = implode(",", $insert_answers_array);
    echo sprintf("你一共回答对了 %d 道题!", $temp_total_answer_count);
    echo "<br/>".$insert_answers_str;
}

HandleAnswers();

?>

</html>