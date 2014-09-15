<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午5:08
 */

namespace sf_wx_questions;
include "db_helper.php";

class questions {

    public $today_questions_array = null;
    private $mysql_helper;

    function __construct($num)
    {
        $this->mysql_helper = new dbhelper();
        $this->Generate_Questions($num);
    }

    private function Generate_Questions($question_num){
        // insert assigned num questions in table
        // & get the results object
        $this->today_questions_array = $this->mysql_helper->GetTodayQuestions(); // return an array of class question
    }

//    function CheckAnswers($array_answers, $user_id){
//        // insert answers into db
//        // $this->$today_questions_sql_result;
//
//        return 0;// return result; correct answer count
//    }
}

?>