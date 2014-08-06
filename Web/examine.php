<?php
    $page_title = "有奖问答";
    include "header.html";
?>

<?php
    /**
     * Created by PhpStorm.
     * User: dabuwang
     * Date: 14-8-4
     * Time: 下午5:00
     */
     if(!isset($_GET['uwid'])){
        exit;
     }
    include "user.php";
    include "questions.php";

    //$user_id = $_GET['uid'];
    $user = new \sf_wx_questions\user($_GET['uid']);
    if($user->HasAnswerQuestionToday())
    {
        // "You had answered the questions." goto : checkanswer page;
        exit;
    }

    $today_questions = new \sf_wx_questions\questions(5); //生成 5道题
    if(count($today_questions->today_questions_array))
    {

        foreach ($today_questions->today_questions_array as $question_item) {
//            $question_item
        }

    }
    else{
        echo "Sorry: no questions!";
    }

?>