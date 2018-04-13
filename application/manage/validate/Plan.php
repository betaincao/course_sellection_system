<?php
namespace app\manage\validate;

use think\Validate;

class Plan extends Validate
{
    protected $rule = [
        'p_name'  =>  'require|max:150|unique:plan',
    ];

    protected $message  =   [
        'p_name.require' => '培养计划名称不能为空！',  
        'p_name.unique' => '培养计划名称不能重复！', 
          

    ];

    protected $scene = [
        'edit'  =>  ['p_name'],
    ];
}