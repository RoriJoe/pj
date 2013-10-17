<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
	class Menu extends CI_CONTROLLER {
		function __construct()
		{
			parent :: __construct();
			//$this->is_logged_in();
            $this->load->library('template');
            $this->load->library("authex");

            $this->load->helper('url');
            $this->load->model('combo_model');

            if(! $this->authex->logged_in())
	        {
	            redirect("login");
	        }
		}

		function home()
	    {
	        $this->load->library('id_chart/id_chart');
	        $data['c1'] = $this->id_chart->chart_embed('test',720,200,site_url('menu/example1'),base_url());
	        $data['c2'] = $this->id_chart->chart_embed('test4',240,230,site_url('menu/example4'),base_url());
	        
	        $username = $this->session->userdata('username');
	        $data['judul']="Welcome";
	        $data['user']=$username;
	        $this->template->display('content/welcome_message', $data);
	    }

		
		function example1()
		{

			$this->load->library('id_chart/id_chart');
			for ($i=1;$i<30;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>rand(1,300));
			echo $this->id_chart->set_chart('line')
							->set_data($data)
							->set_vertical()
							->render();
		}
		
		
		function example4()
		{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		for ($i=1;$i<6;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>rand(20,300));

		echo $this->id_chart->set_chart('pie')
							->set_data($data)
							//->set_radius(20)
							->render();
		}

        function logout()
        {
            $this->session->sess_destroy();
			
			#$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			
			#$this->output->set_header("Pragma: no-cache"); 
            redirect('login');
        }
	}