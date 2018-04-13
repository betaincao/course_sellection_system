<?php
namespace app\manage\validate;

use think\Validate;

class Student extends Validate
{
    protected $rule = [
        's_num' =>'require',
        'name'  =>  'require',
        's_sex' => 'require',
        's_major' => 'require',
        's_sex' => 'require',
    ];
    protected $message  =   [
        's_num.require' => '学号不能为空！',  
        's_num.unique' => '系统中存在该学生信息！',   
        'name.require' => '学生姓名不能为空！',    

    ];
    protected $scene = [
        'edit'  =>  ['s_num','s_major','name','s_sex'],
    ];
}