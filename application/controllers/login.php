<?php
	class Login extends CI_CONTROLLER {
            function __construct(){
            parent::__construct();
            $this->load->model('login_model');
            $this->load->library('template');
            
            $this->load->helper('url');  
			$this->load->library('user_agent');
		}
		function index()
		{ 
            $data['error'] = ""; 
			$data['uagent'] = "";
			if ($this->agent->browser() == 'Internet Explorer' OR $this->agent->browser() == 'Firefox'){
				$data['uagent'] = "Browser yang anda gunakan tidak didukung penuh oleh Web ini, Silahkan gunakan Google Chrome untuk kompabilitas yang lebih baik. :D";
			}
			
            $this->load->view('form_login',$data);
        }
        
        function error(){
            $data['error'] = "Username/Password Tidak Terdaftar";
            $this->load->view('form_login',$data);
        }
		  
		function validatelogin()
		{ 			
			$query = $this->login_model->validate();
			
			if($query) // jika data user benar
			{
			$data = array(
			'username' => $this->input->post('username'),
			'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('menu/home',$data);
			}
			else // username atau password salah
			{
			$this->error();
			}
		} 
		
		function logout()
		{
			$this->session->sess_destroy();
			redirect('login/index');
		}
	}
?>