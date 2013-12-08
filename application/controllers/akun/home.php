<?php 

	if ( ! defined('BASEPATH')){
		exit('No direct script access allowed');
	}
	
	class Home extends CI_Controller {
		
		public function index(){		
			$this->load->view('home');
		}
		
		public function checklogin(){

				$this->load->model('employ');
				$rs=$this->employ->getlogin($this->input->post('username'),md5($this->input->post('password')));
				
				if($rs->num_rows()>0)
				{							
					$this->session->set_userdata('wahanalogid', $this->input->post('username'));
					foreach($rs->result() as $row)
					{					
						$this->session->set_userdata('wahanalogname', $row->nama);
						$this->session->set_userdata('wahanalogrole', $row->role);
					}					
					$this->load->view('home');
				}else{
					$data['error']="Invalid Username and Password";
					$this->load->view('home',$data);
				}
				
		}
		
		public function dologout(){
			$this->session->unset_userdata('wahanalogid');
			$this->session->unset_userdata('wahanalogname');
			$this->session->unset_userdata('wahanalogrole');
			$this->load->view('home');
		}
	}
?>