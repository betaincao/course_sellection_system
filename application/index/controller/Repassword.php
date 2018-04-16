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
	 * 找回密码
	 */
	public function repassword(){
		$type = input('type');
		if(request()->isPost()){
			$num = input('num');
			$captcha = input('captcha');
			if(captcha_check($captcha)){
				if(isset($num)){
					switch($type){
					case 1:
					//学生忘记密码
						$data = \think\Db::name("student")->field('s_num,name,s_mail')->where('s_num',$num)->find();
						if($data){
							if(empty($data['s_mail'])){
								$this->success('您没有修改过密码，请使用初始密码登录','index/index');
							}else{
								$data = serialize($data);
								\think\Session::set('data',$data);
								return $this->redirect('repassword_mail',['type' => 1],302);
							}
						}else{
							$this->error('用户不存在，请检查你的账号。');
						}
						break;
					case 2:
					//教师忘记密码
					$data1 = \think\Db::name("teacher")->field('t_num,name,t_mail')->where('t_num',$num)->find();
					if($data1){
						$data = [
							's_num' => $data1['t_num'],
							'name' =>$data1['name'],
							's_mail' =>$data1['t_mail']
						];
						if(empty($data['s_mail'])){
							$this->success('您没有修改过密码，请使用初始密码登录','index/index');
						}else{
							$data = serialize($data);
							\think\Session::set('data',$data);
							return $this->redirect('repassword_mail',['type' => 2],302);
						}
					}else{
						$this->error('用户不存在，请检查你的账号。');
					}
					break;
					default:
						$this->error('出错啦');
					}
				}else{
					$this->error('输入格式有误！请重新输入');
				}
			}else{
				$this->error('验证码不正确！');
			}
		}else{
			return $this->fetch();
		}

	}
	/**
	 * 生成随机token
	 */
	function genToken( $len = 32, $md5 = true ) {  
		# Seed random number generator  
		   # Only needed for PHP versions prior to 4.2  
		   mt_srand( (double)microtime()*1000000 );  
		   # Array of characters, adjust as desired  
		   $chars = array(  
			   'Q', '@', '8', 'y', '%', '^', '5', 'Z', '(', 'G', '_', 'O', '`',  
			   'S', '-', 'N', '<', 'D', '{', '}', '[', ']', 'h', ';', 'W', '.',  
			   '/', '|', ':', '1', 'E', 'L', '4', '&', '6', '7', '#', '9', 'a',  
			   'A', 'b', 'B', '~', 'C', 'd', '>', 'e', '2', 'f', 'P', 'g', ')',  
			   '?', 'H', 'i', 'X', 'U', 'J', 'k', 'r', 'l', '3', 't', 'M', 'n',  
			   '=', 'o', '+', 'p', 'F', 'q', '!', 'K', 'R', 's', 'c', 'm', 'T',  
			   'v', 'j', 'u', 'V', 'w', ',', 'x', 'I', '$', 'Y', 'z', '*'  
		   );  
		   # Array indice friendly number of chars;  
		   $numChars = count($chars) - 1; $token = '';  
		   # Create random token at the specified length  
		   for ( $i=0; $i<$len; $i++ )  
			   $token .= $chars[ mt_rand(0, $numChars) ];  
		   # Should token be run through md5?  
		   if ( $md5 ) {  
			   # Number of 32 char chunks  
			   $chunks = ceil( strlen($token) / 32 ); $md5token = '';  
			   # Run each chunk through md5  
			   for ( $i=1; $i<=$chunks; $i++ )  
				   $md5token .= md5( substr($token, $i * 32 - 32, 32) );  
			   # Trim the token  
			   $token = substr($md5token, 0, $len);  
		   } return $token;  
	   }  
	/**
	 * 学生找回密码验证
	 */
	public function repassword_mail(){
		$data = unserialize(\think\Session::get('data'));
		$type = input('type');
		if(request()->isPost()){
			$captcha = input('captcha');
			if(captcha_check($captcha)){
				\think\Session::delete('data');
				$token = $this->genToken();
				$url = 'http://222.24.63.98/index/repassword/do_repassword?token=' . $token . '&num=' . $data['s_num'] . '&client_ip='. $_SERVER['REMOTE_ADDR'];
				$t = time()+600;//时间戳，判断过期
				$time = date("Y-m-d H:i:s",strtotime("+10 minute"));
				$year = date("Y");
				$title = "【计算机学院】找回您的账户密码";//邮件标题
				$message = "<html>亲爱的{$data['name']}：您好！<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您收到这封这封电子邮件是因为您申请了一个新的选课系统登录密码。假如这不是您本人所申请, 请不用理会这封电子邮件, 但是如果您持续收到这类的信件骚扰, 请您尽快联络管理员。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;要使用新的密码, 请使用以下链接启用密码。<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='{$url}'>{$url}</a><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(如果无法点击该URL链接地址，请将它复制并粘帖到“您申请忘记密码功能的浏览器”的地址输入框，然后单击回车即可。)<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意:请您在收到邮件10分钟内({$time}前)使用，否则该链接将会失效。<br><br>
				<center>{$year}  &copy;  西安邮电大学计算机学院</center></html>";//邮件内容
				$address = $data['s_mail'];//收件人
				$result = SendEmail::SendEmail($title,$message,$address);
				$info = [
					's_num' => $data['s_num'],
					'token' => $token,
					'client_ip' => $_SERVER['REMOTE_ADDR'],
					'type' => $type,
					'create_time' => $t
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
			$token = input('token');
			$s_num = input('num');
			$client_ip = $_SERVER['REMOTE_ADDR'];
			if(isset($token)&&isset($s_num)&&isset($client_ip)){
				$data = \think\Db::name("repassword")->where('s_num',$s_num)->where('token',$token)->find();
				if($client_ip = $data['client_ip']){
					$time_now = time();
					if($time_now<=$data['create_time']){
						// xiugaimima
						if(request()->isPost()){
							$pwd = md5(input('newPassword'));
							$captcha = input('captcha');
							if(captcha_check($captcha)){
								switch($data['type']){
									case 1:
									$result = \think\Db::name("student")->where('s_num',$data['s_num'])->update(['password' => $pwd]);
									break;
									case 2:
									$result = \think\Db::name("teacher")->where('t_num',$data['s_num'])->update(['password' => $pwd]);
									break;
									default:
									$this->error('出错啦');
								}
								
								if($result){
									return $this->success('修改密码成功,请使用您刚修改的密码登录系统','index/index');
								}else{
									return $this->error('当前输入密码与您的之前的密码相同，无需修改','index/index');
								}
							}else{
								$this->error('验证码不正确');
							}
						}else{
							return $this->fetch();
						}
					}else{
					$this->error('链接已过期','index/index');
					}
				}else{
					$this->error('请使用您申请忘记密码时的网络及浏览器重试');
				}
			}else{
				$this->error('error');
			}
	}
}
