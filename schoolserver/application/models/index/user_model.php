<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*user控制模型*/
class User_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    //登录
    public function do_login($arr){
        $query=$this->db->get_where("user",$arr);
        return $query->row();
    }
    //注册时检查用户是否被注册
    public function do_checkuser($arr){
        $this->db->get_where("user",$arr);
        return $this->db->affected_rows();
    }
    //判断昵称是否重复
    public function do_checkname($name){
        $arr=[
            "username"=>$name
        ];
        $this->db->get_where("userinfor",$arr);
        return $this->db->affected_rows();
    }
    //注册成功将数据写入数据库
    public function do_reg($arr){

        $this->db->insert("user",$arr);
        return $this->db->affected_rows();
    }
    //激活链接时判断数据库是否存在该账号
    public function do_decide($arr){
        $query=$this->db->get_where("user",$arr);
        return $query->row();
    }
    //激活账号，将状态变为1
    public function do_active($user,$pass){
        $arr=[
            "state"=>"1"
        ];
        $this->db->where('user', $user);
        $this->db->where('password',$pass);
        $this->db->update('user', $arr);
        return $this->db->affected_rows();
    }
    //激活成功后，在userinfor表中添加一条数据
    public function add_userinfor($arr){
        $this->db->insert("userinfor",$arr);
    }
    //激活链接失效，删除账号
    public function do_delete($arr){
        $this->db->delete("user",$arr);
        return $this->db->affected_rows();
    }
    //忘记密码,发送链接后，将忘记密码的key写入数据库
    public function do_forget($key,$username){
        $this->db->where('user', $username);
        $data=[
            "forgetkey"=>$key
        ];
        $this->db->update('user',$data);
    }
    //忘记密码，验证是判断key和user是否匹配
    public function do_getkey($arr){
        $this->db->get_where("user",$arr);
        return $this->db->affected_rows();
    }
    //忘记密码页面，修改密码
    public function do_changepass($user,$pass){
        $this->db->where("user",$user);
        $data=[
            "password"=>md5($pass),
            "forgetkey"=>"0"
        ];
        $this->db->update("user",$data);
        return $this->db->affected_rows();
    }
    //进入个人中心页面时，提取个人中心数据
    public function do_userinfor($arr){
        $query=$this->db->get_where("userinfor",$arr);
        return $query->row();
    }
    //修改个人资料
    public function do_changeuser($arr){
        $this->db->where('wid',$this->session->userdata("uid"));
        $this->db->update('userinfor', $arr);
        return $this->db->affected_rows();
    }
    //修改密码(修改密码页面)
    public function do_change_password($data,$arr){
        $this->db->update('user',$data,$arr);
        return $this->db->affected_rows();
    }
}
?>