<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password)
    {
        return $this->db->select('*')->from('user')->where('user',$username)->where('password',$password)->where('admin',1)
            ->get()->result();
    }
    public function get_user($index,$perPage){
        return $this->db->select('*')->from('user')->limit($perPage,$index)->get()->result();
    }
    public function count_all_user(){
        return $this->db->count_all('user');
    }

}
?>