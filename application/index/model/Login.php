<?php
namespace app\index\model;

use think\Model;

class Login extends Model{
    public function studentLoginModel($s_num,$password){
        $data= \think\Db::name('student')->where('s_num','=',$s_num)->find();
    	if($data){
    		if($data['password']==md5($password)){
    			\think\Session::set('id',$data['s_num']);
				\think\Session::set('s_name',$data['name']);
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
	public function teacherLoginModel($t_num,$password){
		$data= \think\Db::name('teacher')->where('t_num','=',$t_num)->find();
    	if($data){
    		if($data['password']==md5($password)){
    			\think\Session::set('t_id',$data['t_num']);
				\think\Session::set('t_name',$data['name']);
    			return 1;
    		}else{
    			return 2;
    		}
    	}else{
    		return 3;
    	}
	}
	public function adminLoginModel($name,$password){
		$data= \think\Db::name('admin')->where('name','=',$name)->find();
    	if($data){
    		if($data['password']==md5($password)){
    			\think\Session::set('a_id',$data['id']);
				\think\Session::set('a_name',$data['name']);
    			return 1;
    		}else{
    			return 2;
    		}
    	}else{
    		return 3;
    	}
	}
}
	