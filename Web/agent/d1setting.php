<?php

$page_title = "微信会计答题配置|统计平台";
require_once "header.html";

//require_once "db_helper.php";
//$mysql = new db_helper();
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
<!--                    <a href="#" title="SFLogo">微信会计答题配置|统计平台</a>-->
                    <span style="color:#44b549;">微信会计答题配置|统计平台</span>
                </h1>
                <div class="account">
                    <div class="account_meta account_info account_meta_primary">
                        //todo: user's name
                        <?php
                            echo $mysql->GetAgentName($token);
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
                            系统公告</h3>
                        <div>
                            <ul>
                                <li>
                                    url is xxx
                                </li>
                                <li>
                                    your id is yyy
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="mp_news_list">
                        <li class="mp_news_item">
                            <div>
                                <img src="./img/icon_menu_ad.png" alt=""/>
                                fds;afljsldfsj;j;sdjfb<br/>
                                PHP页面跳转一、header()函数

                                header()函数是PHP中进行页面跳转的一种十分简单的方法。header()函数的主要功能是将HTTP协议标头(header)输出到浏览器。

                                header()函数的定义如下：

                                void header (string string [,bool replace [,int http_response_code]])

                                可选参数replace指明是替换前一条类似标头还是添加一条相同类型的标头，默认为替换。

                                第二个可选参数http_response_code强制将HTTP相应代码设为指定值。 header函数中Location类型的标头是一种特殊的header调用，常用来实现页面跳转。注意：1.location和“:”号间不能有空格，否则不会跳转。

                                2.在用header前不能有任何的输出。

                                3.header后的PHP代码还会被执行。例如，将浏览器重定向到lamp兄弟连官方论坛
                            </div>
                        </li>
                        <li class="mp_news_item"><a href="https://mp.weixin.qq.com/cgi-bin/readtemplate?t=news/note_enterprise_tmpl&lang=zh_CN"
                                                    target="_blank"><strong>微信“企业号”上线通知<i class="icon_common new"></i></strong> <span
                                    class="read_more">2014-09-19</span> </a></li>
                        <li class="mp_news_item no_extra"><a href="http://kf.qq.com/product/weixinmp.html"
                                                             target="_blank"><strong>微信公众平台客服专区</strong> <span class="read_more">2013-03-19</span>
                            </a></li>
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