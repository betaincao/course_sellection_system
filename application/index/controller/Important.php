<?php
/**
 * 非常重要，所有的登陆都是这里判断
 * 用于判断登陆
 */
namespace app\index\controller;
use think\Controller;
class Important extends Controller
{
    public function _initialize()
    {
        if(!session('id')){
             $this->error('请先登录系统！',url('Index/index'));
        }
    }
}
