<?php

/**
 * Created by PhpStorm.
 * User: dabuwang
 * Date: 14-8-4
 * Time: 下午5:00
 */


if(!isset($_GET['uid']) || empty($_GET['uid']))
{
    echo "Welcome!";
    exit;
}


include "wx_user.php";
include "questions.php";

// todo: get user_guid
$user_id = $_GET['uid'];
//$user_id = "9877655";

$user = new \sf_wx_questions\wx_user($user_id);

$has_answered = $user->HasAnswerQuestionToday(); // 是否已经答题，如果回答过 直接展示 答案。
if($has_answered)
{
    //    header("Location: ./wx_answer.php?uid=".$user_id);
    //exit;
}

$page_title = "会计答题";
require "header.html";



?>

<body>
<form name="questions" method="post" action="./wx_answer.php?uid=<?php echo $user_id;?>">
    <?php
    $today_questions = new \sf_wx_questions\questions(5); //生成 5道题
    if(count($today_questions->today_questions_array))
    {
        $question_index = 1;
        $answer_index = array(1=>'A',2=>'B',3=>'C',4=>'D');
        $answers_str = strval($user->user_db_id);
        foreach ($today_questions->today_questions_array as $question_item) {
            //            $question_item
            echo '<div class="q_container"><p>'.$question_index.'.'.$question_item->q_context.' </p><table class="q_container_table">';
            $option_index = 1;
            foreach($question_item->q_options as $option)
            {
                $temp_id = sprintf("%d_%d",$question_item->qt_id, $option_index);
                echo '<tr><td class="left_label"><span>'.$answer_index[$option_index].'</span></td><td class="right_option">';
                echo '<input type="'.(($question_item->q_type == 1)? 'radio':'checkbox').'" value="'.$option_index.'" name="'.(($question_item->q_type == 1)? $question_item->qt_id :$question_item->qt_id.'[]').'" id="'.$temp_id .'"/>';
                echo '<label for="'.$temp_id .'">'.$option.'</label></td></tr>';
                $option_index ++;
            }
            echo '</table></div>';
            $question_index++;
        }
    }
    else{
        echo "<p>Sorry: no questions!</p>";
        exit;
    }
    ?>
    <input type="button" value="提交答案" name="submitanswer" id="submitanswer" disabled="disabled"/>
    <input type="hidden" value="<?php echo $answers_str;?>" name="info" id="info" />
</form>
<div id="result"></div>
<SCRIPT type="text/javascript">
    $(document).ready(function(){

        $(":radio").change(function(){
            $(this).parent().parent().parent().find(".right_option").css({"background-color":"#666666", "color": "#ffffff"});
            $(this).parent().css({"background-color":"#ffffff",  "color": "#666666"});
            is_submit_enable();
        });

        $(":checkbox").change(function(){
            if($(this).is(":checked"))
            {
                $(this).parent().css({"background-color":"#ffffff",  "color": "#666666"});
            }
            else
            {
                $(this).parent().css({"background-color":"#666666", "color": "#ffffff"});
            }
            is_submit_enable();
        });

        $("input#submitanswer").click(function(){

            $("input#submitanswer").val("提交中...");
            $("input#submitanswer").attr("disabled","disable").css("background-color","");
            $.ajax({
                type:"post",
                url: "checkfocus.php",
                dataType:"text",
                data:  { user_id: $("#info").val() },
                success:function(data){
                    if(data == 0)
                    {
                        $("input#submitanswer").hide();
                        $("#result").before("第一次答题，请关注下面的微信账号，获取答案和全国成绩排名！");
                        $("#result").html("<img src='./sf_pic.jpg'>");


                        return;
                    }
                    else if(data == 1)
                    {
                        $("form:first").submit();
                        return;
                    }
                    else
                    {
                        $("#result").after("Something wrong!");
                    }

                },
                error:function(XMLHttpRequest, textStatus, errorThrown){
                    alert("1"+errorThrown);
                    $("input#submitanswer").val("提交答案!");
                }
            });
        });

        function is_submit_enable(){
            if($('div.q_container:not(:has(:checked))').length == 0){
                $("input[name=submitanswer]").removeAttr("disabled").css({"background-color":"#FF6162", "color":"#ffffff"});
            }
            else
            {
                $("input[name=submitanswer]").attr("disabled","disable").css({"background-color":"", "color":"#000000"});
            }
        };
    });
</SCRIPT>

</body>
</html>

