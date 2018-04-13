<?php
namespace app\index\model;

use think\Model;

class Login extends Model
{
    public function login($identity,$username,$field,$password){
        $data= \think\Db::name("$identity")->where($field,'=',$username)->find();
    	if($data){
    		if($data['password']==md5($password)){
    			\think\Session::set('id',$data["$field"]);
				\think\Session::set('name',$data['name']);
				//echo session('id');die;
    			return 1;
    		}else{
    			return 2;
    		}

    	}else{
    		return 3;
    	}
    }
}
	