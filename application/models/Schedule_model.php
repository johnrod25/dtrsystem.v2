<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedule_model extends CI_Model {
    function insert_schedule($data, $sched, $id) {
        $this->db->insert("schedule_tbl",$data);
        $this->db->insert_id();
        $this->db->where('rfid', $id);
        return $this->db->update("staff_tbl",$sched);
    }

    function select_schedule () {
        $qry=$this->db->get('schedule_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_fullname () {
        $this->db->order_by('staff_tbl.id','DESC');
        $this->db->where('schedule', NULL);
        $this->db->select("*");
        $this->db->from("staff_tbl");
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_schedule_byID($id) {
        $this->db->where('id',$id);
        $qry=$this->db->get('schedule_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }
    function select_schedule_tapcard_byID($id) {
        $this->db->where('staff_id',$id);
        $qry=$this->db->get('schedule_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function delete_schedule($id) {
        $this->db->where('id', $id);
        $this->db->delete("schedule_tbl");
        return $this->db->affected_rows();
    }

    function update_schedule($data,$id) {
        $this->db->where('id', $id);
        return $this->db->update('schedule_tbl',$data);
        $this->db->affected_rows();
    }

}