<!DOCTYPE html>
<html>
<head>
    <title>详细信息</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css" />
    <script language="javascript" type="text/javascript" src="../jquery/jquery-1.11.1.min.js"></script>
    <script type="application/javascript" src="../jquery/geo.js"></script>
</head>
<body onload="setup();">
        <h1 class="logo">
            请完善详细信息
        </h1>
    <div id="main">
        <div id="reg-box" >
            <form class="reg-bg" method="post" action="regcheck.php?token=xxx" id="reg_form" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td class="c_subject">公司名称：</td>
                        <td class="c_info"><input tabindex="1" id="name" type="text" name="name" size="20" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td class="c_subject">公司所在地：</td>
                        <td class="c_info">
                            <select class="select" name="province" id="s1" tabindex="2" >
                                <option></option>
                            </select>
                            <select class="select" name="city" id="s2" tabindex="3" >
                                <option></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="c_subject">电话：</td>
                        <td class="c_info"><input  tabindex="4" id="phone" type="text" name="phone" size="20" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td class="c_subject">负责人：</td>
                        <td class="c_info"><input tabindex="5"  id="charger" type="text" name="charger" size="20" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td class="c_subject">订阅号名称：</td>
                        <td class="c_info"><input  tabindex="6"  id="wx_id" type="text" name="wx_id" size="20" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td class="c_subject">订阅号二维码图片：</td>
                        <td class="c_info"><input type="file" name="wx_pic"/></td>
                    </tr>
                </table>

                <div id="create_details">
                    <button tabindex="7" id="create-btn" class="green-btn" name="details" type="submit"><span>完成</span></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>