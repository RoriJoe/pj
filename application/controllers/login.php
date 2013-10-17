<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');
	class Login extends CI_CONTROLLER {
            function __construct(){
            parent::__construct();
            $this->load->model('login_model');
            $this->load->library('template');
            $this->load->library("authex");
            
            $this->load->helper('url');  

			if($this->authex->logged_in())
	        {
	            //get the user info
	            $this->get_level();
	        }
		}
		function index()
		{ 
            $data['error'] = ""; 
			$data['uagent'] = "";			
            $this->load->view('form_login',$data);
        }
        
        function error(){
            $data['error'] = "Username/Password Tidak Terdaftar";
            $this->load->view('form_login',$data);
        }
		  
		function validatelogin()
		{ 			
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->authex->login($username, $password);

			if(! $this->authex->logged_in())
	        {
	            redirect("login/error");
	        }
	        else
	        {
	            //get the user info
	            $this->get_level();
	        }
		} 

		function get_level(){
			$user_info = $this->authex->get_userdata();

	            if($user_info->Level == 1)
	            {
	                redirect("admin/home");
	            }
	            else if($user_info->Level == 2)
	            {
	            	redirect('staff/home');
	            }
	            else if($user_info->Level == 3)
	            {
	            	redirect('staff/home');
	            }
	            else if($user_info->Level == 4)
	            {
	            	redirect('staff/home');
	            }
	            else if($user_info->Level == 5)
	            {
	            	redirect('staff/home');
	            }
		}
		
		function logout()
		{
			$this->session->sess_destroy();
			redirect('login/index');
		}
	}
?>