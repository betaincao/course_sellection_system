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
    /**
     *导出给教务系统
     */
    public function exportCTlst(){
        if(request()->isPost()){
            $major = input('major');
            $grade = input('grade');
            $majorArray = \think\Db::name('major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
            $m_id = $majorArray['m_id'];
            $now = date("Y");//当前年
            $month = (int)date("m");//当前月份
            if($month==1||$month==2||$month==9||$month==10||$month==11||$month==12){
                $semester = 2*($now-$grade);
            }else{
                $semester = 2*($now-$grade)+1;
            }

            $info = \think\Db::name("$m_id" .  "_course")->field('s_num,c_id')->where('semester',$semester)->where('status',1)->select();
            foreach($info as $key=>$value){
                $course[] = \think\Db::table('system_course')->field('c_id,c_num')->where('c_id',$value['c_id'])->find();
            }
            $data = array(array());
            for($i=0;$i<count($info);$i++){
                $data[] = [
                    's_num' => $info[$i]['s_num'],
                    'c_num' => $course[$i]['c_num']
                ];
            }
            //$student = \think\Db::table('system_student')->field('s_num,name,s_class,s_sex,s_age,s_mail')->where('s_major',$major)->where('s_grade',$grade)->select();
            array_shift($data);
            require PUBLIC_PATH . '/tools/phpexcel/exportCTlst.php';
            $now = date("Y");//当前年
            $month = (int)date("m");//当前月份
            if($month==1||$month==2||$month==9||$month==10||$month==11||$month==12){
                $year = $now .'-'.($now+1).'-2';
            }else{
                $year = $now .'-'.($now+1).'-1';
            }
            $name = $grade . $major . '选课信息';
            export($data,$name,$year);
        }
        return $this->fetch();
    }
}