<?php

/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午5:00
 */
if(!isset($_GET['uwid']) || empty($_GET['uwid'])){
    exit;
}
include "user.php";

//$user_id = $_GET['uid'];
$user = new \sf_wx_questions\user($_GET['uwid']);
if($user->HasAnswerQuestionToday())
{

    header("checkanswers.html");
    // "You had answered the questions." goto : checkanswer page;
    exit;
}

include "questions.php";

$page_title = "有奖问答";
include "header.html";
?>
<body>

<style type="text/css">
    body{
        font-size: 16px;
    }
    .q_container{
        border: 1px dotted black;
        margin-top: 10px;
    }
    .q_title{
        border-bottom: 1px solid red;
        padding: 10px;
    }
    .q_container p{
        margin: 10px;
    }
    .q_container ul{
        list-style: none;
    }
    .q_container ul li{
        margin-left: -20px;
        margin-bottom: 5px;
    }
    .q_container ul li label{
        margin-right: 10px;
    }
    input[type="radio"]{
        display:none;
    }
    input[type="radio"] + label
    {
        background: url("unchecked.png");
        height: 16px;
        width: 16px;
        display:inline-block;
        padding: 0 0 0 0;
    }

    input[type="radio"]:checked + label
    {
        background: url("checked.png");
        height: 16px;
        width: 16px;
        display:inline-block;
        padding: 0 0 0 0;
    }
    #submitanswer{
        width: 100%;
        height: 40px;
        font-size: 20px;
    }
</style>
<form name="questions" method="post" action="checkanswers.html">

    <?php
    $today_questions = new \sf_wx_questions\questions(5); //生成 5道题
    if(count($today_questions->today_questions_array))
    {
        $question_index = 1;
        $answers_str = strval($user->user_db_id)."*";
        foreach ($today_questions->today_questions_array as $question_item) {
            //            $question_item
            echo "<div class='q_container'><div class='q_title'><label>测试题 ".strval($question_index)."</label></div>";
            echo "<p>题目是".$question_item->q_context."</p><ul>";
            $option_index = 1;
            foreach($question_item->q_options as $option)
            {
                $temp_id = sprintf("%d_%d",$question_item->qt_id, $option_index);
                echo " <li><input type='radio' value='".strval($option_index)."' name='".strval($question_item->qt_id)."' id='".$temp_id."'/><label for='".$temp_id."'></label>".$option."</li>";
                $option_index ++;
            }
            $answers_str = $answers_str.strval($question_item->qt_id)."-".strval($question_item->q_answer)."_";

            echo "</ul></div>";
            $question_index++;
        }
    }
    else{
        echo "<p>Sorry: no questions!</p>";
        exit;
    }
    ?>
    <input type="button" value="提交答案" name="submitanswer" id="submitanswer" disabled="disabled"/>
    <input type="hidden" value="<?php echo $answers_str;?>" name="answers" />
</form>
<SCRIPT type="text/javascript">
    $(document).ready(function(){
        $(":radio").change(function(){
            is_submit_enable();
        });
        $("input#submitanswer").click(function(){
            alert($("form:first").serialize());
            //var $temp_user_answer_info = $("input:hidden").val() + "+" + $("form:first").serialize();
            alert($("input:hidden").val());
            return false;
//            $("input:hidden").val() += $("input:hidden").val() + "+" $("form:first").serialize() ;

            $("form:first").submit();
        });

        function is_submit_enable(){
            if($(":checked").length == 2){
                $("input[name=submitanswer]").removeAttr("disabled");
                $("input[name=submitanswer]").css("background-color","orange");
            }
        };
    });
</SCRIPT>

</body>
</html>

