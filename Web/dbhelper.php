<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午4:46
 */

namespace sf_wx_questions;

define("HOST", "localhost");
define("USER", "test");
define("PWD", "1qaz");
define("DB", "test");

define("LatestID","SELECT @@IDENTITY ;");
/*
 *  User Operation in DB
 */
define("UserDBIdByWXId","SELECT `usr_id` FROM `app_dabuu`.`t_user` WHERE `usr_wx_id` = '%s'");
define("InsertUserWXId","INSERT INTO `app_dabuu`.`t_user` (`usr_wx_id`) VALUES ('%s');");
define("HasAnswerQuestionsTodayByUserID","SELECT count(*) FROM `t_results`WHERE DATE(`answer_time`) = DATE(NOW()) AND `f_user_id` = %d;");

/*
 *  Questions Operation in DB
 */
define("GetQuestionsRandomlyAsNum", "SELECT * FROM `app_dabuu`.`t_questions` LIMIT 0,2"); // todo: get question randomly
define("GetTodayQuestionsDateTime","SELECT `t_questions_today`.`qt_id`,`t_questions`.*  FROM `t_questions_today` LEFT JOIN `t_questions` ON `t_questions`.`q_id` = `t_questions_today`.`f_question_id`
WHERE DATE(`t_questions_today`.`qt_date`) = DATE(now()) ");
define("GenerateTodayQuestions_TPL","INSERT INTO `app_dabuu`.`t_questions_today` (`f_question_id`) VALUES %s;"); // here %s could be "(2),(3),(4)"
define("InsertUserAnswer","INSERT INTO `app_dabuu`.`t_results` (`f_qt_id` ,`f_user_id` ,`rst_value`) VALUES ( %d, %d,%d);");

// user operation query
class dbhelper {
    public $mysqli = null;
    function __construct()
    {
        $this->mysqli = new \mysqli(HOST, USER, PWD, DB);
    }

    /*
     *  User Operation in DB
     */
    function HasAnswerQuestionToday($u_db_id)
    {
        $rst_user_answer_count = $this->mysqli->query(sprintf(HasAnswerQuestionsTodayByUserID,$u_db_id));
        return ($rst_user_answer_count->fetch_array()[0] == 0)? false : true; // if answer_count is 0, user don't answer questions today.
    }


    function QueryUserID($user_id)
    {
        $result = $this->mysqli->query(sprintf(UserDBIdByWXId, $user_id));
        if($result->num_rows)
        {
            $temp_id = $result->fetch_array()[0];
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
        $this->mysqli->query(sprintf(UserDBIdByWXId, $user_id)); // insert a new user
        $result = $this->mysqli->query(LatestID);
        return $result->fetch_array()[0];
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
        include "question.php";
        $question_array = array();
        while($rst_row = $qt_rst->fetch_array())
        {
            $question_array[] = new question($rst_row);
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

/*
SELECT *
FROM `tbl_test` AS t1 JOIN (
SELECT ROUND(RAND() * ((SELECT MAX(`t_id`) FROM `tbl_test`)-(SELECT MIN(`t_id`) FROM `tbl_test`))+(SELECT MIN(`t_id`) FROM `tbl_test`)) AS id
from `tbl_test` limit 50) AS t2 on t1.`t_id`=t2.id
ORDER BY t1.`t_id` LIMIT 4;
*/
} 