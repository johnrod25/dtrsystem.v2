<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    function logindata($un,$pw)
    {
        $this->db->where('username',$un);               
        $this->db->where('password',$pw);
        $this->db->select("staff_tbl.*,login_tbl.* ");
        $this->db->from("login_tbl");
        $this->db->join("staff_tbl",'login_tbl.rfid=staff_tbl.rfid');
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function insert_login($data)
    {
        $this->db->insert("login_tbl",$data);
        return $this->db->insert_id();
    }

    function update_login($data,$rfid)
    {
        $this->db->where('rfid', $rfid);
        $this->db->update('login_tbl',$data);
    }

    function delete_login_byID($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("login_tbl");
        $this->db->affected_rows();
    }

}