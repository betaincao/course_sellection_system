<?php
/**
 * 
 */
namespace app\index\controller;
use think\Controller;
class Notice extends Important{
    /**
     * 学生页面看到的通知，只显示数据库中最新的一条
     */
    public function index(){
        $notice = \think\Db::table('system_notice')->order('n_time desc')->find();
        //var_dump($notice);die;
        $this->assign('notice',$notice);
        $this->assign('empty','<span class="empty"><h4><br>暂无数据。</h4></span>');
        return $this->fetch();
    }
}