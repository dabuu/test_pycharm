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

// user operation query

class dbhelper {
    public $mysqli = null;
    function __construct()
    {
        $this->$mysqli = new mysqli(HOST, USER, PWD, DB);
    }

    /*
     *  User Operation in DB
     */
    function QueryUserID($user_id)
    {
        return 0;
        // return $this->InsertUser($user_id);
    }
    private function InsertUser($user_id)
    {
        return 0;
    }

    /*
     *  Questions Operation in DB
     */

} 