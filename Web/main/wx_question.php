<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-6
 * Time: 上午9:06
 */

namespace sf_wx_questions;


class wx_question {
    private $db_rst_row = null;
    public  $q_context, $q_answer, $q_type, $qt_id, $q_id , $q_options = array();
    function __construct($db_result_row)
    {
        $this->db_rst_row = $db_result_row;
        $this->qt_id = $this->db_rst_row['qt_id'];
        $this->q_context = $this->db_rst_row['q_context'];
        $this->q_type = $this->db_rst_row['q_type'];
//        $this->q_answer = $this->db_rst_row['q_answer_id'];
        $this->GetOptionsAndAnswers();
    }

    private function GetOptionsAndAnswers()
    {
        $this->q_options = explode("{#$}",$this->db_rst_row['q_options']);
        $this->Answer2Bin(explode("{#$}",$this->db_rst_row['q_answer_id']));
    }

    // 结果都是 -1
    private function Answer2Bin($array_answer_id)
    {
        $this->q_answer = "";
        if(count($array_answer_id)>0)
        {
            $this->q_answer = strval(intval($array_answer_id[0])-1);
            for($i=1;$i<count($array_answer_id);$i++)
            {
                $this->q_answer .="#".strval(intval($array_answer_id[$i])-1);
            }
        }
    }
    // 转换之后的结果都是 +1
    public static function Answer2Dec($answer_str)
    {

    }






}

?>