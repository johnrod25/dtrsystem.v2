<?php
class Login extends CI_Controller {

    public function login() {
        $timestamp = time();
        $date = date('Y-m-d', $timestamp); 
        $data['content']  = $this->Dashboard_model->attendance_today($date);
        $data['department']=$this->Department_model->select_department();
        $data['staff']=$this->Staff_model->select_staff();
        $data['attendance']  = $this->Dashboard_model->select_attendance();
        //$this->load->view('admin/header');
        $this->load->view('admin/login', $data);
        //$this->load->view ('admin/footer');
    }
   
}

?>