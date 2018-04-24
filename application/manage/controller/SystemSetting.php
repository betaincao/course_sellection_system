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
        $name = db('admin')->where('id',$id)->find();
        if($name['name'] === session('a_name'))
        {
            $this->assign('name',$name);
            return $this->fetch();
        }else{
            $this->error("您只能修改您自己的密码！");
        }
        
    }
    public function change_pwd_action(){
        if(request()->isPost()){
            $pwd = md5(input('pwd'));
            $pwd2 = md5(input('pwd2'));
            if($pwd==$pwd2){
                $id = session('a_id');
                $db= \think\Db::name('admin')->where('id',$id)->update(['password' => $pwd]);
                if($db){
                    $this->success('修改成功,系统将退出，请重新登录。','index/login/logout');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('两次输入不一样，请返回重试');
            }
            
        }
    }
    /**
     * 选课时间展示
     */
    public function chooseTimeLst(){
        $result = \think\Db::name('choose_time')->order("id desc")->find();
        $data = array();
        $data = [
            'id' => $result['id'],
            'begin_time' => date('Y-m-d H:i:s',$result['begin_time']),
            'end_time' => date('Y-m-d H:i:s',$result['end_time']),
        ];
        $this->assign('data',$data);
        return $this->fetch();
    }
    /**
     * 设置选课时间
     */
    public function setChooseTime(){
        if(request()->isPost()){
            $beginTime = strtotime(input('beginTime'));//开始时间的时间戳
            $endTime = strtotime(input('endTime'));//结束时间的时间戳
            $data = [
                'begin_time' => $beginTime,
                'end_time' => $endTime
            ];
            $result = \think\Db::name('choose_time')->insert($data);
            if($result){
                $this->success('设置时间成功！','chooseTimeLst');
            }else{
                $this->error('设置时间失败');
            }
        }
        return $this->fetch();
    }
}