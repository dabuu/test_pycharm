<?php
//if(!isset($_GET['uid']) || empty($_GET['uid']))
//{
//    header("Location: http://home.php");
//    exit;
//}
//include "wx_user.php";
//include "questions.php";
//
//// todo: get user_guid
//$user_id = $_GET['uid'];
////$user_id = "9877655";

$page_title = "微信会计答题配置|统计平台";
require_once "header.html";

//require_once "dba_helper.php";
//$mysql = new dba_helper();
//if(isset($_GET['token']) && !empty($_GET['token']))
//{
//    if($mysql->GetAgentDBID($_GET['token']) == -1)
//    {
//        header("Location: home.html");
//    }
//}
//else
//{
//    header("Location: home.html");
//}
//$token = $_GET['token'];
?>
    <div class="head" id="header">
        <div class="head_box">
            <div class="inner wrp">
                <h1 class="logo">
                    <span style="color:#44b549;">微信会计答题配置|统计平台</span>
                </h1>
                <div class="account">
                    <div class="account_meta account_info account_meta_primary">
                        <?php
                        //echo $mysql->GetAgentName($token);
                        echo "fakename";
                        ?>
                    </div>
                    <div class="account_meta account_logout account_meta_primary">
                        <a id="logout" href="home.html">
                            退出</a></div>
                </div>
            </div>
        </div>
    </div>
    <div id="body" class="body page_index">
        <div id="js_container_box" class="container_box cell_layout side_l">
            <div class="col_side">
                <div class="menu_box" id="menuBar">
                    <dl class="menu no_extra">
                        <dt class="menu_title"><i class="icon_menu" style="background: url(./img/icon_menu_setup.png) no-repeat;">
                            </i>配置</dt>
                        <dd class="menu_item">
                            <a href="<?php echo "summery page link? uid=" ?>">
                            配置服务器说明</a></dd>
                    </dl>
                    <dl class="menu ">
                        <dt class="menu_title"><i class="icon_menu" style="background: url(./img/icon_menu_statistics.png) no-repeat;">
                            </i>统计</dt>
                        <dd class="menu_item selected">
                                用户答题统计</dd>
                    </dl>
                    <dl class="menu ">
                        <dt class="menu_title"><i class="icon_menu" style="background: url(./img/icon_menu_management.png) no-repeat;">
                            </i>奖品</dt>
                        <dd class="menu_item ">
                            <a href="<?php echo "summery page link? uid=" ?>">
                                奖品状态</a></dd>
                    </dl>
                    <dl class="menu ">
                        <dt class="menu_title">
                            <i class="icon_menu" style="background: url(./img/icon_menu_ad.png) no-repeat;">
                            </i>说明</a> </dt>
                        <dd class="menu_item ">
                            <a href="<?php echo "summery page link? uid=" ?>">
                                会计比赛说明</a></dd>
                    </dl>
                </div>
            </div>
            <div class="col_main">
                <div class="mp_news_area notices_box">
                    <div class="title_bar">
                        <h3>
                            用户答题统计</h3>
                    </div>
                    <ul class="mp_news_list">
                        <li class="mp_news_item">
                            <div style="width: 100%; margin-top: 20px;" align="center">
                                <table id="summery" style="border-collapse: collapse;border: none;">
                                    <tr>
                                        <th>日期</th><th>总用户数</th><th>昨日新增用户数</th><th>当天答题数量</th><th>当天答题正确率</th>
                                    </tr>
                                    <?php
                                    require_once "dba_helper.php";

                                    $a_mysql = new dba_helper();

                                    $total_user_count = $a_mysql->GetTotalUserCountByAgentToken($token);
                                    if($total_user_count != -1) // 如果 total 人数不等于 -1， 继续
                                    {
                                        $daily_user_array = $a_mysql->GetLast7DaysUserCountByToken($token);
                                        $daily_answer_array = $a_mysql->GetLast7DaysAnswerInfoByToken($token);

                                        for ($i=0; $i<7; $i++)
                                        {
                                            $tmp_date = date("Y-m-d", strtotime($i." days ago"));
                                            echo "<tr><td>".$tmp_date."8</td><td>".$total_user_count."</td>";
                                            $total_user_count = $total_user_count-$daily_user_array[$tmp_date];
                                            if(array_key_exists($tmp_date, $daily_user_array))
                                            {
                                                echo "<td>".$daily_user_array[$tmp_date]."</td>";
                                            }
                                            else
                                            {
                                                echo "<td>0</td>";
                                            }

                                            if(array_key_exists($tmp_date, $daily_answer_array))
                                            {
                                                echo "<td>".$daily_answer_array[$tmp_date]['answer_count']."</td><td>".$daily_answer_array[$tmp_date]['correct_rate']."%</td></tr>";
                                            }
                                            else
                                            {
                                                echo "<td>0</td><td>0</td></tr>";
                                            }
                                        }
                                    }

                                    ?>
<!--                                    <tr><td>2014.9.8</td><td>10</td><td>3.2</td><td>3</td><td>2</td></tr>-->
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="faq">
            <p class="tail">
                反馈微信 dbwy23</p>
        </div>
    </div>


<?php

require "footer.html";

?>