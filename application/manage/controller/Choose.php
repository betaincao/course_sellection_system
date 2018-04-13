<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class Choose extends Base{
    public function index(){
        return $this->fetch();
    }
    public function check(){
        if(request()->isPost()){
            $c_num = input('c_id');
            $course = \think\Db::table('system_course')->where('c_num',$c_num)->select();
            if($course){
            $this->assign('course',$course);
            return $this->fetch();
            }else{
                $this->error('未找到该课程');
            }
        }else{
            $this->error('请输入课程编号');
        }
    }
    //展示
    public function studentlst(){
        $major = input('c_major');
        $grade = input('c_grade');
        $c_id = input('c_id');
        $c_name = input('name');
        $tableId = array();
        $s_num = array();
        $tableId = \think\Db::table('system_major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
        $s_num = \think\Db::table('system_' . $tableId['m_id'] . '_course')->field('s_num')->where('c_id',$c_id)->where('status',1)->order('s_num desc')->select();
        $data = array();
        foreach($s_num as $value){
            $data[] = $value['s_num'];
        }
        $length = count($s_num);
        $studentinfo = \think\Db::table('system_student')->where('s_num','in',$data)->field('s_num,name,s_class')->select();
        if($studentinfo){
            $data['major'] = $major;
            $data['grade'] = $grade;
            $data['c_name'] = $c_name;
            $data['length'] = $length;
            var_dump($data);die;
            $this->assign('data',$data);
            $this->assign('studentinfo',$studentinfo);
            return $this->fetch();
        }else{
            $this->error('没有学生选择这门课');
        }
    }
}