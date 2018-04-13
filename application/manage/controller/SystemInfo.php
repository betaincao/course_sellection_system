<?php
namespace app\manage\controller;
use think\Controller;
header("Content-Type: text/html; charset=utf-8");
class SystemInfo extends Base{
    public function info(){
        return $this->fetch();
    }
    public function help(){
        return $this->fetch();
    }

}