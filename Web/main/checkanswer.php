<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-20
 * Time: 上午10:37
 */

//print_r($_POST);
//
//echo"<br/>";
//echo $_POST[1];
////print_r(array_slice(array_keys($_POST),0, -1));
//exit;
//echo json_encode(array_slice($_POST,0, -1));
//
//exit;

//{"A":"2","23":["2","3"],"user_id":"user_db_id"}
if(!isset($_POST['info']) || empty($_POST['info']))
{
    echo "欢迎使用SF问答!";
    exit;
}

// initialize mysql
//$mysql_helper = new \sf_wx_questions\db_helper(); //comment back
$qt_id_array = array_slice(array_keys($_POST),0, -1);

// user info
$user_id = $_POST['info'];

// answers info: qt_id, answer_value, user_id
$insert_user_answers_string = ""; // query = insert user info into DB
$insert_value_template = "( %s, %s, %s)";
$user_answers_array = array();
for($i=0; $i< count($qt_id_array); $i++)
{
    // >> array_keys($_POST)[$i] // qt_id   >>  $_POST[$i] //user_answer >>  (`f_qt_id` ,`f_user_id` ,`rst_value`)

    if(is_array($_POST[$qt_id_array[$i]]))
    {
        $insert_user_answers_string .=sprintf($insert_value_template,strval($qt_id_array[$i]), $user_id, implode("{#$}", $_POST[$qt_id_array[$i]]));
        $user_answers_array[$qt_id_array[$i]] = implode("#", $_POST[$qt_id_array[$i]]);
    }
    else
    {
        $insert_user_answers_string .=sprintf($insert_value_template,strval($qt_id_array[$i]), $user_id, $_POST[$qt_id_array[$i]]);
        $user_answers_array[$qt_id_array[$i]] = $_POST[$qt_id_array[$i]];
    }

    if($i != count($qt_id_array)-1)
    {
        $insert_user_answers_string .= ",";
    }
}

if($insert_user_answers_string != "")
{
//    echo "<br/>".$insert_user_answers_string;
    $mysql_helper->InsertUserAnswers(rtrim($insert_user_answers_string, ","));  //comment back
}

// qt_info
//$qt_id_array = array_slice(array_keys($_POST),0, -1);
$qt_id_array_string .= sprintf("(%s)", implode(",", $qt_id_array));//$qt_id_array);
$questions_info_array = $mysql_helper->SelectQuestionExplainByIDs($qt_id_array_string);  //comment back

echo json_encode($questions_info_array);

// compare results: todo : shown or not
//$total_questions_count = count($user_answers_array);
//if($total_questions_count  == count($questions_info_array))
//{
//    foreach ($user_answers_array as $key => $value) {
//        if($value != $questions_info_array[$key]['answerNum'])
//        {
//            $total_questions_count--;
//        }
//    }
//}


?>