<?php
/**
*批量导入操作
*/
namespace app\manage\controller;
use think\Controller;
use app\manage\model\CreateTable as log;
header("Content-Type: text/html; charset=utf-8");
class BatchImport extends Base{
    public function index(){
        return $this->fetch();
    }
    public function importstudent(){
        if (!empty ($_FILES ['file_stu'] ['name'])) {
            $name = $_FILES['file_stu']['name'];
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode(".", $_FILES ['file_stu'] ['name']);
            $file_type = $file_types [count($file_types) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower($file_type) != "xlsx") {
                $this->error('不是.xlsx文件，请重新上传');
            }
            /*设置上传路径*/
            /*百度有些文章写的上传路径经过编译之后斜杠不对。不对的时候用大写的DS代替，然后用连接符链接就可以拼凑路径了。*/
            $savePath = ROOT_PATH . 'public' . DS . 'upload' . DS;
            /*以时间来命名上传的文件*/
            $str = date('Ymdhis');
            $file_name = $str . "." . $file_type;
            //$file_name = $name;
            //判断是否已存在
            if (!copy($tmp_file, $savePath . $file_name)) {
                $this->error('上传失败');
            }
            /*
            *对上传的Excel数据进行处理生成编程数据,这个函数会在下面第三步的ExcelToArray类中
            *注意：这里调用执行了第三步类里面的read函数，把Excel转化为数组并返回给$res,再进行数据库写入
            */
            require PUBLIC_PATH . '/tools/phpexcelreader/ExcelToArrary.class.php';//导入excelToArray类
          //引入这个类试了百度出来的好几个方法都不行。最后简单粗暴的使用了require方式。这个类想放在哪里放在哪里。只要路径对就行。
            $ExcelToArrary=new \ExcelToArrary();//实例化

            $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
            array_shift($res);
            unlink($savePath ."/" . $file_name);
            /*对生成的数组进行数据库的写入*/
            foreach ($res as $k => $v) {
                    $data[$k]['s_num'] = $v[0];
                    $data[$k]['name'] = $v[1];
                    $data[$k]['s_sex'] = $v[2];
                    $data[$k]['s_age'] = $v[3];
                    $data[$k]['password'] = md5("$v[0]");
                    $data[$k]['s_major'] = $v[4];
                    $data[$k]['s_grade'] = $v[5];
                    $data[$k]['s_mail'] = '';
                    $data[$k]['s_class'] = $v[6];    
            }
            //var_dump($data);die;
            //插入的操作最好放在循环外面
            $result = @\think\Db::name('student')->insertAll($data,$replace=true);
            if($result){
                //导入成功过后，查询数据库中的专业年级，并对新加入的专业年级建立对应的表
                $data = \think\Db::name('student')->field('s_major,s_grade')->group('s_major,s_grade')->select();
                $length = count($data);
                for($i=0;$i<$length;$i++){
                    $data1 = [
                        'major_name' => $data["$i"]['s_major'],
                        'major_grade' => $data["$i"]['s_grade'],
                    ];
                    $res = \think\Db::name('major')->where('major_name',$data1['major_name'])->where('major_grade',$data1['major_grade'])->find();
                    if($res){    
                    }else{
                        $tablename = \think\Db::name('major')->insertGetId($data1);
                        if($tablename){
                            $create = new log;
                            $result1=$create -> create_table($tablename);
                        }
                    }
                }
                $this->success('导入成功！');
            }else{
                $this->error('导入失败，请检查数据正确性');
            }
        }
        return $this->fetch();
    }


