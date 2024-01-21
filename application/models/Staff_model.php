<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model {

    function select_staff(){
        $this->db->order_by('staff_tbl.id','DESC');
        $this->db->select("staff_tbl.*,department_tbl.department_name");
        $this->db->from("staff_tbl");
        $this->db->join("department_tbl",'department_tbl.id=staff_tbl.department_id');
        $qry=$this->db->get();
        // if($qry->num_rows()>0)
        // {
            $result=$qry->result_array();
            return $result;
        // }
    }
    
    function insert_staff($data){
        $this->db->insert("staff_tbl",$data);
        return $this->db->insert_id();
    }

    function insert_staff_check_rfid($rfid){
        $this->db->where('rfid', $rfid);
        $this->db->select("*");
        $this->db->from("staff_tbl");
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            return true;
        }else{
            return false;
        }
    }

    public function update_staff($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('staff_tbl', $data);
        $this->db->affected_rows();
    }

    public function delete_staff($id)
    {
        return $this->db->delete('staff_tbl', array('id' => $id));
    }

    function select_departments ()
    {
        $qry=$this->db->get('department_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }
    
    function select_staff_byID($id)
    {
        $this->db->where('id',$id);
        $this->db->select("*");
        $this->db->from("staff_tbl");
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }
    function select_staff_byRFID($id)
    {
        $this->db->where('rfid',$id);
        $this->db->select("*");
        $this->db->from("staff_tbl");
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

}