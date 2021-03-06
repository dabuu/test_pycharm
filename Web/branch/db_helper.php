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
define("UserDBIdByWXId","SELECT `usr_id`,`focus_on_sf` FROM `app_dabuu`.`t_user` WHERE `usr_wx_id` = '%s'");
define("FocusSFInfoUserWXId","SELECT `usr_id`,`focus_on_sf`  FROM `app_dabuu`.`t_user` WHERE `usr_wx_id` = '%s'");
define("SetUserFocusOnStatus", "update `t_user` set `focus_on_sf`= %s where `usr_id` = %s ");
define("HasFocusOnSF", "SELECT `focus_on_sf` FROM `t_user` where `usr_id` = %d;");
define("InsertUserWXId","INSERT INTO `app_dabuu`.`t_user` (`usr_wx_id`, `user_wx_sha_id`, `focus_on_sf`,`f_agent_id`) VALUES ('%s', '%s','%s','%s');");
define("HasAnswerQuestionsTodayByUserID","SELECT count(*) FROM `t_results`WHERE DATE(`answer_time`) = DATE(NOW()) AND `f_user_id` = %d;");
define("GetUserAgentTokenByUserID", "SELECT `t_agent`.`a_nick_name_md5` FROM `t_user` join `t_agent` on `t_user`.`f_agent_id` = `t_agent`.`agent_id`where `t_user`.`usr_id`=%s");

/*
 *  Questions Operation in DB
 */
