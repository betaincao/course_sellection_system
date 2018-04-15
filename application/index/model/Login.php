<?php
namespace app\index\model;

use think\Model;

class Login extends Model{
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
/**
 * 
 * 这里需要修改，不能三个角色的session放在一起，无法判断登录状态。
 * 
 */
    	}else{
    		return 3;
    	}
	}
	public function teacher(){
		
	}
}
	