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
            $grade = input('c_grade');
            $major = input('c_major');
            $now = date("Y");//当前年
            $month = (int)date("m");//当前月份
            if($month==1||$month==2||$month==9||$month==10||$month==11||$month==12){
                $semester = 2*($now-$grade);
            }else{
                $semester = 2*($now-$grade)+1;
            }
            $course = \think\Db::name('course')->where('c_major',$major)->where('c_grade',$grade)->where('c_semester',$semester)->select();
            $student = \think\Db::name('student')->field('s_num')->where('s_major',$major)->where('s_grade',$grade)->select();
            $major = \think\Db::name('major')->field('m_id')->where('major_name',$major)->where('major_grade',$grade)->select();
            $m_id = $major['0']['m_id'];
            $length1 = count($student);
            $length2 = count($course);
            for($i=0;$i<$length2;$i++){
                for($j = 0;$j<$length1;$j++){
                    $data2 = [
                        'id'          =>$student[$j]['s_num'] . $course[$i]['c_id'],
                        's_num'       =>$student["$j"]['s_num'],
                        'c_id'        =>$course["$i"]['c_id'],
                        'lang'        =>("("."$length2".","."$lang".")"),
                        'status'      =>0,
                        'create_time' =>date("Y-m-d"),
                    ];
                    $db= \think\Db::name("$m_id" .  "_course")->insert($data2,$replace=true);
                }
            }
            $this->success("分配成功！","distribute/index");
        }else{
            $this->error("请输入选课数量");
        }
    }
    /**
     * 整班选课
     */
    public function allchoose(){
        echo "已开发，未测试。暂未开通";
    }
}