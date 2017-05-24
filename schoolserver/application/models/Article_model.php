<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends CI_Model
{
    public function get_article($type,$index){
        $query = $this->db->select('*')->from('article')->where('type',$type)->limit(10,$index)->get();
        return $query->result();
    }
    public function update_hit($aid){
        $query = $this->db->set('article_hits','article_hits+1',false)->where('article_id',$aid)->update('article');
        return $query;
    }
    public function show_article($aid){
        $query = $this->db->get_where('article',array('article_id'=>$aid));
        return $query->row();
    }
    public function get_all_article($type){
        $query = $this->db->get_where('article',array('type'=>$type));
        return $query->result();
    }
    public function get_test_data(){
        return $this->db->get('test')->result();
    }
    public function insert_sight($title,$content,$type,$add_time,$imgName){
        $data = array(
            'article_title'=>$title,
            'article_content'=>$content,
            'type'=>$type,
            'add_time'=>$add_time,
            'show_img'=>$imgName
        );
        $this->db->insert('article',$data);
    }
}