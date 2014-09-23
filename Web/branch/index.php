<?php

define("TOKEN", "weixin");

$wechatObj = new wechatCallbackapiTest();

if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            $result = "";
            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
            }

            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    private function receiveEvent($object)
    {
        $content = "";
        $need_answer = false;
        switch ($object->Event)
        {
            case "subscribe":
                $content = "欢迎关注dabu";

                require_once "db_helper.php";
                $mysql = new \sf_wx_questions\db_helper();
                $need_answer = $mysql->UserFocusOnSF($object->FromUserName);

                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
        }
        if($need_answer) // 是否返回答案
        {
            return $this->transmitNews($object); // focus & return answers;
        }
        else
        {
            $result = $this->transmitText($object, $content);
        }

    }
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

    private  function  receiveText($object)
    {
        $keyword = trim($object->Content);
        if($keyword == "答题" || $keyword == "1" || $keyword == "question")
        {
            $result = $this->transmitNews($object);
            return $result;
        }
        else
        {
            return "123";
        }
    }
    private function transmitNews($object)
    {
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>1</ArticleCount>
        <Articles>%s</Articles>
        </xml>";//        <Content><![CDATA[]]></Content>

        if(isset($_GET['token']) && !empty($_GET['token']))
        {
            $itemTpl = "<item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s?aid=%s&uid=%s]]></Url>
            </item>";

            $item_str = sprintf($itemTpl, "会计答题", "会计答题的描述", "http://2.dabuu.sinaapp.com/jiangbei.png", "http://2.dabuu.sinaapp.com/wx_exam.php",$_GET['token'], $object->FromUserName);
        }
        else
        {
            $itemTpl = "<item>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <Url><![CDATA[%s?uid=%s]]></Url>
            </item>";

            $item_str = sprintf($itemTpl, "会计答题", "会计答题的描述", "http://2.dabuu.sinaapp.com/jiangbei.png", "http://2.dabuu.sinaapp.com/wx_exam.php",$object->FromUserName);
        }


        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), $item_str);
        return $result;
    }

}
?>