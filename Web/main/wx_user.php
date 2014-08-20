<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午3:32
 */
namespace sf_wx_questions;
include "db_helper.php";

class wx_user {
    private $wx_user_id, $mysql_helper;
    /*
     * @var int
     */
    public  $user_db_id;
    function __construct($wx_user_id)
    {
        $this->mysql_helper = new db_helper();
        $this->user_db_id = $this->mysql_helper->QueryUserID($wx_user_id);
        $this->wx_user_id = $wx_user_id;
    }


    function HasAnswerQuestionToday()
    {
        // query in DB, whether the user had answered the questions
        return $this->mysql_helper->HasAnswerQuestionToday($this->user_db_id);
    }

    function UpdateAnswers2DB($answer_array)
    {
        $array_qt_ids = array_keys($answer_array);
        $array_answer_ids = array_values($answer_array);
        if(count($array_answer_ids)>0)
        {
            $update_query = "($array_qt_ids[0],$this->wx_user_id , $array_answer_ids[0])";
            for($i=1; $i<count($array_answer_ids); $i++)
            {
                $update_query .= ",($array_qt_ids[$i],$this->wx_user_id , $array_answer_ids[$i])";
            }

            $this->mysql_helper->InsertUserAnswers($update_query);
        }
        else
        {
            return null;
        }


        return true;
    }



}


?>