<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
//培养计划控制器
class Plan extends Base{
    //展示培养方案
    public function lst(){
        $plan = \think\Db::table('system_plan')->order('p_id desc')->select();
        $this->assign('plan',$plan);
        return $this->fetch();
    }
    //添加培养计划方法:文件上传
    public function add(){
        //文件上传
        $file = request()->file('p_path');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->validate(['ext'=>'pdf'])->rule('uniqid')->move('uploads');
            // 成功上传后 获取上传信息
            if($info){
            //原文件名，用于命名本培养计划，对应数据库p_name字段
            $filename = $file->getInfo()['name'];
            // 文件上传的路径，即：存在本地的目录下的文件名
            $p_path = $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if(request()->isPost()){
            $data=[
                'p_id' => input('p_id'),
                //上传的文件的名字为专业+年级+文件名
                'p_name' =>input('p_major') . input('p_grade') . trim($filename,'.pdf'),
                'p_path' => $p_path,
                'p_major' =>input('p_major'),
                'p_grade' =>input('p_grade'),
            ];
            $validate = \think\Loader::validate('Plan');
            if($validate->check($data)){
                $db= \think\Db::name('plan')->insert($data);
                if($db){
                    return $this->success('添加培养计划成功！','lst');
                }else{
                    return $this->error('添加培养计划失败！');
                }
            }else{
    			return $this->error($validate->getError());
    		}
    		return;
        }
        
        return $this->fetch();
    }
    //删除某个培养计划的方法
    public function del(){   
        $p_id=input('p_id');
    	if(db('plan')->delete($p_id)){
    		return $this->success('删除培养计划成功！','lst');
    	}else{
    		return $this->error('删除培养计划失败！');
        }
    }
}