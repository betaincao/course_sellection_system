<?php
/**
 * 教师的页面
 */
namespace app\index\controller;
use think\Controller;
use think\Request; 
class Teacher extends ImportantTeacher{
    public function teaching(){
        $t_num = session('t_id');
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
        $t_num = session('t_id');
        $data = \think\Db::name("teacher")->field('t_num,name,t_department,t_school,t_sex,t_mail')->where('t_num',$t_num)->find();
        $this->assign('teacher',$data);
        return $this->fetch();
    }
    public function studentList(Request $request){
        $c_id = input('c_id');
        $page = input('page');
        if(isset($page)){
            $page = input('page');
        }else{
            $page = 1;
        }
        $page_size = 10;
        $courseInfo = \think\Db::name("course")->field('c_major,c_grade,c_name,c_num')->where('c_id',$c_id)->find();
        $tableId = \think\Db::name("major")->field('m_id')->where('major_name',$courseInfo['c_major'])->where('major_grade',$courseInfo['c_grade'])->find();
        $tableName = $tableId['m_id'] . '_course';
        $scInfo = \think\Db::name($tableName)->field('s_num')->where('c_id',$c_id)->where('status','1')->select();
        $scInfo1 = array();
        foreach($scInfo as $key=>$value){
            $scInfo1[] = $value['s_num'];
        }
        $data = \think\Db::name("student")->field('name,s_num,s_class')->where('s_num','in',$scInfo1)->order('s_class asc')->select();
        $length = count($data);
        if($length){
            if($length < $page_size){
                $page_count = 1;
            }if($page % $page_size){
                $page_count = (int)($length/$page_size+1);
            }else{
                $page_count = $length/$page_size;
            }
        }else{
            $page_count = 0;
        }
        $turn_page = '';
        $url = $request->path();
        if($page == 1){
            $turn_page .= '首页 | 上一页 |';
        }else{
            $turn_page .= '<a href ='.$c_id.'/page/1>首页</a> | <a href ='. ($page-1).'> 上一页</a> |';    
        }
        if($page_count || $page_count == 0){
            $turn_page .= '下一页 | 尾页';
        }else{
            $turn_page .= '<a href='. ($page+1).'> 下一页</a>|<a href='. $page_count .'> 尾页 </a>';
        }
        //分页
        //echo $turn_page;die;
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
            $s_num = session('t_id');
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
        $s_num = session('t_id');
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