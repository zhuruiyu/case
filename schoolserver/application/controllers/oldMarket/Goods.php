<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('oldMarket/Goods_model');
    }
    public function index(){
        $arr['industry'] = $this->Goods_model->get_catalog(6);
        $arr['novel'] = $this->Goods_model->get_catalog(7);
        $arr['history'] = $this->Goods_model->get_catalog(8);
        $arr['book_other'] = $this->Goods_model->get_catalog(9);
        $arr['phone'] = $this->Goods_model->get_catalog(10);
        $arr['camera'] = $this->Goods_model->get_catalog(11);
        $arr['computer'] = $this->Goods_model->get_catalog(12);
        $arr['tec_other'] = $this->Goods_model->get_catalog(13);
        $arr['ball'] = $this->Goods_model->get_catalog(14);
        $arr['bike'] = $this->Goods_model->get_catalog(15);
        $arr['swim'] = $this->Goods_model->get_catalog(16);
        $arr['sports_other'] = $this->Goods_model->get_catalog(17);
        $arr['women'] = $this->Goods_model->get_catalog(18);
        $arr['man'] = $this->Goods_model->get_catalog(19);
        $arr['shoes'] = $this->Goods_model->get_catalog(20);
        $arr['cloth_other'] = $this->Goods_model->get_catalog(21);
        $arr['watch'] = $this->Goods_model->get_catalog(22);
        $arr['accessories'] = $this->Goods_model->get_catalog(23);
        $arr['collection'] = $this->Goods_model->get_catalog(24);
        $arr['collection_other'] = $this->Goods_model->get_catalog(25);
        $arr['latest_goods'] = $this->Goods_model->get_good_latest();
        $arr['book_result']= $this->Goods_model->get_good_father(1);
        $arr['tec_result'] = $this->Goods_model->get_good_father(2);
        $arr['sport_result'] = $this->Goods_model->get_good_father(3);
        $arr['cloth_result'] = $this->Goods_model->get_good_father(4);
        $arr['collection_result'] = $this->Goods_model->get_good_father(5);
        $this->load->view('oldMarket/index',$arr);
    }
    public function put_good(){
        if(isset($this->session->uid)){
            $fCatalog = $this->Goods_model->get_catalog(0);
            $arr['fCatalog'] = $fCatalog;
            $this->load->view('oldMarket/put_good',$arr);
        }else{
            redirect('index/User/index?oldMarket/Goods/put_good');
        }

    }
    public function get_father(){
        header('Access-Control-Allow-Origin:*');
        $father = $this->input->post('father');
        $rs = $this->Goods_model->get_catalog($father);
        $rs = json_encode($rs);
        echo $rs;
    }
    public function do_put_good(){
//        $config['upload_path']      = './assets/images/uploads/';
//        $config['allowed_types']    = 'gif|jpg|png';
//        $config['max_size']     = 2048;
////        $config['max_width']        = 1024;
////        $config['max_height']       = 768;
//        $this->load->library('upload', $config);
        //重新组合一个$_FILES中的格式 使其变为和上传单个文件的数据格式类似
        $imgSrc = uniqid();
        foreach($_FILES['files'] as $index => $vals){
            foreach ($vals as $i => $val) {
                $file_map[$i]['files'][$index] = $val;
            }
        }
        $file_num = 0;
        foreach ($file_map as $files) {
            $config['upload_path']      = './assets/images/uploads/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['file_name'] = uniqid();

            //遍历   这样每次都去覆盖掉$_FILES中的数据 （PS：这样覆盖后，$_FILES格式就和上传单个文件的格式是一模一样的了）
            $_FILES = $files;
            $this->load->library('upload',$config);
            if($this->upload->do_upload("files")){
                if($file_num==0){
                    $fimg = $this->upload->data('file_name');
                }
                $file_num++;
                $imgName = $this->upload->data('file_name');
                $imgPath = $this->upload->data('full_path');
                $this->Goods_model->add_img($imgName,$imgSrc,$imgPath);
            }else{
                echo "<script>alert('".$this->upload->display_errors()."')</script>";
                echo "<script>location='".site_url('oldMarket/Goods/put_good')."'</script>";
            }
        }
//        $config['upload_path']      = './assets/images/uploads/';
//        $config['allowed_types']    = 'gif|jpg|png';
//        $config['file_name'] = uniqid();
//        $this->load->library('upload',$config);
//        if($this->upload->do_upload("first_file")){
//            $fimg = $this->upload->data('file_name');
//        }else{
//            echo "<script>alert('".$this->upload->display_errors()."aaaa')</script>";
//            echo "<script>location='".site_url('oldMarket/Goods/put_good')."'</script>";
//        }
        $src = $imgSrc;
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $cid = $this->input->post('cname');
        $price = $this->input->post('price');
        if($cid=='other'){
            $cid=$this->input->post('father');
        }
        $uid = $this->session->uid;
        $rs = $this->Goods_model->add_good($title,$content,$cid,$uid,$src,$fimg,$price);
        if($rs){
            redirect('oldMarket/Goods/index');
        }

//        if($this->upload->do_upload('picture')){

//            $title = $this->input->post('title');
//            $content = $this->input->post('content');
//            $cid = $this->input->post('cname');
//            if($cid=='other'){
//                $cid=$this->input->post('father');
//            }
//            $uid = $this->session->uid;
//            $rs = $this->Goods_model->add_good($title,$content,$cid,$uid,$src);
//            if($rs){
//                redirect('oldMarket/Goods/index');
//            }
//        }else{
//
//        }


    }
    public function good_detail(){
        $gid = $this->uri->segment(4);
        $this->Goods_model->update_hits($gid);
        $rs = $this->Goods_model->get_good_detail($gid);
        $arr['rs'] = $rs;
        $this->load->view('oldMarket/good_detail',$arr);
    }
    public function my_goods(){
        if(isset($this->session->uid)){
            $uid = $this->session->uid;
            $number = $this->Goods_model->my_goods_num($uid);
            $per_page = 4;
            $this->load->library('pagination');
            $config['base_url'] = site_url('oldMarket/Goods/my_goods/');
            $config['total_rows'] = $number;
            $config['per_page'] = $per_page;
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
            $rs = $this->Goods_model->get_my_goods($uid,$index,$per_page);
            $arr['rs'] = $rs;
            $this->load->view('oldMarket/my_goods',$arr);
        }else{
            redirect("index/User/index");
        }
    }
    public function del_my_good(){
        $gid = $this->uri->segment(4);

        $del_imgs = $this->Goods_model->del_img($gid);
//        echo "<pre>";
//        var_dump($del_imgs);
//        die();
        foreach ($del_imgs as $val){
//            $this->load->helper('file');
//            delete_files('./assets/images/uploads/'.$val->imgName.'');\
            echo unlink($val->imgPath);
        }
        $rs  = $this->Goods_model->del_my_good($gid);
        if($rs){
            redirect('oldMarket/Goods/my_goods');
        }else{
            echo "<script>alert('删除失败')</script>";
            echo "<script>location='".site_url('oldMarket/Goods/my_goods')."'</script>";
        }
    }
    public function edit_my_good(){
        $gid = $this->uri->segment(4);
        $rs = $this->Goods_model->get_good_detail($gid);
        $arr['rs'] = $rs;
        $arr['gid'] = $gid;
        $this->load->view('oldMarket/edit_good',$arr);
    }
    public function do_edit_my_good(){
        $gid = $this->input->post('gid');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $rs = $this->Goods_model->edit_my_good($gid,$title,$content);
        if($rs){
            redirect('oldMarket/Goods/my_goods');
        }else{
            echo "<script>alert('更新失败')</script>";
            echo "<script>location='".site_url('oldMarket/Goods/my_goods')."'</script>";
        }
    }
    public function show_good(){
        $cid = $this->uri->segment(4);
        $arr['book'] = $this->Goods_model->get_father_catalog(1);
        $arr['elec'] = $this->Goods_model->get_father_catalog(2);
        $arr['sport'] = $this->Goods_model->get_father_catalog(3);
        $arr['cloth'] = $this->Goods_model->get_father_catalog(4);
        $arr['collection'] = $this->Goods_model->get_father_catalog(5);
        $goods =$this->Goods_model->show_goods($cid);
        $arr['cid'] = $cid;
        $arr['goods'] = $goods;
        $this->load->view('oldMarket/show_goods',$arr);
    }
    public function good_search_tip(){
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $keyword = $this->input->post('keyword');
        $rs = $this->Goods_model->get_good_tip($keyword);
        $result = json_encode($rs);

        echo $result;
    }
    public function search(){
        $key = $this->input->get('key');
        $rs = $this->Goods_model->get_good_tip($key);
        $arr['rs'] = $rs;
        $arr['key'] = $key;
        $this->load->view('oldMarket/search_result',$arr);
    }
}