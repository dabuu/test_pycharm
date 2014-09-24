<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-9-24
 * Time: 下午2:29
 */

class i_user_info {
    public $user_add_date, $user_count;

    function __construct($db_result_row)
    {
        $this->$user_add_date = $db_result_row['uDate'];
        $this->$user_add_date = $db_result_row['user_count'];
    }

}

?>