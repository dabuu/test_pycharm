<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset=utf-8" />
    <title>SX_TestIntroduction_Frame</title>
    <script type="application/javascript" src="../jquery/geo.js"></script>
</head>
<body onload="setup();">
<form action="handle_form.php" method="post">
    <fieldset>
        <legend>请填写你的注册信息</legend>
        <table>
            <tr>
                <td class="c_subject">公司名称</td>
                <td class="c_info"><input id="name" type="text" name="name" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">公司所在地</td>
                <td class="c_info">
                    <select class="select" name="province" id="s1">
                        <option></option>
                    </select>
                    <select class="select" name="city" id="s2">
                        <option></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="c_subject">电话</td>
                <td class="c_info"><input id="phone" type="text" name="phone" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">负责人</td>
                <td class="c_info"><input id="charger" type="text" name="charger" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">订阅号名称</td>
                <td class="c_info"><input id="wx_id" type="text" name="wx_id" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">订阅号二维码图片</td>
                <td class="c_info"><input type="file" name="wx_pic"/></td>
            </tr>
            <tr>
                <td class="c_subject">登陆名</td>
                <td class="c_info"><input id="username" type="text" name="username" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">密码</td>
                <td class="c_info"><input id="pwd" type="text" name="pwd" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <td class="c_subject">确认密码</td>
                <td class="c_info"><input id="confirm_pwd" type="text" name="confirm_pwd" size="20" maxlength="20"></td>
            </tr>
        </table>
    </fieldset>
    <div align="center"><input type="submit" name="submit11" value="Submit my info" onclick="return ckl()" /></div>
</form>
</body>
</html>