<?php
namespace app\manage\controller;
use think\Controller;
use app\manage\model\Login as Log;
class Index extends Controller{
    public function index(){
        // $linkres= \think\Db::name('link')->paginate(3);
    	// $this->assign('linkres',$linkres);
        if(request()->isPost()){
            $login=new Log;
            $status=$login->login(input('username'),input('password'));
            if($status==1){
                return $this->success('登录成功，正在跳转！','Index/home');
            }elseif($status==2){
                return $this->error('账号或者密码错误!');
            }else{
                 return $this->error('用户不存在!');
            }
        }
        return $this->fetch();
    }
    public function home(){
        return $this->fetch();
    }
    public function logout(){
        session(null);
        return $this->success('退出成功！',url('index'));
    }


    













}
