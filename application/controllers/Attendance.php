<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	// function __construct()
    // {
    //     parent::__construct();
    //     if ( ! $this->session->userdata('logged_in'))
    //     { 
    //         redirect(base_url().'login');
    //     }
    // }
	
    public function index()
    {
		if ( ! $this->session->userdata('logged_in')) { 
            redirect(base_url('login'));
        } else {
            if($this->session->userdata('usertype')==1) {
				$data['attendance']=$this->Attendance_model->select_attendance();
				$data['fullname']=$this->Schedule_model->select_fullname();
				$this->load->view('admin/header');
				$this->load->view('admin/attendance',$data);
				$this->load->view('admin/footer');
			} else{
				$staff=$this->session->userdata('rfid');
				$data['attendance']  = $this->Attendance_model->select_attendance_byID($staff);
				$this->load->view('staff/header');
				$this->load->view('staff/attendance',$data);
				$this->load->view('staff/footer');
			}   
		}
    }

	public function insert()
	{
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('id', 'RFID', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = array('response' => "error", 'message' => validation_errors());
            } else {
				date_default_timezone_set('Asia/Manila');
				$timestamp = time();
                $id = $this->input->post('id');
				$time = date('H:i:s', $timestamp);
				$date = date('Y-m-d', $timestamp); 
				$attendance = $this->Attendance_model->select_attendance_byIDate($id, $date);
				//print_r($attendance);
				$schedule = $this->Schedule_model->select_schedule_tapcard_byID($id);
				$currentHour = date('H', $timestamp);
				if ($currentHour < 12) {
					$time_in = 'morning_in';
					$time_out = 'morning_out';
				} else {
					$time_in = 'afternoon_in';
					$time_out = 'afternoon_out';
				}
                if($schedule != NULL){
					if($attendance == NULL){
						$sched = $schedule[0][$time_in];
						$diff = strtotime("$time")-strtotime($sched);
						 //echo "time: ".strtotime($time)." - ".strtotime("$sched")." = ".$diff.$time_in;
						if($diff <=3600 && $diff >= -3600 ){
							$this->Attendance_model->insert_attendance(array('rfid'=>$id, 'fullname'=>$schedule[0]['fullname'], $time_in=>$time, 'log_date'=>$date));
							$data = array('response' => "success", 'message' => "Successfully Time In", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
						}else{
							$data = array('response' => "error", 'message' => "Please Check Your Schedule First", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
						}
					}else{
						if($attendance[0][$time_in] == NULL){
							$sched = $schedule[0][$time_in];
							$diff = strtotime($time)-strtotime($sched);
							if($diff <=3600 && $diff >= -3600 ){
								$this->Attendance_model->insert_attendance(array('rfid'=>$id, 'fullname'=>$schedule[0]['fullname'], $time_in=>$time));
								$data = array('response' => "success", 'message' => "Successfully Time In", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
							}else{
								$data = array('response' => "error", 'message' => "Please Check Your Schedule First", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
							}
						}else{
							if($attendance[0][$time_out] == NULL){
							$sched = $schedule[0][$time_out];
							$diff = strtotime($time)-strtotime($sched);
							if($diff <=3600 && $diff >= -3600 ){
							$this->Attendance_model->update_attendance(array($time_out => $time), $id,$date);
							$data = array('response' => "success", 'message' => "Successfully Time Out", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
							}
							else{
								$data = array('response' => "error", 'message' => "You Already Time In", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
							}
							}else{
								$data = array('response' => "error", 'message' => "You Already Time Out", 'rfid'=> $id, 'fullname'=> $schedule[0]['fullname']);
							}
						}
					}
                }else{
					$data = array('response' => "error", 'message' => "RFID Not Registered");
                }
            }
            echo json_encode($data);
    }else {
        echo "'No direct script access allowed'";
    }
	}

    public function edit()
	{
		if ($this->input->is_ajax_request()) {
			$this->input->post('edit_id');
			$edit_id = $this->input->post('edit_id');
			if ($post = $this->Department_model->select_department_byID($edit_id)) {
				$data = array('response' => "success", 'post' => $post);
			} else {
				$data = array('response' => "error", 'message' => "failed");
			}
			echo json_encode($data);
		}
	}
    
    public function update() {
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('department_name', 'Department name', 'required');
            $this->form_validation->set_rules('department_desc', 'Department description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
                $id = $this->input->post('id');
                $department_name = $this->input->post('department_name');
                $department_desc = $this->input->post('department_desc');
				if ($this->Department_model->update_department(array('department_name' => $department_name, 'department_desc' => $department_desc), $id)) {
					$data = array('response' => "success", 'message' => "Data update successfully");
				} else {
					$data = array('response' => "error", 'message' => "Failed");
				}
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}

    public function delete() {
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');
			if ($this->Department_model->delete_department($del_id)) {
				$data = array('response' => "success", 'message' => 'Deleted successfully');
			} else {
				$data = array('response' => "error", 'message' => 'Failed');
			}
			echo json_encode($data);
		}
	}
}
