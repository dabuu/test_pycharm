<?php
    /**
     * Created by PhpStorm.
     * User: dabuwang
     * Date: 14-8-4
     * Time: 下午5:00
     */
     if(!isset($_GET['uid'])){
        exit();
     }
    include "user.php";
    include "questions.php";

    //$user_id = $_GET['uid'];
    $user = new \sf_wx_questions\user($_GET['uid']);
    if($user->HasAnswerQuestionToday())
    {
        // "You had answered the questions." goto : checkanswer page;
    }

    $today_question = new \sf_wx_questions\questions(5); //生成 5道题

    if( $today_question->today_questions_sql_result != null)
    {
        echo "here is 5 questions";
    }
    else{
        echo "Sorry: no questions!";
    }

?>