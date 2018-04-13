<?php
/**
 * 学生信息
 */
namespace app\index\controller;
use think\Controller;
class Studentinfo extends Important{
    public function index(){
        $s_num = session('id');
        $data = \think\Db::name("student")->where('s_num',$s_num)->find();
        $this->assign('student',$data);
        return $this->fetch();
    }
    public function changemail(){
        if(request()->isPost()){
            $pwd = md5(input('password'));
            
            $mail = input('email');
            $s_num = session('id');
            $password = \think\Db::name("student")->field('password')->where('s_num',$s_num)->find();
            if($pwd == $password['password']){
                $db= \think\Db::name('student')->where('s_num',$s_num)->update(['s_mail' => $mail]);
                if($db){
                    $this->redirect('/index/studentinfo/index');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('您输入的密码不正确');
            }
        }
    }
    public function changepwd(){
        if(request()->isPost()){
            $pwd = md5(input('password'));
            $newPassword = md5(input('newPassword'));
            $s_num = session('id');
            $password = \think\Db::name("student")->field('password')->where('s_num',$s_num)->find();
            if($pwd == $password['password']){
                $db= \think\Db::name('student')->where('s_num',$s_num)->update(['password' => $newPassword]);
                if($db){
                    $this->success('修改成功,系统将退出，请重新登录。','login/logout');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('您输入的密码不正确');
            }
        }
    }
}