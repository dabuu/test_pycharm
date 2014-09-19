<?php

$page_title = "会计答题成绩";
require "header.html";

require_once "wx_user.php";
require_once "questions.php";
require_once "db_helper.php";

if(!isset($_GET['uid']) || empty($_GET['uid']))
{
    echo "欢迎使用";
    exit;
}
$user_id = $_GET['uid'];
// todo: get user_guid
//$user_id = "9877655";

$user = new \sf_wx_questions\wx_user($user_id);
$mysql = new \sf_wx_questions\db_helper();

$today_questions_info = new \sf_wx_questions\questions(5);

//如果 post中有数据， 插入数据库
$any_post = false;
if(isset($_POST) && !empty($_POST))
{
    $insert_answers_array = array();
    $user_rst_temp = "";
    $user_is_correct = 0;
    foreach ( $_POST as $key => $value) {
        if($key == "info")
        {
            continue;
        }
        $user_rst_temp  = is_array($value)?  implode("{#$}", $value): $value;
        $user_is_correct  = ($today_questions_info->today_questions_array[$key]->q_answer == $user_rst_temp)? 1: 0;
        $insert_answers_array[] = sprintf("( %s, %s,'%s', %s)",$key,$user->user_db_id, $user_rst_temp, $user_is_correct);

    }
    $insert_answers_str = implode(",", $insert_answers_array);


    $mysql->InsertUserAnswers($insert_answers_str);
    $any_post  = true;
}

?>
<style>
    .banner{
        background: url("./<?php echo $any_post ? "aande.png" : "kjyjcs.png"; ?>") no-repeat;
        background-position: center;
    }
</style>
<body>
<div class="maindiv" align="center">
    <div class="banner_container" >
        <div class="banner">

        </div>
    </div>
    <?php
    if($any_post)
    {
        $index_temp = 1;
        foreach ( $today_questions_info->today_questions_array as $question_item) {
            echo '<div class="explain_container" align="left"> <p>'.$index_temp.'. '.$question_item->q_context.'</p><div class="explain"><p>解析：</p>';
            echo '<p>'.$question_item->q_explain.'</p></div></div>';
            $index_temp++;
        }
    }
    ?>
    <div class="show_container">
        <p><img src="./jiangbei.png" alt="jiangbei"/></p>
        <div class="show_content">
            <div class="p1">本次答对
                <?php
                $today_correct_count = $mysql->GetUserTodayCorrectNum($user->user_db_id);
                echo $today_correct_count;
                ?>
                题</div>

            <?php
            $lvl = 0;
            if($today_correct_count != 0)
            {
                echo '<div class="p2">打败全国';
                if($today_correct_count < 2)
                {
                    echo rand(20,45);
                }
                elseif($today_correct_count > 3)
                {
                    echo rand(80,95);
                }
                else{
                    echo rand(50,75);
                    $lvl = 1;
                }
                echo '%的同行</div>';
            }
            ?>

            <div class="p1">累计答题
                <?php
                echo $mysql->GetUserHistoryCorrectNum($user->user_db_id);
                ?>
                题!</div>
            <table class="rsttable">
                <tr>
                    <?php
                    if($lvl == 0)
                    {
                        echo "<td>非</td><td>常</td><td>优</td><td>秀</td>";
                    }
                    else
                    {
                        echo "<td>还</td><td>需</td><td>努</td><td>力</td>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <?php
        if($lvl == 1)
        {
            echo '<div style="margin-top: 10px;">相当不错的成绩</div>';
        }
        ?>

        <div>邀请你的朋友来一决高下吧</div>
        <p class="sharep"></p>
    </div>
</div>
</body>
<SCRIPT type="text/javascript">
    $(document).ready(function(){
        $(".sharep").click(function(){
            $(".maindiv").before('<div><img src="./share_instr.png" alt="" id="share_instruction"/></div>');
        });

    });
</SCRIPT>
</html>