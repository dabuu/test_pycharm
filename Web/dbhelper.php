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

/*
 *  Questions Operation in DB
 */

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
        $this->$mysqli->query()
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