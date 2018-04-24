<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class Choose extends Base{
    public function index(){
        $majorName = \think\Db::name('major')->group('major_name')->select();
        $majorGrade = \think\Db::name('major')->group('major_grade')->order('major_grade','desc')->select();
        $this->assign('majorGrade',$majorGrade);
        $this->assign('majorName',$majorName);
        return $this->fetch();
    }
    public function check(){
        if(request()->isPost()){
            $major = input('major');
            $grade = input('grade');
            $major = \think\Db::name('major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
            $m_id = $major['m_id'];
            $cidArray = array();
            $cidArray = \think\Db::name("$m_id" .  "_course")->field('c_id')->group('c_id')->select();
            if($cidArray){
                foreach($cidArray as $value){
                    foreach($value as $v){
                        $course[] = \think\Db::table('system_course')->where('c_id',$v)->find();
                    }
                }
                $this->assign('m_id',$m_id);
                $this->assign('course',$course);
                return $this->fetch();
            }else{
                $this->error("您还没有分配课程！");
            }
        }
    }
    //展示
    public function studentlst(){
        $m_id = input('m_id');
        $c_id = input('c_id');
        $c_name = input('name');
        $tableId = array();
        $s_num = array();
        $s_num = \think\Db::name( $m_id . '_course')->field('s_num')->where('c_id',$c_id)->where('status',1)->order('s_num desc')->select();
        $data = array();
        foreach($s_num as $value){
            $data[] = $value['s_num'];
        }
        $length = count($s_num);
        $studentinfo = \think\Db::table('system_student')->where('s_num','in',$data)->field('s_num,name,s_class')->order('s_class asc')->paginate(15);
        $page = $studentinfo->render();
        
        if($studentinfo){
            $this->assign('page',$page);
            $this->assign('studentinfo',$studentinfo);
            return $this->fetch();
        }else{
            $this->error('没有学生选择这门课');
        }
    }
}