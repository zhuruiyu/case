<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_model extends CI_Model
{
    public function get_catalog($father){
        $query = $this->db->get_where('catalog',array('father'=>$father));
        return $query->result();
    }
    public function add_good($title,$content,$cid,$uid,$src,$fimg,$price){
        $now = date("Y-m-d H:i:s");
        $data = array(
            'gtitle'=>$title,
            'gcontent'=>$content,
            'cid'=>$cid,
            'uid'=>$uid,
            'time'=>$now,
            'imgSrc'=>$src,
            'first_img'=>$fimg,
            'price'=>$price
        );
        $query = $this->db->insert('goods',$data);
        return $query;
    }
    public function add_img($imgName,$imgSrc,$imgPath){
        $data = array(
            'imgName'=>$imgName,
            'imgSrc'=>$imgSrc,
            'imgPath'=>$imgPath
        );
        $query = $this->db->insert('img',$data);
        return $query;
    }
    public function get_good_father($cid){
        $query = $this->db->query("select * from goods where cid in(
	select cid from catalog where father in (
		select cid from catalog where father = '$cid'
) 
) order by time desc limit 6 ");
        return $query->result();
    }
    public function get_good_latest(){
        $this->db->select('*');
        $this->db->from('goods');
        $this->db->limit(5);
        $this->db->order_by('time','DESC');
        $query  =$this->db->get();
        return $query->result();
    }
    public function get_good_detail($gid){
        $this->db->select('*');
        $this->db->from('goods');
        $this->db->join('user',"user.uid=goods.uid");
        $this->db->join('img',"img.imgSrc=goods.imgSrc");
        $this->db->where('gid',$gid);
        $query = $this->db->get();
        return $query->result();
    }
    public function update_hits($gid){
        $this->db->query("update goods set hits = hits+1 where gid = '$gid'");
    }
    public function get_my_goods($uid,$index,$per_page){
        $query = $this->db->select('*')->from('goods')->where('uid',$uid)->limit($per_page,$index)->get();
        return $query->result();
    }
    public function my_goods_num($uid){
        $query = $this->db->where('uid',$uid)->from('goods')->count_all_results();
        return $query;
    }
    public function del_my_good($gid){
        $query = $this->db->where('gid',$gid)->delete('goods');
        return $query;
    }
    public function del_img($gid){
        $query = $this->db->select('imgSrc')->from('goods')->where('gid',$gid)->get();
        $src = $query->row()->imgSrc;
        $query2 = $this->db->select('*')->from('img')->where('imgSrc',$src)->get();
//        echo "<pre>";
//        var_dump($query2->result());
//        die();
        $this->db->delete('img',array('imgSrc'=>$src));
        return $query2->result();
    }
    public function edit_my_good($gid,$title,$content){
        $now = date("Y-m-d H:i:s");
        $query = $this->db->where('gid',$gid)->update('goods',array('gtitle'=>$title,'gcontent'=>$content,'time'=>$now));
        return $query;
    }
    public function get_father_catalog($grand){
        $query = $this->db->query("select * from catalog where father in(
	      select cid  from catalog where father = '$grand'
        )");
        return $query->result();
    }
    public function show_goods($cid){
        $query = $this->db->select('*')->from('goods')->where('cid',$cid)->get();
        return $query->result();
    }
    public function get_good_tip($keyword){
        $query = $this->db->select('*')->from('goods')->like('gtitle',$keyword)->limit(5)->get();
        return $query->result();
    }
}