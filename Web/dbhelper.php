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
        $this->mysqli = new \mysqli(HOST, USER, PWD, DB);
    }

    /*
     *  User Operation in DB
     */
    function QueryUserID($user_id)
    {
        $result = $this->mysqli->query(sprintf(UserDBIdByWXId, $user_id));
        if($result->num_rows)
        {
            $temp_id = $result->fetch_array()[0];
            if(is_numeric($temp_id))
            {
                return $temp_id;
            }
            else{
                //todo: log to warning;
            }
        }
        return  InsertUser($user_id);
        // return $this->InsertUser($user_id);
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
    function GenerateQuestions($num){

    }
/*
SELECT *
FROM `tbl_test` AS t1 JOIN (
SELECT ROUND(RAND() * ((SELECT MAX(`t_id`) FROM `tbl_test`)-(SELECT MIN(`t_id`) FROM `tbl_test`))+(SELECT MIN(`t_id`) FROM `tbl_test`)) AS id
from `tbl_test` limit 50) AS t2 on t1.`t_id`=t2.id
ORDER BY t1.`t_id` LIMIT 4;
*/
} 