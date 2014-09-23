<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-23
 * Time: 上午10:51
 */

//require_once "db_helper.php";


$response = array();
$response['status'] = false;
$response['data'] = array();

if(isset($_GET['token']) && !empty($_GET['token']))
{
    require_once "db_helper.php";
    $mysql = new \sf_wx_questions\db_helper();


    $user_db_id = $mysql->GetUserDBID($_GET['token']);
    if($user_db_id != -1)
    {
        $response['status'] = true;
        $response['data']['user_id'] = $user_db_id;
        if(!$mysql->HasAnswerQuestionToday($user_db_id)) // 如果没答过题， question 内容为空
        {

        }
    }
}
echo json_encode($response);
exit;

$response = array();
$response['status'] = true;
$response['data']['user_id'] = 111;

$question = array();
$question['id'] = 11;
$question['label'] = "这里是22题干这里是22题干这里是22题干这里是22题干这里是22题干";
$question['answers'];
$answer1 = array();
$answer1['label'] = "许久了";
$answer2 = array();
$answer2['label'] = "太好了";
$answer2['is_answer'] = true;
$question['answers'][] = $answer1;
$question['answers'][] = $answer2;

$response['data']['questions'][] = $question;

echo json_encode($response);



?>