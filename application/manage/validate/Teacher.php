<?php
namespace app\manage\validate;

use think\Validate;

class Teacher extends Validate
{
    protected $rule = [
        't_num' =>'require',
        'name'  =>  'require',
        't_sex' => 'require',
        't_department' => 'require',
        't_sex' => 'require',
    ];
    protected $message  =   [
        't_num.require' => '教师工号不能为空！',  
        't_num.unique' => '教师工号不能重复！',   
        'name.require' => '教师姓名不能为空！',  
        'name.unique' => '教师姓名不能重复！',  

    ];
    protected $scene = [
        'edit'  =>  ['t_num','t_major','name','t_sex'],
    ];
}