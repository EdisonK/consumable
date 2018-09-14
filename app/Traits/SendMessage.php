<?php
namespace App\Traits;
use iscms\AlismsSdk\TopClient;
use iscms\Alisms\SendsmsPusher as Sms;
/**
 * Created by PhpStorm.
 * User: zhd
 * Date: 5/7/18
 * Time: 13:26
 */
trait SendMessage{

     protected function sendReminderMsg($template,$tel,$para)
     {
         $top_client = new TopClient();
         $sms = new Sms($top_client);

         $smsParams = $para;
         $content = json_encode($smsParams); // 转换成json格式的
         $code = $template;   // 阿里大于(鱼)短信模板ID
         $result=$sms->send( $tel,'新格尔软件',$content,$code);
         return $result;

     }

}