<?php
class Pages extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url().'login');
        }
    }
    
    public function dashboard($param = null) {
        if($param == null){

            $page = "dashboard";

            if(!file_exists (APPPATH. 'views/admin/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "New Posts";
            $data['posts'] = $this->Posts_model->get_posts();
            $data['total'] = count($data['posts']);
            $this->load->view('admin/adminheader');
            $this->load->view('admin/'.$page, $data);
            $this->load->view ('admin/adminfooter');
        }else{
            $page = "single";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "Single";
            $data['posts'] = $this->Posts_model->get_posts_single($param);

            // print_r($data['posts']);
            
            if($data['posts']){
                $this->load->view('templates/header');
                $this->load->view('pages/'.$page, $data);
                $this->load->view('templates/modal');
                $this->load->view ('templates/footer');
            }else{
                show_404();
            }
        }
    }

    public function view($param = null) {
        if($param == null){

            $page = "home";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "New Posts";
            $data['posts'] = $this->Posts_model->get_posts();
            $data['total'] = count($data['posts']);
            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view ('templates/footer');
        }else{
            $page = "single";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "Single";
            $data['posts'] = $this->Posts_model->get_posts_single($param);

            // print_r($data['posts']);
            
            if($data['posts']){
                $this->load->view('templates/header');
                $this->load->view('pages/'.$page, $data);
                $this->load->view('templates/modal');
                $this->load->view ('templates/footer');
            }else{
                show_404();
            }
        }
    }

    public function search(){
        $page = "home";
        $param = $this->input->post('search');
        if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
            show_404();
        }

        $data['title'] = "New Posts";
        $data['posts'] = $this->Posts_model->get_posts_search($param);
        $data['total'] = count($data['posts']);
        
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view ('templates/footer');
    }

    public function login(){
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if($this->form_validation->run()== FALSE){
            $page = "login";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page);
            $this->load->view ('templates/footer');
        }else{

            $user_id = $this->Posts_model->login();
            if ($user_id) {
                $user_data = array(
                    'id' => $user_id['id'],
                    'firstname' => $user_id['firstname'],
                    'lastname' => $user_id['lastname'],
                    'fullname' => $user_id['firstname'].' '.$user_id['lastname'],
                    'access' => $user_id['is_admin'],
                    'logged_in'=> true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata ('loggedin', 'You are now loged in as '.$this->session->fullname);
                redirect(base_url());
            }else{
                $this->session->set_flashdata ('failed_login', 'Login is invalid.');
                redirect('login');
            }

        }
    }

    public function logout(){
        // Unset user data
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('firstname');
        $this->session->unset_userdata('lastname');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('access');
        $this->session->unset_userdata('logged_in');

        $this->session->set_flashdata ('logout', 'You are now logged out.');
        redirect('login');

    }
    public function add(){

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        if($this->form_validation->run()== FALSE){
            $page = "add";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "Add New Posts";
            $data['posts'] = $this->Posts_model->get_posts();

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view ('templates/footer');
        }else{

            $this->Posts_model->insert_post();
            $this->session->set_flashdata ('post_added', 'New post was added ');
            redirect(base_url());
        }
        
    }

    public function edit($param){

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        if($this->form_validation->run()== FALSE){
            $page = "edit";

            if(!file_exists (APPPATH. 'views/pages/'.$page.'.php')){
                show_404();
            }

            $data['title'] = "Edit Post";
            $data['posts'] = $this->Posts_model->get_posts_edit($param);
            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view ('templates/footer');
        }else{

            $this->Posts_model->update_post();
            $this->session->set_flashdata ('post_updated', 'Post was updated.');
            redirect(base_url().'edit/'.$param);
        }
        
    }

    public function delete(){
        $this->Posts_model->delete_post();
        $this->session->set_flashdata('post_deleted', 'Post was deleted successfully!');
        redirect (base_url());
    }
}

?>