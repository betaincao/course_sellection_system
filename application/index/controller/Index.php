<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index(){
        //var_dump(PUBLIC_PATH);exit;
        return $this->fetch();
    }
}