    public function importteacher(){
        if (!empty ($_FILES ['file_stu'] ['name'])) {
            $name = $_FILES['file_stu']['name'];
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode(".", $_FILES ['file_stu'] ['name']);
            $file_type = $file_types [count($file_types) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower($file_type) != "xlsx") {
                $this->error('不是.xlsx文件，请重新上传');
            }
            /*设置上传路径*/
            /*百度有些文章写的上传路径经过编译之后斜杠不对。不对的时候用大写的DS代替，然后用连接符链接就可以拼凑路径了。*/
            $savePath = ROOT_PATH . 'public' . DS . 'upload' . DS;
            /*以时间来命名上传的文件*/
            $str = date('Ymdhis');
            $file_name = $str . "." . $file_type;

            /*是否上传成功*/
            if (!copy($tmp_file, $savePath . $file_name)) {
                $this->error('上传失败');
            }
            /*
            *对上传的Excel数据进行处理生成编程数据,这个函数会在下面第三步的ExcelToArray类中
            *注意：这里调用执行了第三步类里面的read函数，把Excel转化为数组并返回给$res,再进行数据库写入
            */
            require PUBLIC_PATH . '/tools/phpexcelreader/ExcelToArrary.class.php';//导入excelToArray类
          //引入这个类试了百度出来的好几个方法都不行。最后简单粗暴的使用了require方式。这个类想放在哪里放在哪里。只要路径对就行。
            $ExcelToArrary=new \ExcelToArrary();//实例化

            $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
            array_shift($res);
            unlink($savePath ."/" . $file_name);
            /*对生成的数组进行数据库的写入*/
            foreach ($res as $k => $v) {
                
                    $data[$k]['t_num'] = $v[0];
                    $data[$k]['name'] = $v[1];
                    $data[$k]['t_sex'] = $v[2];
                    $data[$k]['t_school'] = $v[3];
                    $data[$k]['t_department'] = $v[4];
                    $data[$k]['password'] = md5($v[0]);
                    $data[$k]['t_mail'] = '';
            }
            //插入的操作最好放在循环外面
            $result = @\think\Db::name('teacher')->insertAll($data,$replace=true);
            if($result){
                $this->success('导入成功！');
            }else{
                $this->error('导入失败，请检查数据正确性');
            }
        }
        return $this->fetch();
    }
    public function importcourse(){
        if (!empty ($_FILES ['file_stu'] ['name'])) {
            $name = $_FILES['file_stu']['name'];
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode(".", $_FILES ['file_stu'] ['name']);
            $file_type = $file_types [count($file_types) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower($file_type) != "xlsx") {
                $this->error('不是.xlsx文件，请重新上传');
            }
            /*设置上传路径*/
            /*百度有些文章写的上传路径经过编译之后斜杠不对。不对的时候用大写的DS代替，然后用连接符链接就可以拼凑路径了。*/
            $savePath = ROOT_PATH . 'public' . DS . 'upload' . DS;
            /*以时间来命名上传的文件*/
            $str = date('Ymdhis');
            $file_name = $str . "." . $file_type;
            /*是否上传成功*/
            if (!copy($tmp_file, $savePath . $file_name)) {
                $this->error('上传失败');
            }
            /*
            *对上传的Excel数据进行处理生成编程数据,这个函数会在下面第三步的ExcelToArray类中
            *注意：这里调用执行了第三步类里面的read函数，把Excel转化为数组并返回给$res,再进行数据库写入
            */
            require PUBLIC_PATH . '/tools/phpexcelreader/ExcelToArrary.class.php';//导入excelToArray类
          //引入这个类试了百度出来的好几个方法都不行。最后简单粗暴的使用了require方式。这个类想放在哪里放在哪里。只要路径对就行。
            $ExcelToArrary=new \ExcelToArrary();//实例化

            $res=$ExcelToArrary->read($savePath.$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
            array_shift($res);
            unlink($savePath ."/" . $file_name);
            /*对生成的数组进行数据库的写入*/
            foreach ($res as $k => $v) {
                
                    $data[$k]['c_num'] = $v[0];
                    $data[$k]['c_major'] = $v[1];
                    $data[$k]['c_grade'] = $v[2];
                    $data[$k]['c_name'] = $v[3];
                    $data[$k]['c_department'] = $v[4];
                    $data[$k]['c_check_address'] = $v[5];
                    $data[$k]['c_score'] = $v[6];
                    $data[$k]['c_all_time'] = $v[7];
                    $data[$k]['c_theoretical_time'] = $v[8];
                    $data[$k]['c_test_hours'] = $v[9];
                    $data[$k]['c_semester'] = $v[10];
                    $data[$k]['c_week_time'] = $v[11];
                    $data[$k]['c_remarks'] = $v[12];

            }
            //插入的操作最好放在循环外面
            $result = @\think\Db::name('course')->insertAll($data);
            if($result){
                $this->success('导入成功！');
            }else{
                $this->error('导入失败，请检查数据正确性');
            }
        }
        return $this->fetch();
    }
}