<?php
/**
 * 教师的页面
 */
namespace app\index\controller;
use think\Controller;
class Teacher extends Important{
    public function teaching(){
        $t_num = session('id');
        $res = \think\Db::name("ct")->limit(5)->field('id')->where('t_num',$t_num)->select();
        $c_id = array();
        if($res){
            foreach($res as $key=>$value){
                $c_id[] = $value['id'];
            }
            $course = \think\Db::name("course")->field('c_id,c_name')->where('c_id','in',$c_id)->select();
            $this->assign('teachingCourse',$course);
            return $this->fetch();
        }else{
            $course=array();
            $this->assign('empty','<span class="empty"><h4><br>暂时没有数据，请联系管理员</h4></span>');
            $this->assign('teachingCourse',$course);
            return $this->fetch();
        }
    }
    public function notice(){
        $notice = \think\Db::table('system_notice')->order('n_time desc')->find();
        //var_dump($notice);die;
        $this->assign('notice',$notice);
        return $this->fetch();
    }
    public function info(){
        $t_num = session('id');
        $data = \think\Db::name("teacher")->field('t_num,name,t_department,t_school,t_sex,t_mail')->where('t_num',$t_num)->find();
        $this->assign('teacher',$data);
        return $this->fetch();
    }
    public function studentList(){
        $c_id = input('c_id');
        $courseInfo = \think\Db::name("course")->field('c_major,c_grade,c_name,c_num')->where('c_id',$c_id)->find();
        $tableId = \think\Db::name("major")->field('m_id')->where('major_name',$courseInfo['c_major'])->where('major_grade',$courseInfo['c_grade'])->find();
        $tableName = $tableId['m_id'] . '_course';
        $scInfo = \think\Db::name($tableName)->field('s_num')->where('c_id',$c_id)->where('status','1')->select();
        $scInfo1 = array();
        foreach($scInfo as $key=>$value){
            $scInfo1[] = $value['s_num'];
        }
        $data = \think\Db::name("student")->field('name,s_num,s_class')->where('s_num','in',$scInfo1)->order('s_num desc')->select();
        $length = count($data);
        $this->assign('length',$length);
        $this->assign('courseInfo',$courseInfo);
        $this->assign('studentList',$data);
        return $this->fetch();
    }
    /**
     * 教师修改邮箱模块
     */
    public function changemail(){
        if(request()->isPost()){
            $pwd = md5(input('password'));
            
            $mail = input('email');
            $s_num = session('id');
            $password = \think\Db::name("teacher")->field('password')->where('t_num',$s_num)->find();
            if($pwd == $password['password']){
                $db= \think\Db::name('teacher')->where('t_num',$s_num)->update(['t_mail' => $mail]);
                if($db){
                    $this->redirect('info');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('您输入的密码不正确');
            }
        }
    }
    /**
     * 教师修改密码模块
     *
     */
    public function changepwd(){
        $s_num = session('id');
        $data = \think\Db::name("teacher")->field('t_mail')->where('t_num',$s_num)->find();
        if(empty($data['t_mail'])){
            $this->error('修改失败，请先修改您的邮箱信息');
        }else{
            if(request()->isPost()){
                $pwd = md5(input('password'));
                $newPassword = md5(input('newPassword'));
                $password = \think\Db::name("teacher")->field('password')->where('t_num',$s_num)->find();
                if($pwd == $password['password']){
                    $db= \think\Db::name('teacher')->where('t_num',$s_num)->update(['password' => $newPassword]);
                    if($db){
                        $this->success('修改成功,系统将退出，请重新登录。','login/logout');
                    }else{
                        $this->error('修改失败');
                    }
                }else{
                    $this->error('您输入的密码不正确');
                }
            }
        }
        
    }
}