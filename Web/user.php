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
    private $wx_user_id;
    public  $user_db_id;
    function __construct($wx_user_id)
    {
        $this->wx_user_id = $wx_user_id;
    }

    private function GetUserID()
    {
        // query in DB:  $this->wx_user_id
        // return User
        // if new user
        return $this->InsertNewUser();; // return
    }

    private function InsertNewUser()
    {
        // insert into DB: $this->wx_user_id
        return 0; // insert success return user_id in DB. otherwise, return 0;
    }

    function HasAnswerQuestionToday()
    {
        // query in DB, whether the user had answered the questions
        return true;
    }



} 