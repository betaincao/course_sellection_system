<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class Student extends Base{
    //学生信息展示
    public function lst(){
        $student = \think\Db::table('system_student')->order('s_grade asc')->select();
        $length = count($student);
        $this->assign('sum',$length);
        $this->assign('student',$student);
        return $this->fetch();
        //return json_encode($course);
    }
    //新增学生信息
    public function add(){
        if(request()->isPost()){
            $data=[
                's_num' =>input('s_num'),
                'name' =>input('name'),
                's_major' =>input('s_major'),
                's_grade' =>input('s_grade'),
                's_class' =>input('s_class'),
                's_sex' =>input('s_sex'),
                's_age' =>input('s_age'),
                's_mail' =>input('s_mail'),
                'password' =>md5(111111),
            ];
            $validate = \think\Loader::validate('student');
            if($validate->check($data)){
                $db= \think\Db::name('student')->insert($data);
                if($db){
                    return $this->success('添加信息成功！','lst');
                }else{
                    return $this->error('添加信息失败！');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        
        return $this->fetch();
    }
    //修改信息

    public function edit(){
        if(request()->isPost()){
            $data=[
                's_num' =>input('s_num'),
                'name' =>input('name'),
                's_major' =>input('s_major'),
                's_grade' =>md5('s_grade'),
                's_class' =>input('s_class'),
                's_sex' =>input('s_sex'),
                's_age' =>input('s_age'),
                's_mail' =>input('s_mail'),
            ];
            $validate = \think\Loader::validate('student');
            if($validate->scene('edit')->check($data)){
                $db= \think\Db::name('student')->update($data);
                if($db){
                    return $this->success('修改信息成功！','lst');
                }else{
                    return $this->error('修改信息失败！您没有修改信息！请返回重试！');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        $s_num = input('s_num');
        $student = db('student')->where('s_num',$s_num)->find();
        $this->assign('student',$student);
        return $this->fetch();
    }
    //删除学生信息
    public function del(){   
        $s_num=input('s_num');
        //dump($data);die();
    	if(db('student')->delete($s_num)){
    		return $this->success('删除信息成功！','lst');
    	}else{
    		return $this->error('删除信息失败！');
        }
    }
    //通过学号查找学生信息
    public function searchbynum(){
        if(request()->isPost()){
            // 把查询条件传入查询方法
            $s_num = input('s_num');
            //dump($data);die();
            $student = db('student')->where('s_num',$s_num)->select();
            if($student){
                $this->assign('student',$student);
                return $this->fetch('searchlstnum');
            }else{
                return $this->error('查询失败，暂无此数据，请返回查证后重试！');
            }

        }
        return $this->fetch();
    }
    //查看班级学生信息
    public function searchbyclass(){
        if(request()->isPost()){
            // 把查询条件传入查询方法
            $s_class = input('s_class');
            // echo $s_major;
            // echo $s_class;
            // die();
            $student = db('student')->where('s_class|s_major','like',$s_class)->select();
            if($student){
                $this->assign('student',$student);
                return $this->fetch('searchlstnum');
            }else{
                return $this->error('查询失败，暂无此数据，请返回查证后重试！');
            }

        }
        return $this->fetch();
    }
}