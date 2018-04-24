<?php
namespace app\manage\controller;
use think\Controller;
use app\manage\model\CreateTable as log;
class Major extends Base{
    public function lst(){
        $major = \think\Db::table('system_major')->order('m_id desc')->paginate(15);
        $page = $major->render();
        $this->assign('page',$page); 
        $this->assign('major',$major);
        return $this->fetch();     
    }
}