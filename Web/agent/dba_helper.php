<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-21
 * Time: 下午6:10
 */

define("HOST", SAE_MYSQL_HOST_M);
define("USER", SAE_MYSQL_USER);
define("PWD", SAE_MYSQL_PASS);
define("DB", SAE_MYSQL_DB);
define("PORT", SAE_MYSQL_PORT);

define("LatestID","SELECT @@IDENTITY ;");

//agent info
define("InsertAgent","INSERT INTO `app_dabuu`.`t_agent` ( `a_nick_name_md5`, `a_nick_name`, `a_pwd`, `a_pwd_sha`) VALUES ('%s','%s','%s','%s')");
define("InsertAgentDetails","INSERT INTO `app_dabuu`.`t_agent_detail` (`f_agent_id`, `c_name`, `c_province`, `c_city`,
 `agetor_phone`, `agentor_name`, `wx_name`, `wx_pic`, `cmt`) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')");
define("GetAgentToken","SELECT `a_nick_name_md5` FROM `t_agent`where `a_nick_name`= '%s' and `a_pwd` =  '%s'");
define("GetAgentDBID","SELECT `agent_id` FROM `t_agent`where `a_nick_name_md5`= '%s'");
define("GetAgentName","SELECT `a_nick_name` FROM `t_agent`where `a_nick_name_md5`= '%s'");
define("GetDupUserName", "SELECT `agent_id` FROM `t_agent`where `a_nick_name`= '%s'");

//user info
define("GetTotalUserCountByToken", "SELECT count(*) as user_count FROM `t_agent` join `t_user` on `t_user`.`f_agent_id` = `t_agent`.`agent_id` where `a_nick_name_md5` = '%s'");
define("GetLast7DaysUserCountByToken", "SELECT Date(`t_user`.`latest_update_time`) as uDate,count(*) as user_count FROM `t_agent` join `t_user` on `t_user`.`f_agent_id` = `t_agent`.`agent_id` where `a_nick_name_md5` = '%s' and`t_user`.`latest_update_time` > date_add(now(), interval -7 day) group by Date(`t_user`.`latest_update_time`) order by Date(`t_user`.`latest_update_time`) Desc ");
define("GetLast7DaysUserCountAndAnswersGroupByDateByToken", " SELECT  Date(`t_results`.`answer_time`) as rDate,count(`t_results`.`rst_iscorrect`) as answer_count ,round(sum(`t_results`.`rst_iscorrect`)/count(`t_results`.`rst_iscorrect`)*100, 2) as correct_rate FROM `t_agent` join `t_user` on `t_user`.`f_agent_id` = `t_agent`.`agent_id` join `t_results` on `t_user`.`usr_id` = `t_results`.`f_user_id` where `a_nick_name_md5` = '%s' and `t_results`.`answer_time` > date_add(now(), interval -7 day) group by Date(`t_results`.`answer_time`) order by Date(`t_results`.`answer_time`) Desc");

class dba_helper {
    public $mysqli = null;

    function __construct()
    {
        $this->mysqli = new \mysqli(HOST, USER, PWD, DB, PORT);
    }

    /*
     *  Agent Operation in DB
     */
    public function InsertAgent($user_name, $user_pwd)
    {
        $this->mysqli->query(sprintf(InsertAgent,md5($user_name),$user_name, $user_pwd, md5($user_pwd)));
        if($this->mysqli->errno == 0)
        {
            return md5($user_name);
        }
        else
        {
            return 0;
        }
    }

    // 这里的 wx_pic 是一个路径， 先用 InsertPic2SaeStorage 获取
    public function InsertAgentDetails($token, $c_name, $c_province,$c_city, $agent_no, $agent_name, $wx_name, $wx_pic)
    {
        if(($db_id = $this->GetAgentDBID($token)) != -1)
        {
            $this->mysqli->query(sprintf(InsertAgentDetails, $db_id,$c_name, $c_province, $c_city, $agent_no, $agent_name,$wx_name, $wx_pic));

            return ($this->mysqli->errno == 0);
        }
        else
        {
            return false;
        }
    }

    public function GetDupAgentName($name)
    {
        $rst = $this->mysqli->query(sprintf(GetDupUserName, $name));
        return ($rst->num_rows ==0)? false : true;
    }

    public function GetAgentToken($name, $pwd)
    {
        $rst = $this->mysqli->query(sprintf(GetAgentToken, $name,$pwd));
        if($rst->num_rows)
        {
            $temp_row = $rst->fetch_assoc();
            $rst->free();
            return $temp_row[0];
        }
        return 0;
    }

    public function GetAgentDBID($token)
    {
        $rst = $this->mysqli->query(sprintf(GetAgentDBID,$token));
        if($rst->num_rows)
        {
            $tmp_row = $rst->fetch_array();
            $rst->free();
            return $tmp_row[0];
        }
        return -1;
    }

    public function GetAgentName($token)
    {
        $rst = $this->mysqli->query(sprintf(GetAgentName,$token));
        if($rst->num_rows)
        {
            $tmp_row = $rst->fetch_array();
            $rst->free();
            return $tmp_row[0];
        }
        return -1;
    }

    public function GetTotalUserCountByAgentToken($agent_token)
    {
        $rst = $this->mysqli->query(sprintf(GetTotalUserCountByToken,$agent_token));
        if($rst->num_rows)
        {
            $tmp_value = $rst->fetch_array();
            $rst->free();
            return $tmp_value;
        }
        else
        {
            return -1;
        }
    }

    public function GetLast7DaysUserCountByToken($agent_token)
    {
        $rst = $this->mysqli->query(sprintf(GetLast7DaysUserCountByToken,$agent_token));

        $daily_user_info = array();
        while($rst_row = $rst->fetch_array())
        {
            $daily_user_info[$rst_row['uDate']] = $rst_row['user_count'];
        }
        $rst->free();
        return $daily_user_info;
    }

    public function GetLast7DaysAnswerInfoByToken($agent_token)
    {
        $rst = $this->mysqli->query(sprintf(GetLast7DaysUserCountAndAnswersGroupByDateByToken,$agent_token));

        $daily_answer_info = array();
        while($rst_row = $rst->fetch_array())
        {
            $temp_array = array();
            $temp_array['answer_count'] = $rst_row['answer_count'];
            $temp_array['correct_rate'] = $rst_row['correct_rate'];

            $daily_answer_info[$rst_row['rDate']] = $temp_array;
        }
        $rst->free();
        return $daily_answer_info;
    }


    public static function InsertPic2SaeStorage($desc_name, $files)
    {
        $ss = new SaeStorage();
        return $ss->upload('dabu',$desc_name,$files['tmp_name']);//把用户传到SAE的文件转存到名为test的storage
    }

}

?>