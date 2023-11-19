<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance_model extends CI_Model {
    function insert_schedule($data) {
        $this->db->insert("schedule_tbl",$data);
        return $this->db->insert_id();
    }

    function insert_attendance($data) {
        $this->db->insert("attendance_tbl",$data);
        return $this->db->insert_id();
    }

    function insert_image($data) {
        $this->db->insert("image_tbl",$data);
        return $this->db->insert_id();
    }

    function select_attendance () {
        $qry=$this->db->get('attendance_tbl');
        $result=$qry->result_array();
        return $result;
    }

    function select_attendance_img () {
        $qry=$this->db->get('image_tbl');
        $result=$qry->result_array();
        return $result;
    }

    function select_attendance_img_byRfid($rfid) {
        $this->db->where('rfid',$rfid);
        $qry=$this->db->get('image_tbl');
        $result=$qry->result_array();
        return $result;
    }

    function select_attendance_imgggg(){
        $this->db->order_by('attendance_tbl.id','DESC');
        $this->db->select("attendance_tbl.*,image_tbl.*");
        $this->db->from("attendance_tbl");
        
        $qry=$this->db->get();
        // if($qry->num_rows()>0)
        // {
            $result=$qry->result_array();
            return $result;
        // }
    }

    function select_attendance_byMonth ($id, $date) {
        $this->db->order_by('id','DESC');
        $this->db->where('rfid',$id);
        echo date('n', strtotime('log_date'))."  -  ".$date."  -  ".$id;
        $month = date('n', strtotime('log_date'));
        $this->db->where($month.'>=',$date);
        //$this->db->where(date('n', strtotime('log_date')).'<=',($date+1));
        $qry=$this->db->get('attendance_tbl');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_attendance_byAll($start_date, $end_date) {
        $this->db->order_by('id','DESC');
        $this->db->where("log_date >= ",$start_date);
        $this->db->where("log_date <= ",$end_date);
        $qry=$this->db->get('attendance_tbl');
            $result=$qry->result_array();
            return $result;
    }

    function select_attendance_byRfid($rfid, $start_date, $end_date) {
        $this->db->order_by('id','DESC');
        $this->db->where('rfid',$rfid);
        $this->db->where("log_date >= ",$start_date);
        $this->db->where("log_date <= ",$end_date);
        $qry=$this->db->get('attendance_tbl');
            $result=$qry->result_array();
            return $result;
    }

    function select_attendance_byID($id) {
        $this->db->order_by('id','DESC');
        $this->db->where('rfid',$id);
        //$this->db->where("log_date >= ",$date);
        $qry=$this->db->get('attendance_tbl');
            $result=$qry->result_array();
            return $result;
    }

    function select_attendance_byIDate($id,$date) {
        $this->db->order_by('id','DESC');
        $this->db->where('rfid',$id);
        $this->db->where("log_date >= ",$date);
        $qry=$this->db->get('attendance_tbl');
            $result=$qry->result_array();
            return $result;
    }

    function update_attendance($data,$id,$date) {
        $this->db->where('rfid', $id);
        $this->db->where("log_date >= ",$date);
        return $this->db->update('attendance_tbl',$data);
        $this->db->affected_rows();
    }

    function update_image($data,$id,$date) {
        $this->db->where('rfid', $id);
        $this->db->where("log_date >= ",$date);
        return $this->db->update('image_tbl',$data);
        $this->db->affected_rows();
    }


    function update_staff_attendance($data,$id) {
        $this->db->where('rfid', $id);
        return $this->db->update('attendance_tbl',$data);
        $this->db->affected_rows();
    }

    function select_fullname () {
        $this->db->order_by('staff_tbl.id','DESC');
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