<?php
/**
 * 已经选择了的课程
 */
namespace app\index\controller;
use think\Controller;
class Studentcourse extends Important{
    public function lst(){
        $s_num = session('id');
        $data1= \think\Db::name("student")->where('s_num',$s_num)->find();
        $major = preg_replace('/\(.*?\)/', '', $data1['s_major']);
        $grade = $data1['s_grade'];
        $data2 = \think\Db::name('major')->field('m_id')->where('major_name','like',$major)->where('major_grade',$grade)->find();
        $m_id = $data2['m_id']; 
        $data3 = \think\Db::table("system_"."$m_id"."_course")->field('c_id')->where('s_num',$s_num)->where('status',1)->select();
        $length = count($data3);
        $c_id = array();  
        $c_id = array_map('array_shift', $data3);
        $data4 = \think\Db::name("course")->field('c_name,c_id')->where('c_id',"in",$c_id)->select();
        $this->assign('course',$data4);
        return $this->fetch();
    }
    public function details(){
        $c_id = input('c_id');
        $data = \think\Db::name("course")->where('c_id',$c_id)->find();
        $this->assign('course',$data);
        return $this->fetch();
    }
    public function remove(){
        $s_num = session('id');
        $data1= \think\Db::name("student")->where('s_num',$s_num)->find();
        $major = preg_replace('/\(.*?\)/', '', $data1['s_major']);
        $grade = $data1['s_grade'];
        $data2 = \think\Db::name('major')->field('m_id')->where('major_name','like',$major)->where('major_grade',$grade)->find();
        $m_id = $data2['m_id']; 
        $c_id = input('c_id');
        $id = $s_num . $c_id;
        $db=\think\Db::table("system_"."$m_id"."_course")->where('id',$id)->where('all','neq','1')->update(['status'=>0]);
        if($db){
            return $this->redirect('lst');
        }else{
            $this->error('该课程是限选课，不能退选','lst');
        }
    }
    public function history(){
        $s_num = session('id');
        $data1= \think\Db::name("student")->where('s_num',$s_num)->find();
        $major = preg_replace('/\(.*?\)/', '', $data1['s_major']);
        $grade = $data1['s_grade'];
        $data2 = \think\Db::table('system_major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
        $m_id = $data2['m_id']; 
        $data3 = \think\Db::table("system_"."$m_id"."_course")->field('c_id')->where('s_num',$s_num)->where('status',1)->select();
        $c_id = array();  
        $c_id = array_map('array_shift', $data3);
        //$data4 = \think\Db::name("course")->field('c_name,c_id')->where('c_id',"in",$c_id)->select();
        $data4 = \think\Db::name("course")->where('c_id',"in",$c_id)->select();
        //var_dump($data4);die;
        $this->assign('course',$data4);
        return $this->fetch();
    }
}