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
        $c_id = array();
        $t_num = array();
        foreach($course as $key=>$value){
            $c_id[] = $value['id'];
            $t_num[] = $value['t_num'];
        }
        $courseName = \think\Db::name('course')->field('c_grade,c_major,c_num,c_name')->where('c_id','in',$c_id)->select();
        $teacherName = \think\Db::name('teacher')->field('t_num,name')->where('t_num','in',$t_num)->select();
        var_dump($courseName);
        //var_dump($teacherName);die;
    }
}