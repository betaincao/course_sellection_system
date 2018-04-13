<?php
/**
 * Repassword controller
 * created by caoyouming, 2018-04-09
 */
namespace app\index\controller;
use think\Controller;
use PHPMailer\SendEmail;
class Repassword extends Controller{
	/**
	 * 学生找回密码
	 */
	public function student_repwd(){
		if(request()->isPost()){
			$studentnum = input('studentnum');
			$captcha = input('captcha');
			if(captcha_check($captcha)){
				if(!empty($studentnum)){
					$data = \think\Db::name("student")->field('s_num,name,s_mail')->where('s_num',$studentnum)->find();
					if($data){
						$data = serialize($data);
						\think\Session::set('data',$data);
						return $this->redirect('student_repwd_mail',302);
						
					}else{
						$this->error('用户不存在，请检查你的账号。');
					}

				}else{
					$this->error('输入格式有误！请重新输入');
				}
			}else{
				$this->error('验证码不正确！');
			}
		}
		return $this->fetch();
	}
	/**
	 * 学生找回密码验证
	 */
	public function student_repwd_mail(){
		$data = unserialize(\think\Session::get('data'));
		if(request()->isPost()){
			$captcha = input('captcha');
			if(captcha_check($captcha)){
				\think\Session::delete('data');
				$url = 'http://222.24.63.98/index/repassword/do_repassword/s_num/' . $data['s_num'] . 'html';
				$time = date("Y-m-d H:i:s",strtotime("+10 minute"));
				$year = date("Y");
				$title = "【计算机学院】找回您的账户密码";//邮件标题
				$message = "<html>亲爱的{$data['name']}：您好！<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您收到这封这封电子邮件是因为您申请了一个新的选课系统登录密码。假如这不是您本人所申请, 请不用理会这封电子邮件, 但是如果您持续收到这类的信件骚扰, 请您尽快联络管理员。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;要使用新的密码, 请使用以下链接启用密码。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<url>{$url}</url><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(如果无法点击该URL链接地址，请将它复制并粘帖到“您申请忘记密码功能的浏览器”的地址输入框，然后单击回车即可。)<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意:请您在收到邮件10分钟内({$time}前)使用，否则该链接将会失效。<br><br>
				<center>{$year}  &copy;  西安邮电大学计算机学院</center></html>";//邮件内容
				$address = $data['s_mail'];//收件人
				//$result = SendEmail::SendEmail($title,$message,$address);
				$result = true;
				$info = [
					's_num' => $data['s_num'],
					'url' => $url,
					'create_time' => $time
				];
				$insertinfo = \think\Db::name("repassword")->insert($info,$replace = true);
				if($result){
					//发送成功的处理逻辑
					$this->success('您的申请已提交成功，请查看您的邮箱。','Index/index');
				}else{
					//发送失败的处理逻辑
					$this->error('申请失败，请检查您的邮箱地址。','index/index');
				}
			}else{
				$this->error('验证码不正确！','student_repwd');
			}
		}else{
			$mail = substr($data['s_mail'],0,4) . '***'. substr($data['s_mail'],strrpos($data['s_mail'],"@"));
			$this->assign('mail',$mail);
			return $this->fetch();
		}	
	}
	//忘记密码，修改密码动作
	public function do_repassword(){
		$s_num = input('s_num');
		echo $s_num;die;
		$data = \think\Db::name("repassword")->where('s_num',$s_num)->find();
	}
}
