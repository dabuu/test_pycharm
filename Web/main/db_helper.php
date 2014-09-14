<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午4:46
 */

namespace sf_wx_questions;

define("HOST", SAE_MYSQL_HOST_M);
define("USER", SAE_MYSQL_USER);
define("PWD", SAE_MYSQL_PASS);
define("DB", SAE_MYSQL_DB);
define("PORT", SAE_MYSQL_PORT);

define("LatestID","SELECT @@IDENTITY ;");
/*
 *  User Operation in DB
 */
define("UserDBIdByWXId","SELECT `usr_id` FROM `app_dabuu`.`t_user` WHERE `usr_wx_id` = '%s'");
define("InsertUserWXId","INSERT INTO `app_dabuu`.`t_user` (`usr_wx_id`, `user_wx_sha_id`) VALUES ('%s', '%s');");
define("HasAnswerQuestionsTodayByUserID","SELECT count(*) FROM `t_results`WHERE DATE(`answer_time`) = DATE(NOW()) AND `f_user_id` = %d;");

/*
 *  Questions Operation in DB
 */
define("GetQuestionsRandomlyAsNum", "SELECT * FROM `app_dabuu`.`t_questions` LIMIT 0,2"); // todo: get question randomly
define("GetTodayQuestionsDateTime","SELECT `t_questions_today`.`qt_id`,`t_questions`.*  FROM `t_questions_today` LEFT JOIN `t_questions` ON `t_questions`.`q_id` = `t_questions_today`.`f_question_id`
WHERE DATE(`t_questions_today`.`qt_date`) = DATE(now()) ");
define("GenerateTodayQuestions_TPL","INSERT INTO `app_dabuu`.`t_questions_today` (`f_question_id`) VALUES %s;"); // here %s could be "(2),(3),(4)"
define("InsertUserAnswer","INSERT INTO `app_dabuu`.`t_results` (`f_qt_id` ,`f_user_id` ,`rst_value`) VALUES %s;"); // here %s could be (%d, %d,%d),(%d, %d,%d)
define("SelectQuestionExplainByIDs", "SELECT `t_questions_today`.`qt_id`, `t_questions`.`q_answer_id`, `t_questions`.`q_explain` FROM `t_questions_today` left join `t_questions` on `t_questions`.`q_id` = `t_questions_today`.`f_question_id` where `t_questions_today`.`qt_id` in (%s))");

// user operation query
class db_helper {
    public $mysqli = null;

    function __construct()
    {
        $this->mysqli = new \mysqli(HOST, USER, PWD, DB, PORT);
    }

    /*
     *  User Operation in DB
     */
    function HasAnswerQuestionToday($u_db_id)
    {
        $rst_user_answer_count = $this->mysqli->query(sprintf(HasAnswerQuestionsTodayByUserID,$u_db_id));
        $answer_count = $rst_user_answer_count->fetch_array();
        return ($answer_count[0] == 0)? false : true; // if answer_count is 0, user don't answer questions today.
    }

    function SelectQuestionsInfoByIDs($question_ids)
    {
        $query_result = $this->mysqli->query(sprintf(SelectQuestionExplainByIDs, $question_ids));
        $questions_info_array = array();
        if($query_result->num_rows)
        {
            while($row = $query_result->fetch_array())
            {
                $temp_show_info_array = array();
                //$temp_show_info_array['answerText'] = FormatAnswer2ABCD($row['q_answer_id']);
                //$temp_show_info_array['answerNum'] = str_replace("{#$}","#", $row['q_answer_id']);
                $temp_show_info_array['explain'] = $row['q_explain'];

                $questions_info_array[$row['q_id']] =$temp_show_info_array;
            }
        }
        return $questions_info_array;

    }
    function FormatAnswer2ABCD($db_answer_info)
    {
        $answer_info_string = "";
        foreach(explode("{#$}", $db_answer_info) as $value)
        {

            switch($value)
            {
                case 1:
                    $answer_info_string .= "A";
                    break;
                case 2:
                    $answer_info_string .= "B";
                    break;
                case 3:
                    $answer_info_string .= "C";
                    break;
                case 4:
                    $answer_info_string .= "D";
                    break;
            }
        }
        return $answer_info_string;
    }

    function QueryUserID($user_id)
    {
        $result = $this->mysqli->query(sprintf(UserDBIdByWXId, $user_id));
        if($result->num_rows)
        {
            $result_temp_id = $result->fetch_array();
            $temp_id = $result_temp_id[0];
            if(is_numeric($temp_id))
            {
                $result->free();
                return $temp_id;
            }
            else{
                //todo: log to warning;
            }
        }
        return  $this->InsertUser($user_id);
    }
    private function InsertUser($user_id)
    {

        $this->mysqli->query(sprintf(InsertUserWXId, $user_id, sha1($user_id))); // insert a new user
        $result = $this->mysqli->query(LatestID);
        $result_user = $result->fetch_array();
        return $result_user[0];
    }

    /*
     *  Questions Operation in DB
     */

    // select num questions randomly and insert into qt table
    private function GetRandomQuestionsIDArray($num){ //todo: update
        $result = $this->mysqli->query(GetQuestionsRandomlyAsNum); // firstly select randomly question_id

        $value_array = array();
        while($rst_row = $result->fetch_array())
        {
            $value_array[] =sprintf("(%d)", $rst_row['q_id']);
        }
        $value_tpl = implode(",",$value_array);     // handle question_id into str ,as"(1),(2),(3)"
        $result->free();
        $this->mysqli->query(sprintf(GenerateTodayQuestions_TPL,$value_tpl)); // insert into question_today table

        return $this->mysqli->errno;
    }

    // return an array of class question
    function GetTodayQuestions()
    {
        $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime);
        if($qt_rst->num_rows == 0) // if NOT today questions, generate first
        {
            $this->GetRandomQuestionsIDArray(0);   // insert into latest daily questions // todo: if return no is not correctly, should be handled
            $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime); // select again, and get "$qt_rst"
        }
        // if today's questions has generated, return questions info directly
        include "wx_question.php";

        $question_array = array();
        while($rst_row = $qt_rst->fetch_array())
        {
            $question_array[] = new wx_question($rst_row);
        }
        $qt_rst->free();
        return $question_array;
    }

    // insert users' answers, format should be ( %d=qt_id, %d=user_id,%d=answer_id),( %d=qt_id, %d=user_id,%d=answer_id)
    function InsertUserAnswers($value_format_str)
    {
        $this->mysqli->query(sprintf(InsertUserAnswer,$value_format_str));
        return $this->mysqli->errno;
    }
}


?>