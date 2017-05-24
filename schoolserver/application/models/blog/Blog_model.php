<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {
    //构造函数
    private $arr;
    public function __construct(){
        parent::__construct();
    }
    //提取数据库中blog表的数量
    public function do_getAllnum(){
        return $this->db->count_all('blog');
    }
    //显示首页内容
    public function get_index($page,$perpage){
        $this->db->limit($perpage,($page-1)*$perpage);
        $this->db->select("*");
        $this->db->from("blog");
        $this->db->join("userinfor","blog.wid=userinfor.wid");
        $this->db->where("blog.checked=1");
        $this->db->order_by('time', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }
    //显示校园要闻内容
    public function get_hotindex($page,$perpage,$con){
        $this->db->limit($perpage,($page-1)*$perpage);
        $this->db->select("*");
        $this->db->from("blog");
        $this->db->join("userinfor","blog.wid=userinfor.wid");
        $this->db->where("blog.checked=1");
        $this->db->where("classfy='$con'");
        $this->db->order_by('hits','DESC');
        $query=$this->db->get();
        return $query->result();
    }
    public function do_getClassfyNum($con){
        $this->db->where("classfy='$con'");
        $this->db->from('blog');
        return $this->db->count_all_results();
    }
    //显示详情页的内容
    public function get_detail($index){
        $this->db->select("*");
        $this->db->from("blog");
        $this->db->where('bid', $index);
        $this->db->join("userinfor","blog.wid=userinfor.wid");
        $query=$this->db->get();
        return $query->result();
    }
    //点击详情页，hits增加
    public function add_hits($index){
        $sql='update blog set hits=hits+1 where bid='.$index;
        $this->db->query($sql);
    }
    //判断blog表中共有多少条数据
    public function all_num(){
        $this->db->limit(1);
        $this->db->select("*");
        $this->db->from("blog");
        $this->db->order_by('bid', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }
    //将发表的bolg信息写入数据库
    public function do_write($arr){
        $this->db->insert("blog",$arr);
        return $this->db->affected_rows();
    }
    //将回复的信息写入数据库
    public function do_writeReply($arr){
        $this->db->insert("blogcomment", $arr);
        return $this->db->affected_rows();
    }
    //h回复的时候将评论数增加
    public function add_replynum($index){
        $sql='update blog set replynum=replynum+1 where bid='.$index;
        $this->db->query($sql);
    }
    //改变帖子评论的commentnum
    public function add_commentnum($index){
        $sql='update blogcomment set commentnum="1" where replayid='.$index;
        $this->db->query($sql);
    }
    //获取帖子的回复信息
    public function do_getComment($index,$pflag){
        $this->db->select("*");
        $this->db->from("userinfor");
        $this->db->join("blogcomment","userinfor.wid=blogcomment.wid");
        $this->db->where("blogcomment.bid=$index");
        $this->db->where("rrid='$pflag'");
        $query=$this->db->get();
        foreach($query->result() as $key=>$value){
            $this->arr[]=$value;
            $this->do_getComment($index,$value->replayid);
        };
        return $this->arr;
    }
    //获取每个用户的发帖数量
    public function do_getPernum($index){
        $this->db->where("wid",$index);
        $this->db->from("blog");
        return $this->db->count_all_results();
    }
    //获取每个用户发帖的内容
    public function do_getblog($page,$perpage,$index){
        $this->db->limit($perpage,($page-1)*$perpage);
        $this->db->select("*");
        $this->db->from("blog");
        $this->db->where("wid",$index);
        $query=$this->db->get();
        return $query->result();
    }
    //获取每个用户发帖的回复
    public function do_getblog_comment($index){
        $sql="select * from blogcomment join userinfor where blogcomment.rid='$index' and blogcomment.rrid='0' and blogcomment.wid=userinfor.wid";
        $query=$this->db->query($sql);
        return $query->result();
    }
    //获取每个用户回复的回复
    public function do_comment_comment($index){
        $arr=[
            "wid"=>$index
        ];
        $query=$this->db->get_where("blogcomment",$arr);
        $rs=$query->result();
        $result=[];
        for($i=0;$i<count($rs);$i++){
            $index=$rs[$i]->replayid;
            $sql="select * from blogcomment join userinfor where blogcomment.rrid='$index'and blogcomment.wid=userinfor.wid";
            $newquery=$this->db->query($sql);
            if(!$newquery->result()==null){
                $result[]=$newquery->result();
            }
        }
        return $result;
    }
    //改变未读的标志位
    public function do_change_flag($index){
        $data = array(
            "flag"=>"0"
        );
        $this->db->where('replayid', $index);
        $this->db->update('blogcomment', $data);
        return $this->db->affected_rows();
    }



}

?>