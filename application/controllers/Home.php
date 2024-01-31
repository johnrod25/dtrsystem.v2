<?php
class Home extends CI_Controller {

    public function loginnnn() {
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

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url('login'));
        }
		else
        {
            if($this->session->userdata('usertype')==1)
            {
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
            else{
                $staff=$this->session->userdata('rfid');
                $timestamp = time();
                $date = date('Y-m-d', $timestamp); 
                $dateRecords = $this->Attendance_model->select_attendance_byID($staff);

            // Filter and display records for the selected month
            $filteredRecords = array_filter($dateRecords, function ($records) use ($date) {
                return date('n', strtotime($records['log_date'])) == date('n', strtotime($date));
            });
                $data['content'] = $filteredRecords;
                $data['attendance']  = $this->Attendance_model->select_attendance_byID($staff);
                $this->load->view('staff/header');
                $this->load->view('staff/dashboard',$data);
                $this->load->view('staff/footer');
            }   
        }
	}

    public function login_page()
    {
        //$this->load->view('login');
        $this->load->view('admin/login');
    }

    public function error_page()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/error_page');
        $this->load->view('admin/footer');
    }

    function change_password(){
        if ($this->input->is_ajax_request()) {
            $new_password = $this->input->post('newpass');
            $current_password = $this->input->post('currentpass');
            $rfid = $this->session->userdata('rfid');
            $this->form_validation->set_rules('newpass', 'New Password', 'required');
            $this->form_validation->set_rules('currentpass', 'Current Password', 'required');
            $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => "error", 'message' => validation_errors());
			} else {
                if ($this->Home_model->update_password($rfid, $new_password, $current_password)) {
                    $data = array('response' => "success","message" => "Password updated successfully.");
                } else {
                    $data = array('response' => "error", "message" => "failed to change your password, make sure you entered correct password.");
                }
            }
            echo json_encode($data);
        }
    }

	function login()
    {
        $un=$this->input->post('username');
        $pw=$this->input->post('password');
        //$this->load->model('Home_model');
        $check_login=$this->Home_model->logindata($un,$pw);
        echo $check_login;
        if($check_login<>'') {
            if($check_login[0]['status']==1){
                if($check_login[0]['usertype']==1){
                    $data = array(
                        'logged_in'  =>  TRUE,
                        'username' => $check_login[0]['firstname'],
                        'log_date' => $check_login[0]['log_date'],
                        'usertype' => $check_login[0]['usertype'],
                        'rfid' => $check_login[0]['rfid'],
                        'userid' => $check_login[0]['id'],
                        'staffname' => $check_login[0]['firstname']." ".$check_login[0]['midname']." ".$check_login[0]['lastname'],
                        'img_pic' => $check_login[0]['pic']
                    );
                    $this->session->set_userdata($data);
                    redirect('/');
                }
                elseif($check_login[0]['usertype']==2){
                    $data = array(
                        'logged_in'  =>  TRUE,
                        'username' => $check_login[0]['username'],
                        'usertype' => $check_login[0]['usertype'],
                        'rfid' => $check_login[0]['rfid'],
                        'userid' => $check_login[0]['id'],
                        'staffname' => $check_login[0]['firstname']." ".$check_login[0]['midname']." ".$check_login[0]['lastname'],
                        'img_pic' => $check_login[0]['pic'],
                        'dojoin' => $check_login[0]['doj']
                    );
                    $this->session->set_userdata($data);
                    redirect('/');
                }
                else{
                    $this->session->set_flashdata('login_error', 'Sorry, you cant login right now.', 300);
                    redirect(base_url().'login');
                }
                
            }
            else{
                $this->session->set_flashdata('login_error', 'Sorry, your account is blocked.', 300);
                redirect(base_url().'login');
            }
            
        }
        else{
            $this->session->set_flashdata('login_error', 'Please check your username or password and try again.', 300);
            redirect(base_url().'login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }
   
    public function tapcard(){
        $timestamp = time();
        $date = date('Y-m-d', $timestamp);
        $data['attendance']=$this->Dashboard_model->attendance_today($date);
        $data['fullname']=$this->Schedule_model->select_fullname();
        $this->load->view('admin/tapcard',$data);
        // $this->load->view('admin/footer',$data);
    }

    public function printdtr($month,$id)
    {
        $dateRecords = $this->Attendance_model->select_attendance_byID($id);
        if ($month == 0) {
            // Display all records when "All Months" is selected
            $data['content'] = $dateRecords;
        } else {
            // Filter and display records for the selected month
            $filteredRecords = array_filter($dateRecords, function ($records) use ($month) {
                return date('n', strtotime($records['log_date'])) == $month;
            });
            $data['content'] = $filteredRecords;
        }

        $this->load->view('admin/header');
        $this->load->view('system/print_dtr',$data);
        $this->load->view('admin/footer');
    }

    public function printalldtr()
    {
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url('login'));
        } else {
            if($this->session->userdata('usertype')==1)
            {
                $usertype = "admin";
                
                if($this->input->post('include') == 1){
                    $dateRecords = $this->Attendance_model->select_attendance();
                $dataimg = $this->Attendance_model->select_attendance_img();
                $fullname = "All Staff";
                }else{
                    $rfid=$this->input->post('rfid');
                    $fulln = $this->Staff_model->select_staff_byRFID($rfid);
                    $dateRecords = $this->Attendance_model->select_attendance_byID($rfid);
                    $dataimg = $this->Attendance_model->select_attendance_img_byRfid($rfid);
                    if($dateRecords != NULL){
                        $fullname = $dateRecords[0]['fullname'];
                    }else{
                        $fullname = $fulln[0]['firstname']." ".$fulln[0]['midname']." ".$fulln[0]['lastname'];
                    }
                }
                
            }else{
                $usertype = "staff";
                // $data['include_name'] = 1;
                $rfid=$this->session->userdata('rfid');
                $dateRecords = $this->Attendance_model->select_attendance_byID($rfid);
                $dataimg = $this->Attendance_model->select_attendance_img_byRfid($rfid);
                $fullname = $this->session->userdata('staffname');
            }
                $choice = $this->input->post('choices');
                $month = $this->input->post('monthdate');
                $year = $this->input->post('yeardate');
                $monthtext = $this->input->post('monthtext');
                $data['date'] = array('date'=>$monthtext." ".$year);
                $data['include_name'] = $this->input->post('include');
                $data['fullname'] = $fullname;
                $this->load->view($usertype.'/header');
                if($choice == 1){
                    $data['content'] = array_filter($dateRecords, function ($records) use ($month,$year) {
                        return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
                    });
                    $data['images'] = array_filter($dataimg, function ($records) use ($month,$year) {
                        return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
                    });
                    $this->load->view('system/print_all_dtr',$data);
                }else if($choice == 2){
                    $data['content'] = array_filter($dateRecords, function ($records) use ($month,$year) {
                        return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
                    });
                    $this->load->view('system/printdtronly',$data);
                }else if($choice == 3){
                    $data['images'] = array_filter($dataimg, function ($records) use ($month,$year) {
                        return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
                    });
                    $this->load->view('system/printpiconly',$data);
                }
                $this->load->view($usertype.'/footer');                
            // } else{
            //     $rfid=$this->session->userdata('rfid');
            //     $month = $this->input->post('monthdate');
            //     $year = $this->input->post('yeardate');
            //     $dateRecords = $this->Attendance_model->select_attendance_byID($rfid);

            //     $data['content'] = array_filter($dateRecords, function ($records) use ($month,$year) {
            //         return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
            //     });

            //     $this->load->view('staff/header');
            //         $this->load->view('system/printdtronly',$data);
            //         $this->load->view('staff/footer');
            // }   
        }
    }

    public function printmydtr()
    {
        $rfid = $this->input->post('rfid');
        $month = $this->input->post('monthdate');
        $monthtext = $this->input->post('monthtext');
        $year = $this->input->post('yeardate');
        $data['date'] = array('date'=>$monthtext." ".$year);
        $dateRecords = $this->Attendance_model->select_attendance_byID($rfid);
        $data['content'] = array_filter($dateRecords, function ($records) use ($month,$year) {
            return (date('n', strtotime($records['log_date'])) == $month && date('Y', strtotime($records['log_date'])) == $year);
        });

        if($this->session->userdata('usertype')==1){
            $this->load->view('admin/header');
            $this->load->view('system/print_dtr',$data);
            $this->load->view('admin/footer');
        }else{
            $this->load->view('staff/header');
            $this->load->view('system/print_dtr',$data);
            $this->load->view('staff/footer');
        }
        
    }

    public function printalldtr_old()
    {
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url('login'));
        }
		else
        {
            if($this->session->userdata('usertype')==1)
            {
                $usertype = "admin";
            }
            else{
                $usertype = "staff";
            }   

            $rfid=$this->input->post('rfid');
            $dateRecords = $this->Attendance_model->select_attendance_byID($rfid);
            $dataimg = $this->Attendance_model->select_attendance_img_byRfid($rfid);
            $choice = $this->input->post('choices');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            // $monthtext = $this->input->post('monthtext');
            $data['date'] = array('date'=>$start_date." : ".$end_date);
            $data['include_name'] = $this->input->post('include');
            $data['fullname'] = $this->input->post('fullname');
            $this->load->view($usertype.'/header');
            if($choice == 1){
                $data['content'] = array_filter($dateRecords, function ($records) use ($start_date,$end_date) {
                    return (date('Y-m-d', strtotime($records['log_date'])) >= $start_date && date('Y-m-d', strtotime($records['log_date'])) <= $end_date);
                });
                $data['images'] = array_filter($dataimg, function ($records) use ($start_date,$end_date) {
                    return (date('Y-m-d', strtotime($records['log_date'])) >= $start_date && date('Y-m-d', strtotime($records['log_date'])) <= $end_date);
                });
                $this->load->view('system/print_all_dtr',$data);
            }else if($choice == 2){
                $data['content'] = array_filter($dateRecords, function ($records) use ($start_date,$end_date) {
                    return (date('Y-m-d', strtotime($records['log_date'])) >= $start_date && date('Y-m-d', strtotime($records['log_date'])) <= $end_date);
                });
                $this->load->view('system/printdtronly',$data);
            }else if($choice == 3){
                $data['images'] = array_filter($dataimg, function ($records) use ($start_date,$end_date) {
                    return (date('Y-m-d', strtotime($records['log_date'])) >= $start_date && date('Y-m-d', strtotime($records['log_date'])) <= $end_date);
                });
                $this->load->view('system/printpiconly',$data);
            }
            $this->load->view($usertype.'/footer');  
        }
    }

    
}


?>