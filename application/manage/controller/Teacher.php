<?php
namespace app\manage\controller;
use think\Controller;
class Teacher extends Base{
    //展示数据库中教师的信息
    public function lst(){
        $teacher = \think\Db::table('system_teacher')->order('t_num desc')->select();
        //dump($course);die();
        $this->assign('teacher',$teacher);
        return $this->fetch();
        //return json_encode($course);
    }
    //新增教师信息
    public function add(){
        if(request()->isPost()){
            $data=[
                't_num' =>input('t_num'),
                'name' =>input('name'),
                't_department' =>input('t_department'),
                'password' =>md5('111111'),
                't_sex' =>input('t_sex'),
            ];
            $validate = \think\Loader::validate('teacher');
            if($validate->check($data)){
                $db= \think\Db::name('teacher')->insert($data);
                if($db){
                    return $this->success('添加教师信息成功！','lst');
                }else{
                    return $this->error('添加教师信息失败！');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        
        return $this->fetch();
    }
    public function edit(){
        if(request()->isPost()){
            $data=[
                't_num' =>input('t_num'),
                'name' =>input('name'),
                't_department' =>input('t_department'),
                'password' =>md5('111111'),
                't_sex' =>input('t_sex'),
            ];
            $validate = \think\Loader::validate('teacher');
            if($validate->scene('edit')->check($data)){
                $db= \think\Db::name('teacher')->update($data);
                if($db){
                    return $this->success('修改教师信息成功！','lst');
                }else{
                    return $this->error('修改教师信息失败！您没有修改信息！请返回重试！');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        $t_num = input('t_num');
        $teacher = db('teacher')->where('t_num',$t_num)->find();
        $this->assign('teacher',$teacher);
        return $this->fetch();
    }
    //删除教师信息
    public function del(){   
        $t_num=input('t_num');
        //dump($data);die();
    	if(db('teacher')->delete($t_num)){
    		return $this->success('删除教师信息成功！','lst');
    	}else{
    		return $this->error('删除教师信息失败！');
        }
    }
}