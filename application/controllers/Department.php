<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

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
        $data['department']=$this->Department_model->select_department();
        $this->load->view('admin/header');
        $this->load->view('admin/department',$data);
        $this->load->view('admin/footer');
    }

    public function insert()
	{
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('department_name', 'Department name', 'required');
            $this->form_validation->set_rules('department_desc', 'Department description', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if ($this->Department_model->insert_department($ajax_data)) {
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
