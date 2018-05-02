<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
/**
 * 查看课程与教师
 */
class Courseteacher extends Base{

    public function index(){
        $course = \think\Db::name('ct')->select();
        if($course){
            $c_id = array();
            $t_num = array();
            foreach($course as $key=>$value){
                // $data[]['course'] = \think\Db::name('course')->field('c_grade,c_major,c_num,c_name')->where('c_id',$value['id'])->find();
                // $data[]['teacher'] = \think\Db::name('teacher')->field('t_num,name')->where('t_num',$value['t_num'])->find();
                $data[]=[
                    'course' => \think\Db::name('course')->field('c_grade,c_major,c_num,c_name')->where('c_id',$value['id'])->find(),
                    'teacher' => \think\Db::name('teacher')->field('t_num,name')->where('t_num',$value['t_num'])->find(),
                ];
            }
            //print_r($data);die;
            $this->assign('data',$data);
            return $this->fetch();
        }else{
            $this->error('暂无数据');
        }
    }
        
}