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
$cc = "省份aaa";

$response['content'] = sprintf("INSERT INTO `app_dabuu`.`t_agent_detail`
(`f_agent_id`, `c_name`, `c_province`, `c_city`, `agetor_phone`, `agentor_name`, `wx_name`, `wx_pic`)
VALUES
('%s','%s','%s','%s','%s','%s','%s','%s')", $agent_id,$c_name, $c_province, $c_city, $agent_no, $agent_name,$wx_name, $file_path);

echo strcmp($cc,"省份");
exit;
//
//&& !strcmp($c_province,"省份") && !strcmp($c_city,"地级市") &&
//!empty($phone) &&!empty($charger) &&!empty($wx_name) && !empty($_FILES['wx_pic']

for ($i=0; $i<7; $i++)
{
    echo date("Y-m-d", strtotime($i." days ago")).'<br />';
}

exit;

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