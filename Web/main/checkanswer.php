<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-20
 * Time: 上午10:37
 */



if(!isset($_POST['user_id']) || empty($_POST['user_id']))
{
    echo "欢迎使用";
    exit;
}
// handle post values;
$questions_count = 2;

if(count($_POST) > $questions_count)
{
    $answer_array = array_slice($_POST,0,$questions_count);
    $user_id = $_POST['user_id'];
    update_user_2_db();
}
else
{
    echo "欢迎使用";
    exit;
}


// update user's answers
function update_user_2_db()
{
    $wx_usr = new \sf_wx_questions\wx_user($GLOBALS["user_id"]);
    $temp_array = $wx_usr->UpdateAnswers2DB($GLOBALS["answer_array"]);
    print_r($temp_array);
//    echo json_encode($temp_array);

//    echo json_encode($wx_usr->UpdateAnswers2DB($GLOBALS["answer_array"])); //return array;
}




//
//foreach ($_POST as $key => $value) {
//    echo "<br/>".$key."=>".$value;
//}
//
//print_r($_POST);
//echo "<br/>";
//print_r(array_slice($_POST,0,2));
//echo "<br/>";
//foreach (array_keys(array_slice($_POST,0,2)) as $key) {
//    echo "<br/>".$key;
//}
//
//
//function check_answers()
//{
//
//    return 1; //返回 一个数组： 正确的个数 + 每道题的解释，
//}


?>