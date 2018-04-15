<?php
/**
 * login controller
 * created by caoyouming, 2018-02-08
 */
namespace app\index\controller;
use think\Controller;
use app\index\model\Login as Log;
class Login extends Controller{
    public function student(){
        /**
         * student class
         * created by caoyouming, 2018-02-08
         * @param $identity : 用户的身份，对应查询哪个数据库
         * @param $field : 查询unshujuku时使用是的字段名
         */
        $student=$_POST['student'];
        $password=$_POST['password'];
        $captcha=$_POST['captcha'];
        if(captcha_check($captcha)){
            if(!empty($student)){
                $login=new Log;
                $status=$login->studentLoginModel($student,$password);  
                if($status==1){
                    //return $this->success('登录成功，正在跳转！','/index/studentcourse/lst');
                    $this->redirect('/index/studentcourse/lst');
                }elseif($status==2){
                    return $this->error('账号或者密码错误!');
                }else{
                     return $this->error('用户不存在!');
                } 
            }else{
                $this->error('输入格式有误！请重新输入');
            }
        }else{
            $this->error('验证码不正确！');
        }
   }
    public function teacher(){
        /**
         * teacher login class
         * created by caoyouming, 2018-02-08
         */
        $teacher=$_POST['teacher'];
        $password=$_POST['password'];
        $captcha=$_POST['captcha'];
        if(captcha_check($captcha)){
            if(!empty($teacher)){
                $login=new Log;
                $status=$login->teacherLoginModel($teacher,$password);  
                if($status==1){
                    return $this->redirect('/index/Teacher/teaching');
                }elseif($status==2){
                    return $this->error('账号或者密码错误!');
                }else{
                    return $this->error('用户不存在!');
                } 
            }else{
                $this->error('输入格式有误！请重新输入');
            }
        }else{
            $this->error('验证码不正确！');
        }
    }
    public function admin(){
        /**
         * admin login class
         * created by caoyouming, 2018-02-08
         */
        $admin = $_POST['admin'];
        $password = $_POST['password'];
        $captcha = $_POST['captcha'];
        if(captcha_check($captcha)){
            if(!empty($admin)){
                $login=new Log;
                $status=$login->adminLoginModel($admin,$password);  
                if($status==1){
                    return $this->redirect('manage/index/home');
                }elseif($status==2){
                    return $this->error('账号或者密码错误!');
                }else{
                    return $this->error('用户不存在!');
                } 
            }else{
                $this->error('输入格式有误！请重新输入');
            }
        }else{
            $this->error('验证码不正确！');
        }
    }
      
   public function logout(){
        /**
         * logout class
         * created by caoyouming, 2018-02-08
         */
            session(null);
            $this->redirect('index/index');
       }


    













}
