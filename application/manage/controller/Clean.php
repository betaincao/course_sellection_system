<?php
namespace app\manage\controller;
use think\Controller;
use think\Cache;
class Clean extends Base{
    public function index(){
        //var_dump( TEMP_PATH );exit;
        Cache::clear();
        //chmod( TEMP_PATH ,0777);
        array_map( 'unlink', glob( TEMP_PATH.DS.'.php' ) );   
        return $this->success('清理成功，正在跳转！','Index/home');
    }
}