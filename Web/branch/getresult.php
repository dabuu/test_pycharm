<?php
//$today_correct = 0;
//$rate = 0;
//$test_array = array();
//$test_array['user_id'] = 10101;
//$test_array['q_11'] = "1{#$}2_1";
//$test_array['q_2'] = "3_1";
//echo GetQuestionsAndResultsQuery4InsertDB($test_array,1);
//echo "<br/>".$today_correct;
//echo "<br/>".$rate;
//exit;

$response = array();
$today_correct = 0;
$rate = 0;

$response['status'] = false;
$response['data'] = array();
require_once "db_helper.php";
$mysql = new \sf_wx_questions\db_helper();

if(isset($_POST['user_id']) && !empty($_POST['user_id']))
{
    $user_db_id = $_POST['user_id'];
    //1. 查看 userid 有效性， 并获取 focus 状态
    $is_focus = $mysql->HasFocusOnSFWX($user_db_id );
    if($is_focus != -1)
    {
        $response['status'] = true;
        $response['data']['user_id'] = $user_db_id;
        $response['data']['focus'] = $is_focus;

        $agent_token = $mysql->GetAgentTokenByUserID($user_db_id);
        if($agent_token !=-1)
        {
            $response['data']['agent_wx_img'] = 'http://dabuu-dabu.stor.sinaapp.com/'.$agent_token.'.jpg';
            $insert_value = GetQuestionsAndResultsQuery4InsertDB($_POST, $user_db_id);
            if($mysql->InsertUserAnswers($insert_value) == 0) // 2. 插入答题结果
            {
                if($is_focus == 1)
                {
                    // 3. 返回json 数据
                    $response['data']['today'] = $today_correct;
                    $response['data']['total'] = $mysql->GetUserHistoryCorrectNum($user_db_id);
                    $response['data']['today_rate'] = $rate;
                    $response['data']['questions'] = $mysql->GetTodayQuestions4Interface(true);
                }
            }
        }
    }
}
elseif(isset($_GET['uid']) && !empty($_GET['uid']))
{

    $user_wx_id = $_GET['uid'];
    //1. 查看 userid 有效性， 并获取 focus 状态
    $user_info = $mysql->HasFocusOnSFByWXID($user_wx_id);
    $user_db_id = $user_info['user_id'];

    $response['data']['user_id'] = $user_db_id;
    $response['data']['focus'] = $user_info['focus'];

    $agent_token = $mysql->GetAgentTokenByUserID($user_db_id);
    if($agent_token !=-1)
    {
        $response['status'] = true;
        $response['data']['agent_wx_img'] = 'http://dabuu-dabu.stor.sinaapp.com/'.$agent_token.'.png';
        // 3. 返回json 数据
        $today_info = $mysql->GetUserTodayCorrectInfo($user_db_id);
        $response['data']['today'] = $today_info['today'];
        $response['data']['total'] = $mysql->GetUserHistoryCorrectNum($user_db_id);
        $response['data']['today_rate'] = $today_info['rate'];;
    }
}

echo json_encode($response);
exit;


function GetQuestionsAndResultsQuery4InsertDB($post_results, $user_db_id)
{
    global $today_correct, $rate;
    $question_rst = array();
    $tpl_value = "(%s,%s,'%s',%s, %s)";

    foreach ($post_results as $q_id =>$rst) {
        if($q_id == "user_id")
        {
            continue;
        }
        $temp_rst = explode("_", $rst,2);
        $today_correct += $temp_rst[1];
        $answer= $temp_rst[0];
        $is_correct = $temp_rst[1];
        $temp_question_info = explode("_", $q_id, 2);
        $temp_question_id = $temp_question_info[1];
        $question_rst[] = sprintf($tpl_value, $temp_question_id,$user_db_id,$answer,$is_correct, "%s");
    }

    switch ($today_correct)
    {
        case 0:
            $rate = 0;
            break;
        case 1:
            $rate = rand(27,32);
            break;
        case 2:
            $rate = rand(40,45);
            break;
        case 3:
            $rate = rand(60,65);
            break;
        case 4:
            $rate = rand(80,85);
            break;
        case 5:
            $rate = rand(90,95);
            break;
        default:
            $rate = 0;
    }

    foreach ($question_rst as $key=>$value) {
        $question_rst[$key] = sprintf($value,$rate);
    }
    return implode(",", $question_rst);
}

?>