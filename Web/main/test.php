<?php
/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-20
 * Time: 下午4:30
 */
//$var1 = "test1";
//$var2 = "test2";
//
//echo "'$var1'";

include "wx_question.php";

$answer_array  = array('foo' => 'bar', 33 => 'bin', 'lorem' => 'ipsum');

foreach ($answer_array as $value) {
    echo "<br/>".$value;
}
exit;

$array_qt_ids = array_keys($answer_array);
print_r($array_qt_ids);
$array_answer_ids = array_values($answer_array);
print_r($array_answer_ids);
$wx_user_id = 10;

echo $update_query = "($array_qt_ids[0],$wx_user_id , $array_answer_ids[0])";
echo "<br/>";
for($i=1; $i<count($array_answer_ids); $i++)
{
    echo $update_query .= ",($array_qt_ids[$i],$wx_user_id,  $array_answer_ids[$i])";
    echo "<br/>";
}
?>