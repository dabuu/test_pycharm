<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-6
 * Time: 上午9:06
 */

namespace sf_wx_questions;


class question {
    private $db_rst_row = null;
    public  $q_context, $q_answer, $q_type, $qt_id, $q_id ,$q_explain, $q_options = array();
    function __construct($db_result_row)
    {
        $this->db_rst_row = $db_result_row;
        $this->qt_id = $this->db_rst_row['qt_id'];
        $this->q_context = $this->db_rst_row['q_context'];
        $this->q_answer = $this->db_rst_row['q_answer_id'];
        $this->q_type = $this->db_rst_row['q_type'];
        $this->q_explain = $this->db_rst_row['q_explain'];
        $this->GetOptionsFromStyle();
    }

    private function GetOptionsFromStyle()
    {
        $this->q_options = explode("{#$}",$this->db_rst_row['q_options']);
    }


}

?>