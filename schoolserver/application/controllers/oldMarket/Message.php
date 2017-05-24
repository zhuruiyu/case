<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('oldMarket/Message_model');
    }
//    public function send_message(){
//        if(isset($_SESSION['uid'])){
//            if(!isset($_SESSION['rid'])){
//                $this->session->rid = $this->uri->segment(4);
//            }
//            $this->load->view('oldMarket/send_msg');
//        }else{
//            redirect('index/User/index?url=oldMarket/Message/send_message');
//        }
//
//    }
    public function do_send_msg(){
        $content = $this->input->post('content');
        if(isset($_SESSION['rid'])){
            $rid = $this->session->rid;
        }else{
            $rid = $this->uri->segment(4);
        }
        if(isset($this->session->uid)){
            $sid = $this->session->uid;
        }else{
            redirect('index/user');
        }

        $rs = $this->Message_model->send_msg($content,$sid,$rid);
        if($rs){
            redirect('oldMarket/Goods/index');
            unset(
                $_SESSION['rid']
            );
        }else{
            redirect('oldMarket/Message/send_message');
        }
    }
    public function my_msg_receive(){
        if(isset($_SESSION['uid'])){
            $rid = $this->session->uid;
            $number = $this->Message_model->count_message($rid);
            $this->load->library('pagination');
            $config['base_url'] = site_url('oldMarket/Message/my_msg_receive/');
            $config['total_rows'] = $number;
            $config['per_page'] = 10;
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';
            $config['full_tag_open'] = '<p class="page-nav">';
            $config['full_tag_close'] = '</p>';
            $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);
            $index = $this->uri->segment(4);
            if(!$index){
                $index = 0;
            }
            $rs = $this->Message_model->get_message($index,$rid);
            $arr['rs'] = $rs;
            $this->load->view('oldMarket/my_msg_receive',$arr);
        }else{
            redirect('index/User/index?url=oldMarket/Message/my_msg_receive');
        }
    }
    public function my_msg_send(){
        $sid = $this->session->uid;
        $number = $this->Message_model->count_send_message($sid);
        $this->load->library('pagination');
        $config['base_url'] = site_url('oldMarket/Message/my_msg_receive/');
        $config['total_rows'] = $number;
        $config['per_page'] = 10;
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['full_tag_open'] = '<p class="page-nav">';
        $config['full_tag_close'] = '</p>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $index = $this->uri->segment(4);
        if(!$index){
            $index = 0;
        }
        $rs = $this->Message_model->get_send_message($index,$sid);
        $arr['rs'] = $rs;
        $this->load->view('oldMarket/my_msg_send',$arr);
    }
    public function msg_detail(){
        $mid = $this->uri->segment(4);
        $this->Message_model->update_msg($mid);
        $rs = $this->Message_model->msg_detail($mid);
        $arr['rs'] = $rs;
        $this->load->view('oldMarket/msg_detail',$arr);
    }
}