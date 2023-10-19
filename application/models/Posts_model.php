<?php

class Posts_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_posts(){
        $query = $this->db->get('post');
        return $query->result_array();
    }

    public function get_posts_search($param){
        $this->db->like('title', $param);
        $query = $this->db->get('post');
        return $query->result_array();
    }

    public function get_posts_single($param) {
        // $this->db->where('id', $param);
        // $result = $this->db->get('post');
        $result = $this->db->get_where('post', array('slug'=> $param));
        return $result->result_array();
    }

    public function get_posts_edit($param) {
        $result = $this->db->get_where('post', array('id'=> $param));
        return $result->result_array();
    }

    public function insert_post() {
        $data = array(
            'user_id' => $this->session->id,
            'title' => $this->input->post('title'),
            'slug' => url_title($this->input->post('title'), '-', true),
            'body' => $this->input->post('body')
        );
        return $this->db->insert('post', $data);
    }

    public function update_post() {
        $id = $this->input->post('id');
        $data = array(
        'title' => $this->input->post('title'),
        'body' => $this->input->post('body')
        );
        $this->db->where('id', $id);
        return $this->db->update('post', $data);
    }
    
    public function delete_post() {
        $id = $this->input->post('modal-id');
        $this->db->where('id', $id);
        $this->db->delete('post');
        return true;
    }

    public function login(){
        $this->db->where('username', $this->input->post('username', true));
        $this->db->where('password', $this->input->post('password', true));
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return $result->row_array();
        }else{
            return false;
        }
    }

}

?>