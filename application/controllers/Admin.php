<?php
class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }

    public function index() {
        $timestamp = time();
        $date = date('Y-m-d', $timestamp); 
        $data['content']  = $this->Dashboard_model->attendance_today($date);
        $data['department']=$this->Department_model->select_department();
        $data['staff']=$this->Staff_model->select_staff();
        $data['attendance']  = $this->Dashboard_model->select_attendance();
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view ('admin/footer');
    }

    function getsearch(){
        $timestamp = time();
        $date = date('Y-m-d', $timestamp); 
        $data['content']  = $this->Dashboard_model->attendance_today($date);
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view ('admin/footer');
   }

    public function employee($param = null) {
        if($param == null){
            $page = "employee";
            if(!file_exists (APPPATH. 'views/admin/'.$page.'.php')){
                show_404();
            }
            $data['title'] = "New Posts";
            $data['posts'] = $this->Posts_model->get_posts();
            $data['total'] = count($data['posts']);
            $this->load->view('admin/header');
            $this->load->view('admin/'.$page, $data);
            $this->load->view ('admin/footer');
        }
    }

    public function department($param = null) {
        if($param == null){
            $page = "department";
            if(!file_exists (APPPATH. 'views/admin/'.$page.'.php')){
                show_404();
            }
            $data['title'] = "New Posts";
            $data['posts'] = $this->Posts_model->get_posts();
            $data['total'] = count($data['posts']);
            $this->load->view('admin/header');
            $this->load->view('admin/'.$page, $data);
            $this->load->view ('admin/footer');
        }
    }

    public function schedule($param = null) {
        if($param == null){
            $page = "schedule";
            if(!file_exists (APPPATH. 'views/admin/'.$page.'.php')){
                show_404();
            }
            $data['title'] = "New Posts";
            $data['posts'] = $this->Posts_model->get_posts();
            $data['total'] = count($data['posts']);
            $this->load->view('admin/header');
            $this->load->view('admin/'.$page, $data);
            $this->load->view ('admin/footer');
        }
    }

    function fetch(){
        if ($this->input->is_ajax_request()) {
            $timestamp = time();
            $date = date('Y-m-d', $timestamp); 
            $posts  = $this->Dashboard_model->attendance_today($date);
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
   }

}

?>