<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model');
        header('Access-Control-Allow-Origin: http://localhost:8080');  //用于控制请求源
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');  //设置请求头，有时会用到
        header('Access-Control-Allow-Credentials: true');  //设置允许cookie跨域
    }
    public function  check_isLogin(){
//        header('Access-Control-Allow-Origin: http://localhost:8080');
//        header('Access-Control-Allow-Credentials: true');   //设置允许cookie跨域
        $user = $this->session->user;
        if($user){
            echo "login";
        }else{
            echo "unlogin";
        }

    }
    public function login(){
//          header('Access-Control-Allow-Origin: http://localhost:8080');  //用于控制请求源
//        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');  //设置请求头，有时会用到
//        header('Access-Control-Allow-Credentials: true');  //设置允许cookie跨域
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $rs = $this->client_model->login($username,$password);
        if($rs){
            $this->session->user = $rs;
            echo 'success';
        }else{
            echo 'fail';
        }
    }
    public function user_init(){
        $perPage = $this->input->get('perPage');
        $sum = $this->client_model->count_all_user();
        echo $sum;
    }
    public function get_user(){
        $index = $this->input->get('index');
        $perPage = $this->input->get('perPage');
        $rs = $this->client_model->get_user($index,$perPage);
        echo json_encode($rs);
    }
    public function delete_user(){

        $uid = $this->input->get('uid');
        echo 'success';
    }


}
?>
