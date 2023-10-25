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
        }
		else
        {
            if($this->session->userdata('usertype')==1)
            {
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $data['content'] = $this->Attendance_model->select_attendance_byAll($start_date,$end_date);
                //print_r($data);
                $this->load->view('admin/header');
                $this->load->view('system/print_all_dtr',$data);
                $this->load->view('admin/footer');                
            }
            else{
                $rfid=$this->session->userdata('rfid');
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $data['content'] = $this->Attendance_model->select_attendance_byRfid($rfid,$start_date,$end_date);
                //print_r($data);
                $this->load->view('staff/header');
                $this->load->view('system/print_all_dtr',$data);
                $this->load->view('staff/footer');
            }   
        }
    }

    public function printmydtr()
    {
        $rfid = $this->input->post('rfid');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $data['content'] = $this->Attendance_model->select_attendance_byRfid($rfid,$start_date,$end_date);
        $this->load->view('admin/header');
        $this->load->view('system/print_dtr',$data);
        $this->load->view('admin/footer');
    }

    
}

?>