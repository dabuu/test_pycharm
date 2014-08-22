<?php

/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午5:00
 */
// todo: get user_guid
$fake_user_guid = "9877655";

$page_title = "有奖问答";
include "header.html";
include "user.php";
include "questions.php";

//$user_id = $_GET['uid'];
$user = new \sf_wx_questions\wx_user($fake_user_guid);
$has_answered = $user->HasAnswerQuestionToday(); // 是否已经答题，如果回答过 直接展示 答案。
?>
<body>
<form name="questions" method="post" action="checkanswer.php">
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

