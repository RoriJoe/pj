<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
	class Staff_Controller extends CI_CONTROLLER {
		function __construct()
		{
			parent :: __construct();
			//$this->is_logged_in();
            $this->load->library('template');
            $this->load->library('authex');

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

        /*----Respon Click Side Menu----*/

        //Master Barang
        function ms_barang(){
			$data['list_satuan']=$this->combo_model->list_satuan();
            $data['judul']="Master Barang";
            $this->template->display('content/master_barang/ms_barang', $data);
        }

        //Master Pelanggan
        function ms_pelanggan(){
            $data['judul']="Master Pelanggan";
            $this->template->display('content/master_pelanggan/ms_pelanggan', $data);
        }

        //Master Supplier
        function ms_supplier(){
            $data['judul']="Master Supplier";
            $this->template->display('content/master_supplier/ms_supplier', $data);
        }

        //Master Supplier
        function ms_satuan(){
            $data['judul']="Master Satuan";
            $this->template->display('content/master_satuan/ms_satuan', $data);
        }

        //Master Gudang
        function ms_gudang(){
            $data['judul']="Master Gudang";
            $this->template->display('content/master_gudang/ms_gudang', $data);
        }

        function ms_perkiraan(){
            $data['judul']="Master Perkiraan";
            $this->template->display('content/master_perkiraan/perkiraan', $data);
        }

        function ms_bank(){
        	$data['list_tipe']=$this->combo_model->list_tipe();
        	$data['judul']="Master Bank";
        	$this->template->display('content/master_bank/ms_bank', $data);
        }
        
        //Transaksi Pemesanan /PO
        function tr_pemesanan()
        {
            $data['list_currency']=$this->combo_model->list_currency();
            $data['judul']="Pemesanan / PO";
            $this->template->display('content/tr_pemesanan/tr_pemesanan', $data);
        }

        //Transaksi Pemesanan Barang
        function tr_penerimaan_barang()
        {
            $data['judul']="Penerimaan Barang";
            $this->template->display('content/tr_penerimaan/tr_penerimaan_barang', $data);
        }

        //Transaksi Surat Jalan
        function tr_surat_jalan()
        {
            $data['list_gudang']=$this->combo_model->list_gudang();
            $data['judul']="Surat Jalan";
            $this->template->display('content/tr_surat_jalan/tr_surat_jalan', $data);
        }

        //Transaksi DO
        function tr_do()
        {
            //$data['list_pelanggan']=$this->combo_model->list_gudang();
			$username = $this->session->userdata('username');
			$data['user']=$username;
			$data['list_sales']=$this->combo_model->list_sales();
            $data['judul']="Detail Order";
            $this->template->display('content/SO/tr_do', $data);
        }

        //Transaksi Inovice
        function tr_invoice()
        {
            $data['judul']="Invoice";
            $this->template->display('content/tr_invoice/tr_invoice', $data);
        }
		
		function tr_terima_bayar()
        {
            $data['judul']="Terima Pembayaran";
            $this->template->display('content/tr_terima_bayar/tr_terima_bayar', $data);
        }
		
		function tr_pembayaran()
        {
            $data['judul']="Pembayaran";
            $this->template->display('content/tr_pembayaran/tr_pembayaran', $data);
        }
		function report_sj(){
			$data['judul']="Report SJ";
			$this->template->display('content/report_sj', $data);
		}
		
		function report_do(){
			$data['judul']="Report DO";
			$this->template->display('content/report_do', $data);
		}

		function report_po(){
			$data['judul']="Report PO";
			$this->template->display('content/report_po', $data);
		}

		function report_os_po(){
			$data['judul']="Report Outstanding PO";
			$this->template->display('content/report_os_po', $data);
		}
		
		function report_mutasi(){
			$data['judul']="Report Mutasi";
			$this->template->display('content/report_mutasi', $data);
		}

		function report_os(){
			$data['judul']="Report Outstanding Order";
			$this->template->display('content/report_os', $data);
		}
		
		function report_penerimaan(){
			$data['judul']="Report penerimaan";
			$this->template->display('content/report_penerimaan', $data);
		}
		
		function report_ks(){
			$data['judul']="Report ks";
			$this->template->display('content/report_ks', $data);
		}
        
        function logout()
        {
            $this->session->sess_destroy();
            redirect('login');
        }
	}

	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parnt::__construct();
		}
	}