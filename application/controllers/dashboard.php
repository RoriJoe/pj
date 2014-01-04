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

	    function dashboard_avg_os(){
	    	$data = array();

			$results = $this->dashboard_model->get_os();
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->pemesananAvg;
				$data['terkirim'] = $value->terkirimAvg;
			}

			echo json_encode($data);
	    }

	    function dashboard_total_os(){
	    	$data = array();

			$results = $this->dashboard_model->get_total_os();
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->pemesananTotal;
				$data['terkirim'] = $value->terkirimTotal;
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

	    function dashboard_total_keuangan(){
	    	$data = array();

			$results = $this->dashboard_model->get_total_keuangan();
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->invoiceTotal;
				$data['terkirim'] = $value->terbayarTotal;
			}

			echo json_encode($data);
	    }

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
			// Build a new array with the data
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