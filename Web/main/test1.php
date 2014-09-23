<?php

//$test = array();
//
//$test[] = 1;
//$test[] = 1;
//$test[] = 1;
//
////$test[1] = 1;
////$test[2] = 1;
////$test[3] = 1;
//
//echo json_encode($test);
//exit;

$temp_array = array();
$temp_array [] = 10;
$temp_array [] = 20;
$temp_array [] = 30;

$str = "1{#$}2";
$temp = explode("{#$}", $str);

if(in_array(1, $temp))
{
    echo "true";
}
else
{
    echo "false";
}

for($i=1;$i<count($temp_array);$i++)
{
    echo $temp_array[$i];
}

exit;
$temp = array();
$temp[] = 2;
foreach ($temp as $value) {

    $temp_array[$value] = 1111111;
}

print_r($temp_array);
exit;

$sum = 0;
function Add($count)
{
    $sum =0 ;
    echo $sum = $sum + $count;
}

echo Add(10) ."<br/>";
echo $sum;

exit;
$test_array = array();
//$test_array['status'] = false;
$test_array['user'] = "10010";
$test_array['answers'][] = array("question_id"=>11, "answer"=>"1{#$}2", "is_correct"=> 1);
$test_array['answers'][] = array("question_id"=>22, "answer"=>"3", "is_correct"=> 0);
//$test_array['data']['focus'] = 1;
//$test_array['data']['today'] = 4;
//$test_array['data']['total'] = 100;
//$test_array['data']['today_rate'] = 80;

echo json_encode($test_array);






?>