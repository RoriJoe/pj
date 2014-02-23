<?php
    class Dashboard extends CI_Controller{

        function __construct(){
            parent::__construct();

            $this->load->helper(array('account/ssl'));
			$this->load->library(array('account/authentication', 'account/authorization','template','form_validation'));
            $this->load->model(array('account/account_model','dashboard_model'));
        }

        function date_call(){
        	$date = $this->input->post('_dateOpt');
        	$query = $this->dashboard_model->get_date_list($date);

            $final['']='-- Select '.$date.' --';
            foreach ($query as $a) 
            {
                $final[$a->myOpt] = $a->myOptTxt;
            }

            echo form_dropdown('list-date',$final,'0','id="list-date" onchange="filterYear()"');
        }
        function date_callCompare(){
        	$date = $this->input->post('_dateOpt');
        	$query = $this->dashboard_model->get_date_list($date);

            foreach ($query as $a) 
            {
                $final[$a->myOpt] = $a->myOptTxt;
            }

            echo form_dropdown('list-date1',$final,'0','id="list-date1"');
        }
        function date_callCompare2(){
        	$date = $this->input->post('_dateOpt');
        	$query = $this->dashboard_model->get_date_list($date);

            foreach ($query as $a) 
            {
                $final[$a->myOpt] = $a->myOptTxt;
            }

            echo form_dropdown('list-date2',$final,'0','id="list-date2"');
        }


        /*DASHBOARD PENJUALAN**/
        function dashboard_Penjualan(){
	        $start = $this->input->post('start');
			$end = $this->input->post('end');
			$compare = $this->input->post('compare');

			$data = array();
			$data1 = array();
			$data2 = array();

			if($compare == 1){
				$results = $this->dashboard_model->get_penjualan_default($start,$end,$compare);
				$results2 = $this->dashboard_model->get_pembelian_default($start,$end,$compare);
				foreach ($results as $key => $value) {
					$data1[$key]['label'] = $value->Date;
					$data1[$key]['value'] = $value->Total;
				}
				foreach ($results2 as $key => $value) {
					$data2[$key]['label2'] = $value->Date;
					$data2[$key]['value2'] = $value->Total;
				}

				$data['line1'] = $data1;
				$data['line2'] = $data2;
			}else{
				$results = $this->dashboard_model->get_penjualan_default($start,$end,$compare);
				foreach ($results as $key => $value) {
					$data[$key]['label'] = $value->Date;
					$data[$key]['value'] = $value->Total;
				}
			}
			echo json_encode($data);
	    }

	    function dashboard_penjualan_filter(){
	    	$filter = $this->input->post('filter');
	    	$column = $this->input->post('column');
	    	$compare = $this->input->post('compare');	    	

	    	$data = array();
			$data1 = array();
			$data2 = array();

			if($compare != 0){
				$results = $this->dashboard_model->get_penjualan_revenue($column, $filter);
				$results2 = $this->dashboard_model->get_pembelian_revenue($column, $filter);
				foreach ($results as $key => $value) {
					$data1[$key]['label'] = $value->Year;
					$data1[$key]['value'] = $value->Total;
				}
				foreach ($results2 as $key => $value) {
					$data2[$key]['label2'] = $value->Year;
					$data2[$key]['value2'] = $value->Total;
				}

				$data['line1'] = $data1;
				$data['line2'] = $data2;

			}else{
				$results = $this->dashboard_model->get_penjualan_revenue($column, $filter);
				foreach ($results as $key => $value) {
					$data[$key]['label'] = $value->Year;
					$data[$key]['value'] = $value->Total;
				}
			}

			echo json_encode($data);
	    }

	    function dashboard_drill_penjualan(){
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
	    	$compare = $this->input->post('compare');
	    	//$date = $this->input->post('date');

	    	$data = array();
			$data1 = array();
			$data2 = array();

			if($compare != 0){
				$results = $this->dashboard_model->get_drill_penjualan($year,$month);
				$results2 = $this->dashboard_model->get_drill_pembelian($year,$month);
				foreach ($results as $key => $value) {
					$data1[$key]['label'] = $value->myDate;
					$data1[$key]['value'] = $value->Total;
				}
				foreach ($results2 as $key => $value) {
					$data2[$key]['label2'] = $value->myDate;
					$data2[$key]['value2'] = $value->Total;
				}

				$data['line1'] = $data1;
				$data['line2'] = $data2;

			}else{
				$results = $this->dashboard_model->get_drill_penjualan($year,$month);
				foreach ($results as $key => $value) {
					$data[$key]['label'] = $value->myDate;
					$data[$key]['value'] = $value->Total;
				}
			}

			echo json_encode($data);
	    }

	    function dashboard_total_os(){
	    	$month = $this->input->post('month');
	    	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
           
	    	$data = array();

			$results = $this->dashboard_model->get_outstanding_default($start,$end,$year,$month);
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->Pesan;
				$data['terkirim'] = $value->Kirim;
			}
			echo json_encode($data);
	    }

	    function dashboard_total_keuangan(){
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

	    	$data = array();

			$results = $this->dashboard_model->get_keuangan_default($start,$end,$year,$month);
			// Build a new array with the data
			foreach ($results as $value) {
				$data['pesan'] = $value->invoiceTotal;
				$data['terkirim'] = $value->terbayarTotal;
			}

			echo json_encode($data);
	    }

	   	/*
	    *
	    DETAIL TABLE
	    *
	    */
	    function dashboard_detail_penjualan(){
	    	$date = $this->input->post('date');
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
	    	$start = $this->input->post('start');
            $end = $this->input->post('end');

            $data['hasil']=$this->dashboard_model->get_detail_penjualan($date,$month,$year,$start,$end);
            $this->load->view('content/list/dashboard_detail', $data);
        }

        function dashboard_detail_os(){
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

            $data['hasil2']=$this->dashboard_model->get_detail_os($year,$start,$end,$month);
            $this->load->view('content/list/os_detail', $data);
        }

        function dashboard_detail_keuangan(){
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

            $data['hasil2']=$this->dashboard_model->get_detail_keuangan($year,$start,$end,$month);
            $this->load->view('content/list/keuangan_detail', $data);
        }

        function dashboard_chart_os(){
	    	$year = $this->input->post('year');
	    	$month = $this->input->post('month');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

            $data = array();
			$data1 = array();
			$data2 = array();

			$results = $this->dashboard_model->get_chart_os($year,$start,$end,$month);
			//$results2 = $this->dashboard_model->get_pembelian_revenue($column, $filter);
			foreach ($results as $key => $value) {
				$data1[$key]['label'] = $value->Tgl;
				$data1[$key]['value'] = $value->Pesan;
			}
			foreach ($results as $key => $value) {
				$data2[$key]['label2'] = $value->Tgl;
				$data2[$key]['value2'] = $value->Terkirim;
			}

			$data['line1'] = $data1;
			$data['line2'] = $data2;

			echo json_encode($data);
        }

        /*
        *
        Advance dashboard
        */
        function advance(){
        	$data['judul']="Dashboard Insight Pelita Jaya";
	        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        	$this->load->view('dashboard_full', $data);
        }

        function custom_avg_so(){
        	$year = $this->input->post('year');
        	$month = $this->input->post('month');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

			$data = array();
			//$data1 = array();
			//$data2 = array();
			$results = $this->dashboard_model->get_info_penjualan($month,$year,$start,$end);
			//$results1 = $this->dashboard_model->get_penjualan_unit($month,$year,$start,$end);

			foreach ($results as $key => $value) {
				//$data1[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->grandttl;
				$data[$key]['qty'] = $value->qty;
			}
			/*foreach ($results1 as $key => $value) {
				$data2[$key]['label'] = $value->Tgl;
				$data2[$key]['value'] = $value->unit;
				$data2[$key]['value_avg'] = $value->unit_avg;
			}

			$data['soVal'] = $data1;
			$data['unit'] = $data2;*/

			echo json_encode($data);
        }

        function custom_avg_unit(){
        	$year = $this->input->post('year');
            $start = $this->input->post('start');
            $end = $this->input->post('end');

			$data = array();
			
			//$results2 = $this->dashboard_model->get_penjualan_avg($start, $end);

			foreach ($results1 as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->unit;
				$data[$key]['value_avg'] = $value->unit_avg;
			}
			echo json_encode($data);
        }


        function dashboard_penjualan_compare(){
	        $year1 = $this->input->post('year1');
	        $year2 = $this->input->post('year2');
	        $month1 = $this->input->post('month1');
	        $month2 = $this->input->post('month2');
	        $week1start = $this->input->post('week1');
	        $week2start = $this->input->post('week2');

	        $week1end = 0;
	        $week2end = 0;
	        if($week1start == 29){
	        	$week1end = $week1start + 2;
	        }else if($week1start != 0){
	        	$week1end = $week1start + 7;
	        }

	        if($week2start == 29){
	        	$week2end = $week2start + 2;
	        }else if($week2start != 0){
	        	$week2end = $week2start + 7;
	        }

	        //var_dump($week2end,$week1end);

			$data = array();
			$data1 = array();
			$data2 = array();

			$results = $this->dashboard_model->get_penjualan_compare($year1,$month1,$week1start,$week1end);
			$results2 = $this->dashboard_model->get_penjualan_compare($year2,$month2,$week2start,$week2end);
			foreach ($results as $key => $value) {
				$data1[$key]['label'] = $value->myDate;
				$data1[$key]['value'] = $value->Total;
			}
			foreach ($results2 as $key => $value) {
				$data2[$key]['label2'] = $value->myDate;
				$data2[$key]['value2'] = $value->Total;
			}
			$data['line1'] = $data1;
			$data['line2'] = $data2;

			echo json_encode($data);
	    }
        /*
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

	    	    function dashboard_penjualan_month(){
	    	$year = $this->input->post('year');

	    	$results = $this->dashboard_model->get_drill_month($year);

	    	foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->penjualanMonth;
				$data[$key]['value'] = $value->penjualanTotal;
			}

			echo json_encode($data);
	    }

	    function dashboard_penjualan_day(){
	        $year = $this->input->post('year');
			$month = $this->input->post('month');
			$data = array();

			$results = $this->dashboard_model->get_drill_day($year, $month);
			foreach ($results as $key => $value) {
				$data[$key]['label'] = $value->Tgl;
				$data[$key]['value'] = $value->grandttl;
			}

			echo json_encode($data);
	    }*/
    }