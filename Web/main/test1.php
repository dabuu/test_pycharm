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