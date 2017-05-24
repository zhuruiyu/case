<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
    }
    public function index(){

        $arr['rs'] = $this->Article_model->get_article(1,0);
        $this->load->view('article/index',$arr);
    }
    public function get_article(){
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $index = $this->input->post('index');
        $type = $this->input->post('type');
        $rs = $this->Article_model->get_article($type,$index);
        $rs = json_encode($rs);
        echo $rs;
    }
    public function hit(){
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $aid = $this->input->post('aid');
        $this->Article_model->update_hit($aid);
        echo 'success';
    }
    public function show_article(){
        $aid = $this->uri->segment(3);
        $type = $this->uri->segment(4);
//        $rs = $this->Article_model->show_article($aid);

        $all = $this->Article_model->get_all_article($type);
        $index = 0;
        for($i=0;$i<count($all);$i++){
            if($all[$i]->article_id == $aid){
                $index = $i;
            }
        }
        if($index !=0){
            $arr['last'] = $all[$index-1];
        }else{
            $arr['last'] = '';
        }
        if($index == count($all)-1){
            $arr['next'] = '';
        }else{
            $arr['next'] = $all[$index+1];
        }
        $arr['rs'] = $all[$index];
        $this->load->view('article/show_article',$arr);
    }
    public function add_sight(){
        $data = $this->Article_model->get_test_data();
        $arr = ['0bc2aaa48ccf3f0cf382bb045462b21b.jpg','267acfa91b167557e2b34299d39e2cdd.jpg',
        '368171cba0c19359d5490af586961e3f.jpg','20534014e8f8414b94eaee6246045340.jpg','a28c3a477f6259827f9b84b8751408b7.jpg',
        'c410f568e3b003eb756a4aca914d2edb.jpg','d9851dcc78eea7a7315c63f6721f7f29.jpg'];

        for($i=0;$i<count($data);$i++){
            $title = $data[$i]->a_title;
            $content = $data[$i]->a_content;
            $type = 2;
            $add_time = date('Y-m-d H:i:s');
            $rand = rand(0,6);
            $imgName = $arr[$rand];
            $this->Article_model->insert_sight($title,$content,$type,$add_time,$imgName);
        }
    }
}