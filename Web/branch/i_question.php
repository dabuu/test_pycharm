<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-6
 * Time: 上午9:06
 */

namespace sf_wx_questions;


class i_question {
    public $question_info;

    function __construct($db_result_row, $is_explain=false)
    {
        $this->question_info = array();
        $this->question_info['id'] = $db_result_row['qt_id'];
        $this->question_info['label'] = $db_result_row['q_context'];
        $this->question_info['type'] = $db_result_row['q_type'];

        if($is_explain)
        {
            $this->question_info['explains'] = array();
            $temp_explain_array = explode("{#$}", $db_result_row['q_explain']);
            foreach ($temp_explain_array as $value) {
                $temp_explain = array();
                $temp_explain['label'] = $value;
                $this->question_info['explains'][] = $temp_explain ;
            }
        }
        else{
            $this->question_info['answers'] = array();
            $temp_options_array = explode("{#$}", $db_result_row['q_options']);
            $temp_answers_array = explode("{#$}", $db_result_row['q_answer_id']);
            for($i= 1; $i<=count($temp_options_array);$i++)
            {
                $temp_answer= array();
                $temp_answer['label'] = $temp_options_array[$i-1];
                if(in_array($i,$temp_answers_array))
                {
                    $temp_answer['is_answer'] = true;
                }
                $this->question_info['answers'][] =$temp_answer;
            }
        }

    }

}

?>