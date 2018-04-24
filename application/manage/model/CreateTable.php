<?php
namespace app\manage\model;

use think\Model;

class CreateTable extends Model
{
	/**
	 * 分配选课即选几
	 *
	 * 建立数据表,一个专业的一个年级 对应一张表
     */
    public function create_table($tablename){
		$result = \think\Db::query("CREATE TABLE IF NOT EXISTS `system_" . "$tablename" .  "_course`(
			`id` char(50) NOT NULL COMMENT '学号课程id为主键',
			`s_num` char(8) NOT NULL COMMENT '学号',
			`c_id`	INT NOT NULL COMMENT '课程id',
			`lang` char(8) NOT NULL comment '设置几选几（3,2）',
			`all` int NOT NULL DEFAULT 0 COMMENT '整班选课0：不是整班选课，1：是整班选课',
			`status` int NOT NULL COMMENT '学生选中状态0:学生没选这门课，1：学生选择了这门课',
			`semester` int NOT NULL COMMENT '学期',
			`create_time` char(12) NOT NULL COMMENT '创建时间2018-02-11',		
			PRIMARY KEY ( `id` )
			)ENGINE=InnoDB DEFAULT CHARSET=utf8;
		");

    }
}
	