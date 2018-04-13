<?php
namespace app\manage\controller;
use think\Controller;
use app\manage\model\CreateTable as log;
class Major extends Base{
    public function lst(){
        $major = \think\Db::table('system_major')->order('m_id desc')->select(); 
        $this->assign('major',$major);
        return $this->fetch();     
    }
    public function add(){
        if(request()->isPost()){
            $majorName = input('majorname');
            $majorGrade =input('major_grade');
            $data=[
                'major_name' => $majorName,
                'major_grade' => $majorGrade,
            ];
            $db = \think\Db::name('major')->where('major_name',$majorName)->where('major_grade',$majorGrade)->find();
            if($db){
                return $this->error('当前专业年级已存在！');
            }else{
                $tablename = \think\Db::name('major')->insertGetId($data);
                if($tablename){
                    $create = new log;
                    $result=$create -> create_table($tablename);
                    if($result){
                        $this->error("$result");
                    }
                    return $this->success('添加成功！','lst');
                }else{
                    return $this->error('添加失败！');
                }
            }
        }
        
        return $this->fetch();
    }
    public function del(){
        $m_id=input('m_id');
        //dump($data);die();
    	if(db('major')->delete($m_id)){
    		return $this->success('删除专业年级成功！','lst');
    	}else{
    		return $this->error('删除专业年级失败！');
        }
    }
}