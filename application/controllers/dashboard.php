<?php
    class Dashboard extends CI_Controller{

        function __construct(){
            parent::__construct();

            $this->load->helper(array('account/ssl'));
			$this->load->library(array('account/authentication', 'account/authorization','template','form_validation'));
            $this->load->model(array('account/account_model','dashboard_model'));
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

	    function dashboard_avg_os(){
	    	$data = array();
			$results = $this->dashboard_model->get_os();
			foreach ($results as $value) {
				$data['pesan'] = $value->pemesananAvg;
				$data['terkirim'] = $value->terkirimAvg;
			}

			echo json_encode($data);
	    }

	    function dashboard_avg_keuangan(){
	    	$data = array();

			$results = $this->dashboard_model->get_keuangan();
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->invAvg;
				$data['terkirim'] = $value->terbayarAvg;
			}

			echo json_encode($data);
	    }

	    function dashboard_total_os(){
	    	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
           
	    	$data = array();

			$results = $this->dashboard_model->get_total_os($start,$end,$year);
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->pemesananTotal;
				$data['terkirim'] = $value->terkirimTotal;
			}
			echo json_encode($data);
	    }

	    function dashboard_total_keuangan(){
	    	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

	    	$data = array();

			$results = $this->dashboard_model->get_total_keuangan($start,$end,$year);
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->invoiceTotal;
				$data['terkirim'] = $value->terbayarTotal;
			}

			echo json_encode($data);
	    }

        //**Advance dashboard**/
        function advance(){
        	$data['judul']="Dashboard Insight Pelita Jaya";
	        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        	$this->load->view('dashboard_full', $data);
        }

        function date_call(){
        	$date = $this->input->post('_dateOpt');
        	$query = $this->dashboard_model->get_date_list($date);

            $final['']='-- Select '.$date.' --';
            foreach ($query as $a) 
            {
                $final[$a->myOpt] = $a->myOptTxt;
            }

            echo form_dropdown('list-date',$final,'0','id="list-date" onchange="filterAll()"');
        }

        function custom_avg_so(){
        	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

			$data = array();
			$results1 = $this->dashboard_model->get_penjualan_last($start,$end,$year);

			foreach ($results1 as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->grandttl;
			}
			echo json_encode($data);
        }

        function custom_avg_unit(){
        	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

			$data = array();
			$results1 = $this->dashboard_model->get_penjualan_unit($start,$end,$year);
			//$results2 = $this->dashboard_model->get_penjualan_avg($start, $end);

			foreach ($results1 as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->unit;
				$data[$key]['value_avg'] = $value->unit_avg;
			}
			echo json_encode($data);
        }
        //**End**//

        function dashboard_penjualan_filter(){
	    	$filter = $this->input->post('filter');
	    	$column = $this->input->post('column');

	    	if ($column == "year"){
	    		$results = $this->dashboard_model->get_penjualan_filter($filter, $column);
	    	}else if($column == "rev_great"){
	    		$results = $this->dashboard_model->get_larger_revenue($filter, $column);
	    	}else if($column == "rev_less"){
	    		$results = $this->dashboard_model->get_minus_revenue($filter, $column);
	    	}
	    	else if($column == "month"){
	    		$results = $this->dashboard_model->get_penjualan_month($filter, $column);
	    	}

	    	foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->penjualanYear;
				$data[$key]['value'] = $value->penjualanTotal;
			}

			echo json_encode($data);
	    }

	    function dashboard_penjualan_month(){
	    	$year = $this->input->post('year');

	    	$results = $this->dashboard_model->get_drill_month($year);

	    	foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->penjualanMonth;
				$data[$key]['value'] = $value->penjualanTotal;
			}

			echo json_encode($data);
	    }

	    function dashboard_day(){
	    	//test
	        $year = $this->input->post('year');
			$month = $this->input->post('month');
			$data = array();

			$results = $this->dashboard_model->get_drill_day($year, $month);
			foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->grandttl;
			}

			echo json_encode($data);
	    }

	    function dashboard_detail_penjualan(){
	    	$date = $this->input->post('date');
            $data['hasil']=$this->dashboard_model->get_detail_penjualan($date);
            $this->load->view('content/list/dashboard_detail', $data);
        }
    }