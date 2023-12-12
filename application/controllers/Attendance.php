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
			$this->form_validation->set_rules('taptime', 'Select Time', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = array('response' => "error", 'message' => validation_errors());
            } else {
				date_default_timezone_set('Asia/Manila');
				//$timestamp = time();
				$timestamp = time();
                $id = $this->input->post('id');
				$taptime = $this->input->post('taptime');
				// $taptime = $this->input->post('taptime');
				// $time = date("h:i:sa", $this->input->post('time'));
				$date = date("Y/m/d"); 
				$time = $this->input->post('time');
				// $date = $this->input->post('date'); 
				$attendance = $this->Attendance_model->select_attendance_byIDate($id, $date);
				
				$staff = $this->Staff_model->select_staff_byRFID($id);
				
				$imageData = $this->input->post('imageData');
				// Decode the base64-encoded image data
				$imageData = str_replace('data:image/png;base64,', '', $imageData);
				$imageData = str_replace(' ', '+', $imageData);
				$imageData = base64_decode($imageData);
				// Generate a unique filename for the image
				$filename = uniqid('image_') . '.png';

                if($staff != NULL){
					$fullname = $staff[0]['firstname']." ".$staff[0]['midname']." ".$staff[0]['lastname'];
					if($attendance == NULL || $attendance == ''){
						$this->Attendance_model->insert_attendance(array('rfid'=>$id, 'fullname'=>$fullname, $taptime=>$time, 'log_date'=>$date));
						$this->Attendance_model->insert_image(array('rfid'=>$id, 'fullname'=>$fullname, $taptime=>$filename, 'log_date'=>$date));
						file_put_contents('./assets/dist/img/attendance/' . $filename, $imageData);

						$data = array('response' => "success", 'message' => "Successfully Time In/Out", 'rfid'=> $id, 'fullname'=> $fullname);
					}else{
						if($attendance[0][$taptime] == NULL || $attendance[0][$taptime] == ''){
							$this->Attendance_model->update_attendance(array($taptime => $time), $id,$date);
							$this->Attendance_model->update_image(array($taptime=>$filename), $id,$date);
							file_put_contents('./assets/dist/img/attendance/' . $filename, $imageData);
							$data = array('response' => "success", 'message' => "Successfully Time In/Out", 'rfid'=> $id, 'fullname'=> $fullname);
						}else{
							$data = array('response' => "error", 'message' => "You Already Time In/Out", 'rfid'=> $id, 'fullname'=> $fullname);
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
