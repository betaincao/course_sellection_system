<?php

namespace app\index\controller;
use PHPMailer\SendEmail;
class Sendmail{
	public function index(){

		$title = "计算机学院选课系统重置密码";//邮件标题
		$message = "您好，";//邮件内容
		$address = "cloud@xupt.edu.cn";//收件人
		$result = SendEmail::SendEmail($title,$message,$address);
        if($result){
			//发送成功的处理逻辑
			echo "success";
        }else{
			//发送失败的处理逻辑
			echo "error";
        }

	}
}