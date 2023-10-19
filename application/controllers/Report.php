<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function index()
    {
        $data['content']=$this->Staff_model->select_staff();
        $data['department']=$this->Staff_model->select_departments();
        $this->load->view('admin/header');
        $this->load->view('admin/report',$data);
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
				if ($this->Staff_model->insert_staff($ajax_data)) {
					$data = array('response' => "success", 'message' => "Data added successfully");
				} else {
					$data = array('response' => "error", 'message' => "Failed");
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
				$data = array('response' => "error", 'message' => "failed");
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
			if ($this->Staff_model->delete_staff($del_id)) {
				$data = array('response' => "success", 'message' => 'Deleted successfully');
			} else {
				$data = array('response' => "error", 'message' => 'Failed');
			}
			echo json_encode($data);
		}
	}


}
