
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>会计答题</title>
    <script language="javascript" type="text/javascript" src="../jquery/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
</head>
<body>
<form name="questions" method="post" action="./wx_result.php">
    <div class="q_container"><p>1.小企业外部会计信息使用者主要为 </p><table class="q_container_table"><tr><td class="left_label"><span>A</span></td><td class="right_option"><input type="radio" value="1" name="31" id="31_1"/><label for="31_1">税务部门和银行</label></td></tr><tr><td class="left_label"><span>B</span></td><td class="right_option"><input type="radio" value="2" name="31" id="31_2"/><label for="31_2">投资者</label></td></tr><tr><td class="left_label"><span>C</span></td><td class="right_option"><input type="radio" value="3" name="31" id="31_3"/><label for="31_3">债权人</label></td></tr><tr><td class="left_label"><span>D</span></td><td class="right_option"><input type="radio" value="4" name="31" id="31_4"/><label for="31_4">董事会</label></td></tr></table></div><div class="q_container"><p>2.小企业的会计要素计量属性均为 </p><table class="q_container_table"><tr><td class="left_label"><span>A</span></td><td class="right_option"><input type="radio" value="1" name="30" id="30_1"/><label for="30_1">重置成本</label></td></tr><tr><td class="left_label"><span>B</span></td><td class="right_option"><input type="radio" value="2" name="30" id="30_2"/><label for="30_2">可变现净值</label></td></tr><tr><td class="left_label"><span>C</span></td><td class="right_option"><input type="radio" value="3" name="30" id="30_3"/><label for="30_3">历史成本</label></td></tr><tr><td class="left_label"><span>D</span></td><td class="right_option"><input type="radio" value="4" name="30" id="30_4"/><label for="30_4">公允价值</label></td></tr></table></div><div class="q_container"><p>3.下列关于小企业会计准则的说法中，正确的有 </p><table class="q_container_table"><tr><td class="left_label"><span>A</span></td><td class="right_option"><input type="checkbox" value="1" name="32" id="32_1"/><label for="32_1">小企业会计准则下，不计提存货跌价准备</label></td></tr><tr><td class="left_label"><span>B</span></td><td class="right_option"><input type="checkbox" value="2" name="32" id="32_2"/><label for="32_2">小企业会计准则下，盘盈存货实现的收益应当冲减管理费用</label></td></tr><tr><td class="left_label"><span>C</span></td><td class="right_option"><input type="checkbox" value="3" name="32" id="32_3"/><label for="32_3">小企业会计准则下，发生损失时直接冲减资产，不计提减值准备</label></td></tr><tr><td class="left_label"><span>D</span></td><td class="right_option"><input type="checkbox" value="4" name="32" id="32_4"/><label for="32_4">小企业会计准则下，全部采用直线法摊销</label></td></tr></table></div><div class="q_container"><p>4.小企业准则中，其他应收款核算的内容有 </p><table class="q_container_table"><tr><td class="left_label"><span>A</span></td><td class="right_option"><input type="checkbox" value="1" name="33" id="33_1"/><label for="33_1">应收的各种赔款</label></td></tr><tr><td class="left_label"><span>B</span></td><td class="right_option"><input type="checkbox" value="2" name="33" id="33_2"/><label for="33_2">应收账款</label></td></tr><tr><td class="left_label"><span>C</span></td><td class="right_option"><input type="checkbox" value="3" name="33" id="33_3"/><label for="33_3">应收的各种罚款</label></td></tr><tr><td class="left_label"><span>D</span></td><td class="right_option"><input type="checkbox" value="4" name="33" id="33_4"/><label for="33_4">应向职工收取的各种垫付款项</label></td></tr></table></div><div class="q_container"><p>5.消耗性生物资产在账务处理时可能涉及的会计科目有 </p><table class="q_container_table"><tr><td class="left_label"><span>A</span></td><td class="right_option"><input type="checkbox" value="1" name="34" id="34_1"/><label for="34_1">农产品</label></td></tr><tr><td class="left_label"><span>B</span></td><td class="right_option"><input type="checkbox" value="2" name="34" id="34_2"/><label for="34_2">消耗性生物资产</label></td></tr><tr><td class="left_label"><span>C</span></td><td class="right_option"><input type="checkbox" value="3" name="34" id="34_3"/><label for="34_3">存货</label></td></tr><tr><td class="left_label"><span>D</span></td><td class="right_option"><input type="checkbox" value="4" name="34" id="34_4"/><label for="34_4">银行存款</label></td></tr></table></div>    <input type="button" value="提交答案" name="submitanswer" id="submitanswer" disabled="disabled"/>
    <input type="hidden" value="20" name="info" id="info" />
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
                        $("#result").after("focus!");
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
            if($(":checked").length == 2){
                if($('div.q_container:not(:has(:checked))').length == 0){
                    $("input[name=submitanswer]").removeAttr("disabled").css({"background-color":"#FF6162", "color":"#ffffff"});
                }
                else
                {
                    $("input[name=submitanswer]").attr("disabled","disable").css({"background-color":"", "color":"#000000"});
                }
            }
        };
    });
</SCRIPT>

</body>
</html>

