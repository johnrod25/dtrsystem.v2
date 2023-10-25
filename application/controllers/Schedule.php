<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }
    
    public function index()
    {
        $data['schedule']=$this->Schedule_model->select_schedule();
        $data['fullname']=$this->Schedule_model->select_fullname();
        $this->load->view('admin/header');
        $this->load->view('admin/schedule',$data);
        $this->load->view('admin/footer');
    }

    public function insert()
	{
        if ($this->input->is_ajax_request()) {
        $this->form_validation->set_rules('staff_rfid', 'Employee Name', 'required');
        $this->form_validation->set_rules('morning_in', 'Morning In', 'required');
        $this->form_validation->set_rules('morning_out', 'Morning Out', 'required');
        $this->form_validation->set_rules('afternoon_in', 'Afternoon In', 'required');
        $this->form_validation->set_rules('afternoon_out', 'Afternoon Out', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data = array('response' => "error", 'message' => validation_errors());
        } else {
            $id=$this->input->post('staff_rfid');
            $name=$this->Staff_model->select_staff_byRFID($id);
            $fullname = $name[0]['firstname']." ".$name[0]['midname']." ".$name[0]['lastname'];
            $morning_in=$this->input->post('morning_in');
            $morning_out=$this->input->post('morning_out');
            $afternoon_in=$this->input->post('afternoon_in');
            $afternoon_out=$this->input->post('afternoon_out');
            if($this->Schedule_model->insert_schedule(array('staff_id'=>$id, 'fullname'=>$fullname, 'morning_in'=>$morning_in, 'morning_out'=>$morning_out, 'afternoon_in'=>$afternoon_in, 'afternoon_out'=>$afternoon_out ), array('schedule'=>1), $id)) {
            $data = array('response' => "success", 'message' => "Schedule added successfully");
        }else{
            $data = array('response' => "error", 'message' => "Failed");
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
			$this->input->post('id');
			$id = $this->input->post('id');
			if ($post = $this->Schedule_model->select_schedule_byID($id)) {
				$data = array('response' => "success", 'post' => $post);
			} else {
				$data = array('response' => "error", 'message' => "failed");
			}
			echo json_encode($data);
		}
	}
    
    public function update() {
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('morning_in', 'Morning In', 'required');
            $this->form_validation->set_rules('morning_out', 'Morning Out', 'required');
            $this->form_validation->set_rules('afternoon_in', 'Afternoon In', 'required');
            $this->form_validation->set_rules('afternoon_out', 'Afternoon Out', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
                $id = $this->input->post('id');
                $morning_in=$this->input->post('morning_in');
                $morning_out=$this->input->post('morning_out');
                $afternoon_in=$this->input->post('afternoon_in');
                $afternoon_out=$this->input->post('afternoon_out');
				if ($this->Schedule_model->update_schedule(array('morning_in'=>$morning_in, 'morning_out'=>$morning_out, 'afternoon_in'=>$afternoon_in, 'afternoon_out'=>$afternoon_out ), $id)) {
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
