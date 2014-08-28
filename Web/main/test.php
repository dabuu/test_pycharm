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

$test_array = array( 0 => 'A', 1 => 23, 2 => 'C' ) ;
print_r($test_array);
echo "<br/>".$test_array['0']."<br/>";
echo $test_array[1]."<br/>";
echo $test_array[2]."<br/>";
exit;

$answer  = "1";


echo $answer_translate =  Answer2Bin(explode("{#$}", $answer));
echo Answer2Dec($answer_translate);
exit;
function Answer2Bin($array_answer_id)
{


    foreach ($array_answer_id as $key=>$value) {
        echo $array_answer_id[$key] = decbin(intval($value)-1);
        echo "<br/>";
    }
    return implode("#", $array_answer_id);
}

function Answer2Dec($answer_str)
{
    $array_temp_answer = explode("#",$answer_str);

    foreach ($array_temp_answer as $key=>$value) {
        echo "<br/>";
        echo $array_temp_answer[$key] = bindec(strval($value)) + 1;
    }
    echo "<br/>";
    return implode("#",$array_temp_answer);
}

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