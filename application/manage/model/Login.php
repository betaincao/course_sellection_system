<?php
namespace app\manage\model;

use think\Model;

class Login extends Model
{
    public function login($username,$password){
        $admin= \think\Db::name('admin')->where('name','=',$username)->find();
        //var_dump($admin);die();
    	if($admin){
    		if($admin['password']==md5($password)){
    			\think\Session::set('id',$admin['id']);
    			\think\Session::set('name',$admin['name']);
    			return 1;
    		}else{
    			return 2;
    		}

    	}else{
    		return 3;
    	}
    }
}
	