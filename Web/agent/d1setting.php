<?php

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
                        <dd class="menu_item selected">
                            配置服务器说明</dd>
                    </dl>
                    <dl class="menu ">
                        <dt class="menu_title"><i class="icon_menu" style="background: url(./img/icon_menu_statistics.png) no-repeat;">
                            </i>统计</dt>
                        <dd class="menu_item ">
                            <a href="<?php echo "summery page link? uid=" ?>">
                                用户答题统计</a></dd>
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
                            配置微信地址:</h3>
                        <div>
                            <ul>
                                <li>
                                    <span style="font-weight: bold">http://dabuu.sinaapp.com/index.php?token=oPpghuP3V2Welj0pH63zCq7wNDQw</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <ul class="mp_news_list">
                        <li class="mp_news_item">
                            <div style="width: 100%; margin-top: 20px;" align="center">
                                <img src="./how2setting.png" alt="配置说明"/>
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

require_once "footer.html";

?>