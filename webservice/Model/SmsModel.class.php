<?php
namespace Index\Model;
use Think\Model;

class SmsModel extends Model{
    /**
     * 发送短信
     * @param string $mobile 手机号码
     * @param string $message 短信内容
     */
    public function sendSms($mobile,$message){
        //发送短信代码
        $result = true;
        return $result;
	}
}