define("GetQuestionsRandomlyAsNum", "SELECT * FROM `app_dabuu`.`t_questions` LIMIT 0,5"); // todo: get question randomly
define("GetTodayQuestionsDateTime","SELECT `t_questions_today`.`qt_id`,`t_questions`.*  FROM `t_questions_today` LEFT JOIN `t_questions` ON `t_questions`.`q_id` = `t_questions_today`.`f_question_id`
WHERE DATE(`t_questions_today`.`qt_date`) = DATE(now()) ");
define("GenerateTodayQuestions_TPL","INSERT INTO `app_dabuu`.`t_questions_today` (`f_question_id`) VALUES %s;"); // here %s could be "(2),(3),(4)"
define("InsertUserAnswer","INSERT INTO `app_dabuu`.`t_results` (`f_qt_id` ,`f_user_id` ,`rst_value`,`rst_iscorrect`,`rate`) VALUES %s;"); // here %s could be (%d, %d,%d),(%d, %d,%d)
define("SelectQuestionExplainByIDs", "SELECT `t_questions_today`.`qt_id`, `t_questions`.`q_answer_id`, `t_questions`.`q_explain` FROM `t_questions_today` left join `t_questions` on `t_questions`.`q_id` = `t_questions_today`.`f_question_id` where `t_questions_today`.`qt_id` in (%s))");
define("SelectUserCorrectCountToday", "SELECT count(*),`rate` FROM `t_results` where `f_user_id` = %s and DATE(`answer_time`) = DATE(now()) and `rst_iscorrect` = 1");
define("SelectUserCorrectCountHistory", "SELECT count(*) FROM `t_results` where `f_user_id` = %s and `rst_iscorrect` = 1");
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
    function GetAgentTokenByUserID($user_db_id)
    {
        $rst = $this->mysqli->query(sprintf(GetUserAgentTokenByUserID,$user_db_id));
        if($rst->num_rows != 0)
        {
            $temp_value = $rst->fetch_array();
            $rst->free();
            return $temp_value[0];
        }

        return -1;
    }

    function HasAnswerQuestionToday($u_db_id)
    {
        $rst_user_answer_count = $this->mysqli->query(sprintf(HasAnswerQuestionsTodayByUserID,$u_db_id));
        $answer_count = $rst_user_answer_count->fetch_array();
        $rst_user_answer_count->free();
        return ($answer_count[0] != 0); // if answer_count is 0, user don't answer questions today.
    }

    function HasFocusOnSFWX($u_db_id)
    {
        $rst_user_focus_status = $this->mysqli->query(sprintf(HasFocusOnSF,$u_db_id));
        if($rst_user_focus_status->num_rows)
        {
            $user_focus_status = $rst_user_focus_status->fetch_array();
            return $user_focus_status[0]; // if answer_count is 0, user don't answer questions today.
        }
        else
        {
            return -1;
        }
    }
    function HasFocusOnSFByWXID($u_wx_id)
    {
        $user_info = array();
        $rst_user_focus_status = $this->mysqli->query(sprintf(FocusSFInfoUserWXId,$u_wx_id));
        if($rst_user_focus_status->num_rows)
        {
            $user_focus_status = $rst_user_focus_status->fetch_array();
            $user_info['user_id'] = $user_focus_status[0];
            $user_info['focus'] = $user_focus_status[1];
        }
        return $user_info;
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

    function UserFocusOnSF($user_id)// user's wx_open id
    {
        $need_answer = false;
        $result = $this->mysqli->query(sprintf(FocusSFInfoUserWXId, $user_id));
        if($result->num_rows) // if user is in DB,
        {
            $result_temp_id = $result->fetch_array();
            $temp_id = $result_temp_id[1]; //  $result_temp_id[1] is `focus_on_sf` = 1 is focus on
            if($temp_id == 0) // check if user is focus on SF;  `focus_on_sf` = 0 is NOT focus on
            {
                $this->mysqli->query(sprintf(SetUserFocusOnStatus,1, $result_temp_id[0]));//  $result_temp_id[0] is `usr_id`, update user's status

                return ($this->mysqli->errno == 0);
            }
        }
        else{ // if user is not in DB, he is a new user for SF by himself
            $user_db_id = $this->InsertUser($user_id, 1,0);
        }
        return false;
    }

    function GetUserDBID($user_wx_id)
    {
        $result = $this->mysqli->query(sprintf(UserDBIdByWXId, $user_wx_id));
        if($result->num_rows)
        {
            $result_temp_id = $result->fetch_array();
            $temp_id = $result_temp_id[0];
            if(is_numeric($temp_id))
            {
                $result->free();
                return $temp_id;
            }
        }
        return -1;
    }

    function QueryUserID($user_wx_id,$f_agent_id)
    {
        $user_info = array();
        $result = $this->mysqli->query(sprintf(UserDBIdByWXId, $user_wx_id));
        if($result->num_rows)
        {
            $result_temp_id = $result->fetch_array();

            $user_info['user_id'] = $result_temp_id[0];
            $user_info['focus'] = $result_temp_id[1];
        }
        else
        {
            $user_info['focus'] = 0;
            $user_info['user_id'] = $this->InsertUser($user_wx_id, 0,$f_agent_id);
        }
        return $user_info ;
    }
    private function InsertUser($user_wx_id, $focus_on,$f_agent_id)
    {

        $this->mysqli->query(sprintf(InsertUserWXId, $user_wx_id, sha1($user_wx_id), $focus_on,$f_agent_id)); // insert a new user
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

    function GetTodayQuestions4Interface($is_explain=false)
    {
        $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime);
        if($qt_rst->num_rows != 5) // if today there is NOT 5 questions, generate first
        {
            $this->GetRandomQuestionsIDArray(5);
            $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime);
        }

        include "i_question.php";
        $question_array = array();
        while($rst_row= $qt_rst->fetch_array())
        {
            $temp_q = new i_question($rst_row, $is_explain);
            $question_array[] =$temp_q;
        }
        $qt_rst->free();
        return $question_array;
    }

    // return an array of class question
    function GetTodayQuestions()
    {
        $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime);
        if($qt_rst->num_rows == 0) // if NOT today questions, generate first
        {
            $this->GetRandomQuestionsIDArray(5);   // insert into latest daily questions // todo: if return no is not correctly, should be handled
            $qt_rst = $this->mysqli->query(GetTodayQuestionsDateTime); // select again, and get "$qt_rst"
        }
        // if today's questions has generated, return questions info directly
        include "wx_question.php";
        $question_array = array();
        while($rst_row = $qt_rst->fetch_array())
        {
            $temp_q = new wx_question($rst_row);
            $question_array[$temp_q->qt_id] = $temp_q;
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

    function GetUserTodayCorrectInfo($user_db_id)
    {
        $query_rst = $this->mysqli->query(sprintf(SelectUserCorrectCountToday, $user_db_id));
        $count_rst = $query_rst->fetch_array();
        $query_rst->free();
        $today_info = array();
        $today_info['today'] =$count_rst[0];
        $today_info['rate'] =$count_rst[1];
        return $today_info;
    }

    function GetUserHistoryCorrectNum($user_db_id)
    {
        $query_rst = $this->mysqli->query(sprintf(SelectUserCorrectCountToday, $user_db_id));
        $count_rst = $query_rst->fetch_array();
        $query_rst->free();
        return $count_rst[0];
    }
}


?>