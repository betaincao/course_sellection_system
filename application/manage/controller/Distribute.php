<?php
/**
 * 课程分配的控制器
 * 用于解决几选几的问题
 */
namespace app\manage\controller;
use think\Controller;
use app\manage\model\Distribute as log;
class Distribute extends Base{
    public function index(){
        $majorName = \think\Db::name('major')->group('major_name')->select();
        $majorGrade = \think\Db::name('major')->group('major_grade')->order('major_grade','desc')->select();
        $this->assign('majorGrade',$majorGrade);
        $this->assign('majorName',$majorName);
        if(request()->isPost()){
            $major = input('major');
            $grade = input('grade');
            /**
             * 判断当前是第几学期
             */
            $now = date("Y");//当前年
            $month = (int)date("m");//当前月份
            if($month==1||$month==2||$month==9||$month==10||$month==11||$month==12){
                $semester = 2*($now-$grade);
            }else{
                $semester = 2*($now-$grade)+1;
            }
            $course = \think\Db::name('course')->where('c_major',$major)->where('c_grade',$grade)->where('c_semester',$semester)->select();

            if(!empty($course)){
                $this->assign('major',$major);
                $this->assign('grade',$grade);
                $this->assign('semester',$semester);
                $this->assign('course',$course);
                return $this->fetch('course');
            }
            else{
                $this->error("当前学期没有可选的课！请返回添加课程！","course/add");
            }
            //getlang();
            
        }

        return $this->fetch();
    }
    public function insertdata(){
        if(request()->isPost()){
            $lang = (int)input('lang');
            $major = input('c_major');
            $grade = input('c_grade');
            $c_id = input('c_id/a');
            $now = date("Y");//当前年
            $month = (int)date("m");//当前月份
            if($month==1||$month==2||$month==9||$month==10||$month==11||$month==12){
                $semester = 2*($now-$grade);
            }else{
                $semester = 2*($now-$grade)+1;
            }
            $student = \think\Db::name('student')->field('s_num')->where('s_major',$major)->where('s_grade',$grade)->select();
            $major = \think\Db::name('major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->find();
            $m_id = $major['m_id'];
            $length1 = count($student);
            $length2 = count($c_id);
            for($i=0;$i<$length2;$i++){
                for($j = 0;$j<$length1;$j++){
                    $data2 = [
                        'id'          =>$student[$j]['s_num'] . $c_id[$i],
                        's_num'       =>$student["$j"]['s_num'],
                        'c_id'        =>$c_id["$i"],
                        'lang'        =>("("."$length2".","."$lang".")"),
                        'all'         =>0,
                        'status'      =>0,
                        'semester'    =>$semester,
                        'create_time' =>date("Y-m-d"),
                    ];
                    $db= \think\Db::name("$m_id" .  "_course")->where('id',$student[$j]['s_num'] . $c_id[$i])->find();
                    if($db){

                    }else{
                        $db= \think\Db::name("$m_id" .  "_course")->insert($data2,$replace=true);
                    }
                }
            }
            echo "<script> alert('分配成功');history.go(-2)</script>";
        }
    }
    /**
     * 整班选课
     */
    public function allchoose(){

        $c_id=input('c_id');
        $course = \think\Db::name('course')->field('c_grade,c_major,c_semester')->where('c_id',$c_id)->find();
        $student = \think\Db::name('student')->field('s_num')->where('s_major',$course['c_major'])->where('s_grade',$course['c_grade'])->select();
        $m_id = \think\Db::name('major')->field('m_id')->where('major_name',$course['c_major'])->where('major_grade',$course['c_grade'])->find();
        $length = count($student);
        for($i=0;$i<$length;$i++){
            $data = [
                'id'          =>$student[$i]['s_num'] . $c_id,
                's_num'       =>$student["$i"]['s_num'],
                'c_id'        =>$c_id,
                'lang'        =>'',
                'all'         =>1,
                'status'      =>1,
                'semester'    =>$course['c_semester'],
                'create_time' =>date("Y-m-d"),
            ];
            $db= \think\Db::name($m_id['m_id'] .  "_course")->insert($data,$replace=true);
        }
        $this->success("分配成功！","distribute/index");
    }
}