<?php
require_once "db_helper.php";

$mysql = new \sf_wx_questions\db_helper();
$mysql->GetUserTodayCorrectNum()
?>