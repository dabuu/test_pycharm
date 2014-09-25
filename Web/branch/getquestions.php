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

if(isset($_GET['aid']) && !empty($_GET['aid'])&& isset($_GET['uid']) && !empty($_GET['uid']))
{
    $response['data']['agent_wx_img'] = 'http://dabuu-dabu.stor.sinaapp.com/sf_share.jpg';

    require_once "db_helper.php";
    $mysql = new \sf_wx_questions\db_helper();

    require_once "./agent/dba_helper.php";
    $a_mysql = new dba_helper();
    $agent_id = $a_mysql->GetAgentDBID($_GET['aid']);

    if($agent_id  != -1)
    {

        $user_info = $mysql->QueryUserID($_GET['uid'],$agent_id);
        $response['status'] = true;
        $response['data']['user_id'] = $user_info['user_id'];
        $response['data']['focus'] = $user_info['focus'];

        if(!$mysql->HasAnswerQuestionToday($user_info['user_id'])) // 如果没答过题， question 内容为空
        {

            $response['data']['is_answered'] = false;
            $response['data']['questions'] = $mysql->GetTodayQuestions4Interface();

        }
        else{
            $response['data']['is_answered'] = true;
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