<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
    /**
     * 指定代课教师
     */
class Appoint extends Base{

    public function index(){
        $department = \think\Db::name('teacher')->field('t_department')->order('t_num')->group('t_department')->select();
        foreach($department as $value){
            $info[$value['t_department']] = \think\Db::name('teacher')->field('name')->where('t_department',$value['t_department'])->select();
        }
        //print_r($info);die;
        $this->assign('info',$info);
        return $this->fetch();
    }



    public function appoint(){
        if(request()->isPost()){
            $c_id = input('c_id');
            $department = input('province');
            $name = input('city');
            $teacherinfo = \think\Db::name('teacher')->field('t_num')->where('t_department',$department)->where('name',$name)->find();
            $data = [
                'id'=>$c_id,
                't_num'=>$teacherinfo['t_num'],
            ];
                $res = \think\Db::table('system_ct')->insert($data,$replace=true);
                $this->success('成功','choose/index');
                // $course = \think\Db::table('system_course')->field('c_name')->where('c_id',$c_id)->find();
                // $teacher = \think\Db::table('system_teacher')->field('name')->where('t_num',$t_num)->find();
                // $this->assign('course',$course);
                // $this->assign('course',$course);
                // return $this->fetch('ctlist');
        }
        return $this->fetch(); 
    }
    
}