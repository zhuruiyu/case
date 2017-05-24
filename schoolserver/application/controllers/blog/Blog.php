<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("blog/Blog_model");
    }
    //加载blog首页
    public function index(){
        $allNume=$this->Blog_model->do_getAllnum();
        $page= $this->uri->segment(4)==null?1:$this->uri->segment(4);
        $this->load->library('pagination');
        $url="blog/Blog/index";
        $config['base_url'] = $url;
        $config['total_rows'] = $allNume;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="page">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="pagenum">';
        $config['num_tag_close'] = '</span>';
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $this->pagination->initialize($config);
        $data=$this->Blog_model->get_index($page,$config['per_page']);
        $rs["blog"]=$data;
        if($this->session->userdata("login_on")=="TRUE"){
            $this->load->view("blog/loginblog.php",$rs);
        }else{
            $this->load->view("blog/blog.php",$rs);
        }
    }
    //加载校园要闻页面
    public function hotblog(){
        $str="校园要闻";
        $allNume=$this->Blog_model->do_getClassfyNum($str);
        $page= $this->uri->segment(4)==null?1:$this->uri->segment(4);
        $this->load->library('pagination');
        $url="blog/Blog/hotblog";
        $config['base_url'] = $url;
        $config['total_rows'] = $allNume;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="page">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="pagenum">';
        $config['num_tag_close'] = '</span>';
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $this->pagination->initialize($config);
        $data=$this->Blog_model->get_hotindex($page,$config['per_page'],$str);
        $rs["blog"]=$data;
        if($this->session->userdata("login_on")=="TRUE"){
            $this->load->view("blog/loginhotblog.php",$rs);
        }else{
            $this->load->view("blog/hotblog.php",$rs);
        }
    }
    //加载热点问题页面
    public function hotquestion(){
        $str="热点问题";
        $allNume=$this->Blog_model->do_getClassfyNum($str);
        $page= $this->uri->segment(4)==null?1:$this->uri->segment(4);
        $this->load->library('pagination');
        $url="blog/Blog/hotquestion";
        $config['base_url'] = $url;
        $config['total_rows'] = $allNume;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="page">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="pagenum">';
        $config['num_tag_close'] = '</span>';
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $this->pagination->initialize($config);
        $data=$this->Blog_model->get_hotindex($page,$config['per_page'],$str);
        $rs["blog"]=$data;
        if($this->session->userdata("login_on")=="TRUE"){
            $this->load->view("blog/loginhotquestion.php",$rs);
        }else{
            $this->load->view("blog/hotquestion.php",$rs);
        }
    }
    //加载学习讨论页面
    public function hotlearn(){
        $str="学习交流";
        $allNume=$this->Blog_model->do_getClassfyNum($str);
        $page= $this->uri->segment(4)==null?1:$this->uri->segment(4);
        $this->load->library('pagination');
        $url="blog/Blog/hotquestion";
        $config['base_url'] = $url;
        $config['total_rows'] = $allNume;
        $config['per_page'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<div class="page">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="pagenum">';
        $config['num_tag_close'] = '</span>';
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        $this->pagination->initialize($config);
        $data=$this->Blog_model->get_hotindex($page,$config['per_page'],$str);
        $rs["blog"]=$data;
        if($this->session->userdata("login_on")=="TRUE"){
            $this->load->view("blog/loginhotlearn.php",$rs);
        }else{
            $this->load->view("blog/hotlearn.php",$rs);
        }
    }
    //加载写blog页面
    public function writeblog(){
        if($this->session->userdata("login_on")=="TRUE"){
            $this->load->view("blog/writeBlog.php");
        }else{
            redirect("blog/blog/index");
        }
    }
    //加载blog详情页
    public function detail(){
        $index=$this->uri->segment(4)==null?1:$this->uri->segment(4);
        //判断数据库blog表中最大的id
        $rs=$this->Blog_model->all_num();

       if((int)$index>=(int)$rs[0]->bid){
           $index=$rs[0]->bid;
       }
        //hits增加
        $this->Blog_model->add_hits($index);
        //获取帖子的信息
        $rs=$this->Blog_model->get_detail($index);
        //获取帖子回复的信息
        $result=$this->Blog_model->do_getComment($index,0);
        $arr["blog"]=$rs[0];
        $arr["result"]=$result;
        $this->load->view("blog/detail.php",$arr);
    }
    //取得多级评论
    public function get_moreComment(){
        $index=$this->input->post("index");
        $flag=$this->input->post("flag");
        $result=$this->Blog_model->do_getComment($index,(int)$flag);
        echo  json_encode($result);

    }
    //将发表blog页面数据写入数据库
    public function writeData(){
        header('Access-Control-Allow-Origin:*');
        $title=$this->input->post("title");
        $content=$this->input->post("content");
        $classfy=$this->input->post("classfy");
        $wid=$this->session->userdata("uid");
        $time=date("Y-m-d H:i:s");
        $arr=[
            "wid"=>$wid,
            "title"=>$title,
            "content"=>$content,
            "classfy"=>$classfy,
            "time"=>$time
        ];
        $rs=$this->Blog_model->do_write($arr);
        if($rs){
            echo "success";
        }else{
            echo "error";
        }
    }
    //将回复的内容写入数据库
    public function writeReply(){
        $bid=$this->input->post("bid");
        $rid=$this->input->post("wid");
        $content=$this->input->post("content");
        $time=date("Y-m-d H:i:s");
        $wid=$this->session->userdata("uid");
        $rrid=$this->input->post("rrid")==null?"0":$this->input->post("rrid");
        $arr=[
            "bid"=>$bid,
            "wid"=>$wid,
            "content"=>$content,
            "time"=>$time,
            "rid"=>$rid,
            "rrid"=>$rrid,
            "flag"=>1,
        ];
        $rs=$this->Blog_model->do_writeReply($arr);
        if($rrid=="0"){
            //如果是对帖子的直接评论，则帖子的评论数加一
            $this->Blog_model->add_replynum($bid);
        }else{
            //如果是对帖子的评论的评论，则改变评论表的commmentnum
            $this->Blog_model->add_commentnum($rrid);
        }
        if($rs){
            echo "success";
        }else{
            echo "error";
        }
    }
    //加载个人发帖详情页
    public function myblog(){
        if($this->session->userdata("login_on")=="TRUE"){
            $index=$this->session->userdata("uid");
            //先提取当前用户一共发表了多少帖子
            $num=$this->Blog_model->do_getPernum($index);
            $page= $this->uri->segment(4)==null?1:$this->uri->segment(4);
            $this->load->library('pagination');
            $url=site_url("blog/Blog/myblog");
            $config['base_url'] = $url;
            $config['total_rows'] = $num;
            $config['per_page'] = 5;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<div class="page">';
            $config['full_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="pagenum">';
            $config['num_tag_close'] = '</span>';
            $config['first_link'] = '第一页';
            $config['prev_link'] = '上一页';
            $config['next_link'] = '下一页';
            $config['last_link'] = '最后一页';
            $this->pagination->initialize($config);
            $maxPage=(int)($num/$config['per_page']+1);
            $page=$page>$maxPage?$maxPage:$page;
            $data=$this->Blog_model->do_getblog($page,$config['per_page'],$index);
            $arr["myblog"]=$data;
            $this->load->view("blog/commentblog",$arr);
        }else{
            redirect("blog/blog/index");
        }
    }
    //加载个人回复页面
    public function commentblog(){
        if($this->session->userdata("login_on")=="TRUE"){
            $index=$this->session->userdata("uid");
            //先提取当前用户发表的帖子共有多少未读的回复
            $rs=$this->Blog_model->do_getblog_comment($index);
            $nrs=$this->objarray_to_array($rs);
            //获取当前用户回复的回复
            $rs1=$this->Blog_model->do_comment_comment($index);
            $nrs1=$this->objarray_to_array($rs1);
            $result=[];
            //将用户回复的回复从嵌套数组变成普通数组
            foreach($nrs1 as $key=>$value){
                if(count($value)!=0){
                    foreach ($value as $k=>$v){
                        $result[]=$value[$k];
                    }
                }else{
                    $result[]=$value;
                }
            };
            $result=array_merge($nrs,$result);
            //将合并的数组按时间顺序排序
            foreach($result as $key=>$v){
                $result[$key]['time'] = date("YmdHis",strtotime($v['time']));
            }
            $datetime = array();
            foreach ($result as $user) {
                $datetime[] = $user['time'];
            }
            array_multisort($datetime,SORT_DESC,$result);
            foreach($result as $key=>$v){
                $result[$key]['time'] = date("Y-m-d H:i:s",strtotime($v['time']));
            }
            $arr["myblog"]=$result;
            $this->load->view("blog/myblog",$arr);
        }else{
            redirect("blog/blog/index");
        }
    }
    //将对象转化成数组
    public function objarray_to_array($obj) {
        $ret = array();
        foreach ($obj as $key => $value) {
            if (gettype($value) == "array" || gettype($value) == "object"){
                $ret[$key] =  $this->objarray_to_array($value);
            }else{
                $ret[$key] = $value;
            }
        }
        return $ret;
    }
    //将未读标志位变成已读
    public function change_flag(){
        $replayid=$this->input->post("replayid");
        $rs=$this->Blog_model->do_change_flag($replayid);
        if($rs){
            echo "success";
        }else{
            echo "error";
        }
    }

}





?>