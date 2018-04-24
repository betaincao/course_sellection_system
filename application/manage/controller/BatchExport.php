<?php
/**
*批量导出操作
*/
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class BatchExport extends Base{
    public function index(){
        return $this->fetch();
    }
    /**
     * 导出学生信息
     * 按照专业年级导出
     */
    public function exportByMajor(){
        if(request()->isPost()){
            $s_major = input('s_major');
            $s_grade = input('s_grade');
    		$student = \think\Db::table('system_student')->field('s_num,name,s_class,s_sex,s_age,s_mail')->where('s_major',$s_major)->where('s_grade',$s_grade)->select();
            require PUBLIC_PATH . '/tools/phpexcel/exportbymajor.php';
            $name = "$s_major" . "$s_grade" . '级学生名单';
            export($student,$name);
        }
        return $this->fetch();
    }
    /**
     * 按班级导出
     */
    public function exportByClass(){
        
        if(request()->isPost()){
            $s_class = input('s_class');
    		$student = \think\Db::table('system_student')->field('s_num,name,s_class,s_sex,s_age,s_mail')->where('s_class',$s_class)->select();
            require PUBLIC_PATH . '/tools/phpexcel/exportbymajor.php';
            $name = "$s_class" . '班学生名单';
            export($student,$name);
        }
        return $this->fetch();
    }
    public function exportCTlstform(){
        $majorName = \think\Db::name('major')->group('major_name')->select();
        $majorGrade = \think\Db::name('major')->group('major_grade')->order('major_grade','desc')->select();
        $this->assign('majorGrade',$majorGrade);
        $this->assign('majorName',$majorName);
        return $this->fetch();
    }
    public function exportCTlst(){
        if(request()->isPost()){
            $s_major = input('major');
            $s_grade = input('grade');
            $major = \think\Db::name('major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
            $m_id = $major['m_id'];
            //$db= \think\Db::name("$m_id" .  "_course")->where(,)->select();


            $student = \think\Db::table('system_student')->field('s_num,name,s_class,s_sex,s_age,s_mail')->where('s_major',$s_major)->where('s_grade',$s_grade)->select();
            




            require PUBLIC_PATH . '/tools/phpexcel/exportbymajor.php';
            $name = "$s_major" . "$s_grade" . '选课名单';
            export($student,$name);
        }
        return $this->fetch();
    }
}