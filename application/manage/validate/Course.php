<?php
namespace app\manage\validate;

use think\Validate;

class Course extends Validate
{
    protected $rule = [
        'c_name'  =>  'require|max:30',
        'c_major' => 'require',
        'c_grade' => 'require',
        'c_check_address' => 'require',
        'c_score' => 'require',
        'c_all_time' => 'require',

    ];

    protected $message  =   [
        'c_name.require' => '课程名称不能为空！',  
        'c_name.unique' => '课程名称不能重复！',  
        'c_name.max' => '课程名称不能大于30位！', 

    ];

    protected $scene = [
        'edit'  =>  ['c_name'],
    ];


}