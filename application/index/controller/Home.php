<?php
namespace app\index\controller;
use think\Controller;
class Home extends Important{
    public function index(){
        return $this->fetch();
    }
}