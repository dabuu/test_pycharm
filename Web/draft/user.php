<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午3:32
 */

namespace sf_wx_questions;
include "dbhelper.php";

class user {
    private $wx_user_id, $mysql_helper;
    /*
     * @var int
     */
    public  $user_db_id;
    function __construct($wx_user_id)
    {
        $this->mysql_helper = new dbhelper();
        $this->user_db_id = $this->mysql_helper->QueryUserID($wx_user_id);

        $this->wx_user_id = $wx_user_id;
    }


    function HasAnswerQuestionToday()
    {
        // query in DB, whether the user had answered the questions
        return $this->mysql_helper->HasAnswerQuestionToday($this->user_db_id);
    }
}
?>