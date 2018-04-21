<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
    /**
     * 指定代课教师
     */
class Appoint extends Base{
    public function index(){
        if(request()->isPost()){
            $c_id = input('c_id');
            $t_num = input('t_num');
            $data = [
                'id'=>$c_id,
                't_num'=>$t_num,
            ];
            if(\think\Db::table('system_teacher')->where('t_num',$t_num)->find()){
                $res = \think\Db::table('system_ct')->insert($data,$replace=true);
                $this->success('成功','choose/index');
                // $course = \think\Db::table('system_course')->field('c_name')->where('c_id',$c_id)->find();
                // $teacher = \think\Db::table('system_teacher')->field('name')->where('t_num',$t_num)->find();
                // $this->assign('course',$course);
                // $this->assign('course',$course);
                // return $this->fetch('ctlist');
            }else{
                $this->error('您输入的教工号不正确，请返回重新输入');
            }
        }
        return $this->fetch(); 
    }
    
}