<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message_model extends CI_Model
{
    public function send_msg($content,$sid,$rid){
        $now = date("Y-m-d H-m-s");
        $data = array(
            'mcontent'=>$content,
            'sid'=>$sid,
            'rid'=>$rid,
            'time'=>$now
        );
        $query = $this->db->insert('message',$data);
        return $query;
    }
    public function get_message($index,$rid){
        $this->db->select('*');
        $this->db->from('message');
        $this->db->join('user','user.uid=message.sid');
        $this->db->where('rid',$rid);
        $this->db->limit(10,$index);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_send_message($index,$sid){
        $this->db->select('*');
        $this->db->from('message');
        $this->db->join('user','user.uid=message.rid');
        $this->db->where('sid',$sid);
        $this->db->limit(10,$index);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_message($rid){
        $this->db->from('message');
        $this->db->where('rid',$rid);
        return $this->db->count_all_results();
    }
    public function count_send_message($sid){
        $this->db->from('message');
        $this->db->where('sid',$sid);
        return $this->db->count_all_results();
    }
    public function update_msg($mid){
        $this->db->set('isread',1);
        $this->db->where('mid',$mid);
        $this->db->update('message');
    }
    public function msg_detail($mid){
        $this->db->select('*');
        $this->db->from('message');
        $this->db->join('user','user.uid=message.sid');
        $this->db->where('mid',$mid);
        $query = $this->db->get();
        return $query->row();
    }
}