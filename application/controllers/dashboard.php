<?php
    class Dashboard extends CI_Controller{

        function __construct(){
            parent::__construct();

            $this->load->model('dashboard_model');
        }

        function dashboard_Penjualan(){
	    	//test
	        $start = $this->input->post('start');
			$end = $this->input->post('end');
			$data = array();

			$results = $this->dashboard_model->get_penjualan($start, $end);
			// Build a new array with the data
			foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->grandttl;
			}

			echo json_encode($data);
	    }
    }