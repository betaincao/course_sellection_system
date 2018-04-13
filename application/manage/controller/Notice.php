<?php
namespace app\manage\controller;
use think\Controller;
class Notice extends Base{
    public function lst(){
        $notice = \think\Db::table('system_notice')->order('n_time desc')->select();
        $this->assign('notice',$notice);
        return $this->fetch();
    }
    public function add(){
        if(request()->isPost()){
            $data=[
                'n_time' =>date("Y-m-d H:i:s",time()),
                'n_title' =>input('n_title'),
                'n_content' =>input('n_content'),
            ];
            $db= \think\Db::name('notice')->insert($data);
            if($db){
                return $this->success('添加信息成功！','lst');
            }else{
                return $this->error('添加信息失败！');
            }
            return;
        }
        
        return $this->fetch();
    }
    public function del(){   
        $n_time=input('n_time');
        //dump($data);die();
    	if(db('notice')->delete($n_time)){
    		return $this->success('删除成功！','lst');
    	}else{
    		return $this->error('删除失败！');
        }
    }
}