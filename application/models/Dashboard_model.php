<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    function select_attendance(){
        $this->db->order_by('attendance_tbl.id','DESC');
        $this->db->select("*");
        $this->db->from("attendance_tbl");
        $qry=$this->db->get();
        $result=$qry->result_array();
        return $result;
    }

    function attendance_today($date){
        $this->db->order_by('attendance_tbl.id','DESC');
        $this->db->select("*");
        $this->db->where("log_date >= ",$date);
        $this->db->from("attendance_tbl");
        $qry = $this->db->get();
        $result=$qry->result_array();
        return $result;
    }

}