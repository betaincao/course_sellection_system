<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class SystemSetting extends Base{
    public function lst(){
        return $this->fetch();
    }
    public function admin_lst(){
        $admin = \think\Db::table('system_admin')->order('id desc')->select();
        //dump($admin);die();
        $this->assign('admin',$admin);
        return $this->fetch();
    }
    public function change_pwd(){
        $id = input('id');
        //$name = db('admin')->where('id',$id)->field('username')->find();
        $name = db('admin')->where('id',$id)->find();
        //var_dump(session('name'));
        if($name['name'] === session('a_name'))
        {
            $this->assign('name',$name);
            return $this->fetch();
        }else{
            $this->error("您只能修改您自己的密码！");
        }
        
    }
    public function setChooseTime(){
        return $this->fetch();
    }
}