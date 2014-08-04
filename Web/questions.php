<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午5:08
 */

namespace sf_wx_questions;
include "dbhelper.php";

class questions {

    function __construct($num)
    {
        $this->Generate_Questions($num);
    }

    public $today_questions_sql_result = null;

    private function Generate_Questions($question_num){
        // insert assigned num questions in table
        // & get the results object
        $this->$today_questions_sql_result = null;
    }

    function CheckAnswers($array_answers, $user_id){
        // insert answers into db
        // $this->$today_questions_sql_result;

        return 0;// return result; correct answer count
    }
} 