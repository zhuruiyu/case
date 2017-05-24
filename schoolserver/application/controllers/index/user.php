<?php defined('BASEPATH') OR exit('No direct script access allowed');
//关于user表
class User extends CI_Controller {
    private $code;
    //构造函数
    public function __construct(){
        parent::__construct();
        $this->load->model("index/user_model");
        $this->load->library('encryption');//在控制器里面调用加密类
    }
    //加载未登录首页

    public function bb(){
        header('Access-Control-Allow-Origin:*');
        $this->load->library('session');
        $this->load->library('captcha');
        $code = $this->captcha->getCaptcha();
        $this->session->code = $code;
        if($this->session->code!="") {
            $this->captcha->showImg();
        }
    }
    public function cc(){
        header('Access-Control-Allow-Origin:*');
        $this->load->library('Captcha-new');
    }
    public function index(){
        header('Access-Control-Allow-Origin:*');
        $this->load->view("index/unlogin_index.php");
    }
    //加载已经登录的首页
    public function login_index(){
        $this->load->library('session');
        if($this->session->login_on=="TRUE") {
            $this->load->view("index/index.php");
        }else{
            redirect("index/user/index");
        }
    }

    //接受登录信息，账号密码
    public function login(){
          header('Access-Control-Allow-Origin:*');
          $username=$this->input->post("username");
          $password=md5($this->input->post("password"));
          $code=$this->input->post("code");
        //session_flag
          if($code==$this->session->code||$code!=""){
              $arr=[
                  "user"=>$username,
                  "password"=>$password,
                  "state"=>"1"
              ];
              $rs=$this->user_model->do_login($arr);
              if($rs){
                  //登录成功,返回json数据，设置session
                  $uid=$rs->uid;
                  $uname=base64_encode($rs->user);
                  $pass=$rs->password;
                  $sessioninfor=[
                      "uid"=>$uid,
                      "uname"=>$uname,
                      "login_on"=>"TRUE",
                  ];
                  $this->session->set_userdata($sessioninfor);
                  if($this->session->userdata("login_on")=="TRUE"){
                      $arr=["uid"=>"$uid","uname"=>"$uname","state"=>"success","pass"=>$pass];
                      $this->session->code="";
                      echo json_encode($arr);
                  }
              }else{
                  $arr=["state"=>"error"];
                  echo json_encode($arr);
              }
          }else{
              $arr=["state"=>"codeerror"];
              echo json_encode($arr);
          }

    }
    //cookie验证登录
    public function cookie_login(){
        header('Access-Control-Allow-Origin:*');
        $username=base64_decode($this->input->post("username"));
        $password=$this->input->post("password");
        $arr=[
            "user"=>$username,
            "password"=>$password,
            "state"=>"1"
        ];
        $rs=$this->user_model->do_login($arr);
        if($rs){
            $uid=$rs->uid;
            $uname=base64_encode($rs->user);
            $sessioninfor=[
                "uid"=>$uid,
                "uname"=>$uname,
                "login_on"=>"TRUE"
            ];
            $this->session->set_userdata($sessioninfor);
            if($this->session->login_on=="TRUE"){
                echo "1";
            }else{
                echo "0";
            }
            //echo "<script>location=".site_url('index/user/login_index')."</script>";
        }else{
            echo "0";
        }
    }
   //检查用户
    public function  checkuser(){
        header('Access-Control-Allow-Origin:*');
        $user=$this->input->post("username");
        $arr=[
            "user"=>$user
        ];
        $rs=$this->user_model->do_checkuser($arr);
        if($rs){
            echo "error";//存在
        }else{
            echo "success";//不存在
        }
    }
    //发送激活链接
    public function sendcode(){
        header('Access-Control-Allow-Origin:*');
        $user=$this->input->post("username");
        $pass=$this->input->post("password");
        $pu=$user.",".$pass;
        $url="http://localhost:80/schoolserver/index/user/active?key=".base64_encode($pu);
        $message="请点击链接激活账号<a href='$url'>$url</a>";
        $title="账号激活";
        $rs=$this->email("$user","$message","$title");
        if($rs){
            $arr=[
                "user"=>$user,
                "password"=>md5($pass),
                "admin"=>"0",
                "state"=>"0",
                "regdate"=>date("Y-m-d")
            ];
            if($this->user_model->do_reg($arr)){
                echo "success";
            }else{
                echo "error";
            }
        }else{
            echo "error";
        }
    }
    //发送邮件函数
    public function email($sendTo,$message,$title){

        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.163.com';
        $config['smtp_user'] = 'schoolserver@163.com';
        $config['smtp_pass'] = 'wsxxsw2016';
        $config['mailtype'] = 'html';
        $config['validate'] = true;
        $config['priority'] = 1;
        $config['crlf'] = "\r\n";
        $config['smtp_port'] = 25;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from('schoolserver@163.com', 'schoolserver');
        $this->email->to($sendTo);
        $this->email->subject($title);
        $this->email->message($message);
        $this->email->send();
        return $this->email->print_debugger();
    }
    //激活账号
    public function active(){
        $key=base64_decode($this->input->get("key"));
        $arr=explode(",",$key);
        $user=$arr[0];
        $pass=md5($arr[1]);
        $arr=[
            "user"=>$user,
            "password"=>$pass
        ];
        $rs=$this->user_model->do_decide($arr);
        if($rs){
            //如果存在这个用户,判断是否过期
            if($rs->regdate==date("Y-m-d")){
                //如果没有过期，激活该账号
                $rs1=$this->user_model->do_active("$user","$pass");
                if($rs1){
                    //激活成功，设置session，在userinfor表中添加一条数据
                    $arr=[
                        "wid"=>$rs->uid,
                        "username"=>$rs->user,
                        "major"=>"网络工程"
                    ];
                    $this->user_model->add_userinfor($arr);
                    $sessioninfor=[
                        "uid"=>$rs->uid,
                        "uname"=>$rs->user,
                        "login_on"=>"TRUE"
                    ];
                    $this->session->set_userdata($sessioninfor);
                    echo "<p style='font-size: 40px'>激活成功</p>";
                    echo "<a href='http://localhost:80/schoolserver/index/user/index' style='font-size: 40px'>点击跳转</a>";
                    echo "<p style='font-size: 40px'>页面将在3秒内跳转</p>";
                    header("Refresh:3;url=http://localhost:80/schoolserver/index/user/index");
                }
                else{
                    //如果第二次激活，延时跳转首页
                    $sessioninfor=[
                        "login_on"=>"FALSE"
                    ];
                    $this->session->set_userdata($sessioninfor);
                    echo "<p style='font-size: 40px'>链接失效了!!!</p>";
                    echo "<a href='http://localhost:80/schoolserver/index/user/index' style='font-size: 40px'>点击跳转</a>";
                    echo "<p style='font-size: 40px'>页面将在5秒内跳转</p>";
                    header("Refresh:3;url=http://localhost:80/schoolserver/index/user/index");
                }
            }else{
                //如果过期，删除该账号
                $this->user_model->do_delete($arr);
                $sessioninfor=[
                    "login_on"=>"FALSE"
                ];
                $this->session->set_userdata($sessioninfor);
                echo "<p style='font-size: 40px'>链接过期了,请重新注册</p>";
                echo "<a href='http://localhost:80/schoolserver/index/user/index' style='font-size: 40px'>点击跳转</a>";
                echo "<p style='font-size: 40px'>页面将在5秒内跳转</p>";
                header("Refresh:3;url=http://localhost:80/schoolserver/index/user/index");
            }

        }else{
            //如果不存在这个用户，则跳转主页
            $sessioninfor=[
                "uid"=>null,
                "uname"=>null,
                "login_on"=>"FALSE"
            ];
            $this->session->set_userdata($sessioninfor);
            header("Refresh:0;url=http://localhost:80/schoolserver/index/user/index");
        }
    }
    //退出登录
    public function login_out(){
        //注销登录,清理session
        header('Access-Control-Allow-Origin:*');
        session_destroy();
        $sessioninfor=[
            "uid"=>null,
            "uname"=>null,
            "login_on"=>"FALSE",
            "code"=>""
        ];
        $this->session->set_userdata($sessioninfor);
        echo "1";
    }
    //加载忘记密码页面
    public function forget(){
        $this->load->view("index/forget");
    }
    //发送忘记密码链接
    public function send_forget(){
        $username=$this->input->post("username");
        //首先检查该用户名是否存在是否激活
        $arr=[
            "user"=>$username,
            "state"=>1
        ];
        $rs=$this->user_model->do_checkuser($arr);
        if($rs){
            //如果存在且已经激活，发送邮件
            //产生随机密钥，存入数据库，修改密码是进行比对
            $key=rand(10000,99999);
            //记录发送链接的时间
            $this->user_model->do_forget($key,$username);
            $data=date("Y-m-d");
            //拼接字符串
            $str=$username." ".$key." ".$data;
            $enstr=$this->encryption->encrypt($str);
            $url="http://localhost:80/schoolserver/index/user/changeforget?key=$enstr";
            $message="请点击链接重置密码<a href='$url'>$url</a>";
            $title="重置密码";
            $this->email($username,$message,$title);
            echo "1";
        }else{
            //如果不存在或者未激活
            echo "0";
        }
    }
    //加载个人中心页面
    public function personal(){
        if($this->session->login_on=="TRUE"){
            //如果有session则跳转
            $arr=[
                "wid"=>$this->session->uid
            ];
            $rs["userinfor"]=$this->user_model->do_userinfor($arr);
            $this->load->view("index/personal",$rs);
        }else{
            //否则跳转登录页
            redirect("index/user/index");
        }

    }
    //修改个人信息
    public function change_personal(){
        $name=$this->input->post("name");//昵称
        $sex=$this->input->post("sex");//性别
        $grade=$this->input->post("grade");//年级
        $major=$this->input->post("major");//专业
        $arr=[
            "username"=>$name,
            "sex"=>$sex,
            "grade"=>$grade,
            "major"=>$major
        ];
        $rs=$this->user_model->do_changeuser($arr);
        if($rs){
            echo "success";
        }else{
            echo "error";
        }
    }
    //判断昵称是否重复
    public function checkname(){
        header('Access-Control-Allow-Origin:*');
        $name=$this->input->post("name");
        $rs=$this->user_model->do_checkname($name);
        if($rs==1||$rs==0){
            echo "success";
        }else{
            echo "error";
        }
    }
    //修改密码时，检查旧密码是否正确
    public function check_password(){
        $oldpass=$this->input->post("oldpass");
        $arr=[
            "user"=>base64_decode($this->session->userdata("uname")),
            "password"=>md5($oldpass),
            "state"=>"1"
        ];
        //返回受影响行数
        $rs=$this->user_model->do_checkuser($arr);
        if($rs){
            echo "1";
        }else{
            echo "0";
        }
    }
    //修改密码(修改密码页面)
    public function change_password(){
        $pass=$this->input->post("pass");
        $password=$this->input->post("oldpass");
        $user=base64_decode($this->session->userdata("uname"));
        $arr=[
            "user"=>$user,
            "password"=>md5($password),
            "state"=>"1"
        ];
        $data=[
            "password"=>md5($pass)
        ];
        $rs=$this->user_model->do_change_password($data,$arr);
        if($rs){
            echo "1";
        }else{
            echo "0";
        }
    }
    //加载忘记密码页面
    public function changeforget(){
        header('Access-Control-Allow-Origin:*');
        $this->load->library('encryption');
        $key=$this->input->get("key");
        $str=$this->encryption->decrypt(str_replace(" ","+","$key"));
        $user=explode(" ",$str)[0];
        $key=explode(" ",$str)[1];
        $time=explode(" ",$str)[2];
        if($time!=date("Y-m-d")){
            //echo "time_error";//时间不匹配
            echo "<p style='font-size: 40px'>链接失效了!!!</p>";
            echo "<a href='http://localhost:80/schoolserver/index/user/index' style='font-size: 40px'>点击跳转</a>";
            echo "<p style='font-size: 40px'>页面将在5秒内跳转</p>";
            header("Refresh:3;url=http://localhost:80/schoolserver/index/user/index");
        }else{
            $arr=[
                "user"=>$user,
                "forgetkey"=>$key
            ];
            $rs=$this->user_model->do_getkey($arr);
            if($rs){
                //echo "success";//成功,加载更换密码页面
                $infor["user"]=$user;
                $this->load->view("index/changeforget.php",$infor);
            }else{
                //echo "erroe";//信息不匹配
                echo "<p style='font-size: 40px'>链接失效了!!!</p>";
                echo "<a href='http://localhost:80/schoolserver/index/user/index' style='font-size: 40px'>点击跳转</a>";
                echo "<p style='font-size: 40px'>页面将在5秒内跳转</p>";
                header("Refresh:3;url=http://localhost:80/schoolserver/index/user/index");
            }
        }
        //echo $user."<br />".$key."<br />"."$time";

    }
    //修改忘记密码页面的密码
    public function change_pass(){
        header('Access-Control-Allow-Origin:*');
        $user=$this->input->post("user");
        $password=$this->input->post("pass");
        $rs=$this->user_model->do_changepass($user,$password);
        if($rs){
            echo "success";
        }else{
            echo "error";
        }
    }
    public function pwdtest(){
        $this->load->library('encrypt');//在控制器里面调用加密类
        /*加密过程*/
        //第一种方法
        $a = 'abc';
        $aa = $this->encrypt->encode($a);
        echo $aa;
        echo "<br />";
        //第二种方法
        $b = 'dex';
        $b1 = 'super-secret-key';
        $bb = $this->encrypt->encode($b, $b1);
        echo $bb;
        echo "<br />";
        /*解密过程*/
        //第一种方法
        $c = $aa;
        $cc = $this->encrypt->decode($c);
        echo $cc;
        echo "<br />";
        //第二种方法
        $d = $bb;
        $d2 = 'super-secret-key';
        $dd = $this->encrypt->decode($d, $d2);
        echo $dd;
    }
}
?>