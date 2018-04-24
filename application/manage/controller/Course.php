<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
/**
 * 课程管理
 */
class Course extends Base{
    /**
     * 课程展示
     */
    public function lst(){
        $course = \think\Db::table('system_course')->order('c_id desc')->paginate(15);
        $page = $course->render();
        $this->assign('page',$page);
        //dump($course);die();
        $this->assign('course',$course);
        return $this->fetch();
        //return json_encode($course);
    }
    /**
     * 新增课程
     */
    public function add(){
        //$major = \think\Db::name('major')->field('majorname')->groupby('majorname')->select();
        //var_dump($major);die;
        if(request()->isPost()){
            $data=[
                'c_num' =>input('c_num'),
                'c_major' =>input('c_major'),
                'c_grade' =>input('c_grade'),
                'c_name' =>input('c_name'),
                'c_check_address' =>input('c_check_address'),
                'c_score' =>input('c_score'),
                'c_all_time' =>input('c_all_time'),
                'c_theoretical_time' =>input('c_theoretical_time'),
                'c_test_hours' =>input('c_test_hours'),
                'c_semester' =>input('c_semester'),
                'c_week_time' =>input('c_week_time'),
                'c_remarks' =>input('c_remarks'),
            ];
            $validate = \think\Loader::validate('Course');
            if($validate->check($data)){
                $db= \think\Db::name('course')->insert($data);
                if($db){
                    return $this->success('添加课程成功！','lst');
                }else{
                    return $this->error('添加课程失败！');
                }
            }else{
    			return $this->error($validate->getError());
    		}
    		return;
        }
        
        return $this->fetch();
    }

    //修改课程信息
    public function edit(){
            if(request()->isPost()){
                $cid = input('id');
                $data = [
                    'c_id' =>input('id'),
                    'c_num' =>input('c_num'),
                    'c_major' =>input('c_major'),
                    'c_grade' =>input('c_grade'),
                    'c_name' =>input('c_name'),
                    'c_check_address' =>input('c_check_address'),
                    'c_score' =>input('c_score'),
                    'c_all_time' =>input('c_all_time'),
                    'c_theoretical_time' =>input('c_theoretical_time'),
                    'c_test_hours' =>input('c_test_hours'),
                    'c_semester' =>input('c_semester'),
                    'c_week_time' =>input('c_week_time'),
                    'c_remarks' =>input('c_remarks'),
                ];
                $validate = \think\Loader::validate('course');
                if($validate->scene('edit')->check($data)){
                    if($db=\think\Db::name('course')->update($data)){
                        return $this->success('修改课程信息成功！','lst');
                      
                    }else{
                        return $this->error('修改失败！');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        $c_id = input('c_id');
        $course = db('course')->where('c_id',$c_id)->find();
        $this->assign('course',$course);
        //dump($course);die();
        //$json=json_encode($course);
        //dump($json);die();
        return $this->fetch();
    }

    //删除课程
    public function del(){   
        $c_id=input('c_id');
        //dump($data);die();
    	if(db('course')->delete($c_id)){
    		return $this->success('删除课程成功！','lst');
    	}else{
    		return $this->error('删除课程失败！');
        }
    }
}