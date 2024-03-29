<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }

    // public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->helper(array('form', 'url'));
	// 	$this->load->library(array('form_validation'));
	// 	$this->load->model('staff_model');
	// }

    public function index()
    {
        $data['content']=$this->Staff_model->select_staff();
        $data['department']=$this->Staff_model->select_departments();
        $this->load->view('admin/header');
        $this->load->view('admin/employee',$data);
        $this->load->view('admin/footer');
    }

    public function insert()
	{
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('rfid', 'RFID', 'required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'required');
            $this->form_validation->set_rules('midname', 'Middlename', 'required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required');
            $this->form_validation->set_rules('dob', 'Date of birth', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('civil_status', 'Civil status', 'required');
            $this->form_validation->set_rules('department_id', 'Department', 'required');
            $this->form_validation->set_rules('number', 'Mobile', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address', 'Address', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				$rfid = $this->input->post('rfid');
				$lastname = $this->input->post('lastname');
                $firstname = $this->input->post('firstname');
                $midname = $this->input->post('midname');
				$dob = $this->input->post('dob');
				$email = $this->input->post('email');
				$password = $lastname.$firstname[0].$midname[0].date('Y', strtotime($dob));
				if($this->Staff_model->insert_staff_check_rfid($rfid)){
					$data = array('response' => "error", 'message' => "RFID already taken.");
				}else{
					if ($this->Staff_model->insert_staff($ajax_data)) {
						$this->Home_model->insert_login(array('rfid'=>$rfid, 'username'=>$email, 'password'=>$password, 'usertype'=>2, 'status'=>1));
						$data = array('response' => "success", 'message' => "Data added successfully");
					} else {
						$data = array('response' => "error", 'message' => "Failed");
					}
				}
			}
			echo json_encode($data);
		} else {
			echo "'No direct script access allowed'";
		}
	}

    public function edit()
	{
		if ($this->input->is_ajax_request()) {
			$this->input->post('edit_id');
			$edit_id = $this->input->post('edit_id');
			if ($post = $this->Staff_model->select_staff_byID($edit_id)) {
				$data = array('response' => "success", 'post' => $post);
			} else {
				$data = array('response' => "error", 'message' => "Edit failed");
			}
			echo json_encode($data);
		}
	}
    
    public function update()
	{
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('rfid', 'RFID', 'required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'required');
            $this->form_validation->set_rules('midname', 'Middlename', 'required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required');
			$this->form_validation->set_rules('dob', 'Date of birth', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('civil_status', 'Civil status', 'required');
            $this->form_validation->set_rules('department_id', 'Department', 'required');
            $this->form_validation->set_rules('number', 'Mobile', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('address', 'Address', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
				$id = $this->input->post('id');
                $rfid = $this->input->post('rfid');
				$rfid2 = $this->input->post('rfid2');
				$lastname = $this->input->post('lastname');
                $firstname = $this->input->post('firstname');
                $midname = $this->input->post('midname');
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $civil_status = $this->input->post('civil_status');
                $department_id = $this->input->post('department_id');
                $number = $this->input->post('number');
				$email = $this->input->post('email');
                $address = $this->input->post('address');

				if ($this->Staff_model->update_staff(array('rfid'=>$rfid,'lastname'=>$lastname,'firstname'=>$firstname,'midname'=>$midname,'dob'=>$dob,'gender'=>$gender,'civil_status'=>$civil_status,'department_id'=>$department_id,'number'=>$number,'email'=>$email, 'address'=>$address), $id)) {
					$this->Schedule_model->update_schedule_staff(array('staff_id'=>$rfid), $rfid2);
					$this->Attendance_model->update_staff_attendance(array('rfid'=>$rfid), $rfid2);
					$this->Home_model->update_login(array('rfid'=>$rfid), $rfid2);
					$data = array('response' => "success", 'message' => "Staff updated successfully");
				} else {
					$data = array('response' => "error", 'message' => "Failed to update staff");
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
			if ($this->Staff_model->delete_staff($del_id)) {
				$data = array('response' => "success", 'message' => 'Deleted successfully');
			} else {
				$data = array('response' => "error", 'message' => 'Failed');
			}
			echo json_encode($data);
		}
	}

	public function profile()
    {
        $data['content']=$this->Staff_model->select_staff();
        $data['department']=$this->Staff_model->select_departments();
        $this->load->view('staff/header');
        $this->load->view('staff/profile',$data);
        $this->load->view('staff/footer');
    }


}
