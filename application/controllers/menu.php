<?php if (!defined('BASEPATH')) exit ('Hacking Attempt!');
	class Menu extends CI_CONTROLLER {
		function __construct()
		{
			parent :: __construct();
           	$this->load->helper(array('account/ssl'));
			$this->load->library(array('account/authentication', 'account/authorization','template','form_validation'));
			$this->load->model(array('account/account_model'));
            $this->load->model('combo_model');
            
            if (!$this->authentication->is_signed_in()) redirect('');
		}

		function home()
	    {
	        $data['judul']="Welcome";
	        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

	        $this->template->display('content/welcome_message', $data);
	    }

        function ms_barang(){
			$data['list_satuan']=$this->combo_model->list_satuan();
            $data['judul']="Master Barang";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_barang/ms_barang', $data);
        }

        function ms_pelanggan(){
            $data['judul']="Master Pelanggan";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_pelanggan/ms_pelanggan', $data);
        }

        function ms_supplier(){
            $data['judul']="Master Supplier";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_supplier/ms_supplier', $data);
        }

        function ms_satuan(){
            $data['judul']="Master Satuan";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_mobil/ms_satuan', $data);
        }

        function ms_mobil(){
            $data['judul']="Master Mobil";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_mobil/ms_mobil', $data);
        }

        function ms_gudang(){
            $data['judul']="Master Gudang";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_gudang/ms_gudang', $data);
        }

        function ms_perkiraan(){
            $data['judul']="Master Perkiraan";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/master_perkiraan/perkiraan', $data);
        }

        function ms_bank(){
        	$data['list_tipe']=$this->combo_model->list_tipe();
        	$data['judul']="Master Bank";
        	$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        	$this->template->display('content/master_bank/ms_bank', $data);
        }
        
        
        function tr_pemesanan()
        {
            $data['list_currency']=$this->combo_model->list_currency();
            $data['judul']="Pemesanan / PO";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_pemesanan/tr_pemesanan', $data);
        }

        
        function tr_penerimaan_barang()
        {
            $data['judul']="Penerimaan Barang";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_penerimaan/tr_penerimaan_barang', $data);
        }

        
        function tr_surat_jalan()
        {
            $data['list_gudang']=$this->combo_model->list_gudang();
            $data['judul']="Surat Jalan";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_surat_jalan/tr_surat_jalan', $data);
        }

        
        function tr_do()
        {
			$username = $this->session->userdata('username');
			$data['user']=$username;
			$data['list_sales']=$this->combo_model->list_sales();
            $data['judul']="Detail Order";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/SO/tr_do', $data);
        }

        
        function tr_invoice()
        {
            $data['judul']="Invoice";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_invoice/tr_invoice', $data);
        }
		
		function tr_terima_bayar()
        {
            $data['judul']="Terima Pembayaran";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_terima_bayar/tr_terima_bayar', $data);
        }
		
		function tr_pembayaran()
        {
            $data['judul']="Pembayaran";
            $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
            $this->template->display('content/tr_pembayaran/tr_pembayaran', $data);
        }
		function report_sj(){
			$data['judul']="Report SJ";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_sj', $data);
		}
		
		function report_do(){
			$data['judul']="Report DO";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_do', $data);
		}

		function report_po(){
			$data['judul']="Report PO";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_po', $data);
		}

		function report_os_po(){
			$data['judul']="Report Outstanding PO";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_os_po', $data);
		}
		
		function report_mutasi(){
			$data['judul']="Report Mutasi";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_mutasi', $data);
		}

		function report_os(){
			$data['judul']="Report Outstanding Order";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_os', $data);
		}
		
		function report_penerimaan(){
			$data['judul']="Report penerimaan";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_penerimaan', $data);
		}
		
		function report_ks(){
			$data['judul']="Report ks";
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$this->template->display('content/report_ks', $data);
		}

		function saw(){
	        $data['judul']="Pendataan Saldo Awal";
	        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
	        $this->template->display('content/saw/saw_h', $data);
	    }

	    function piutang(){
	        $data['judul']="Status Piutang";
	        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
	        $this->template->display('content/piutang/piutang', $data);
	    }

	    function user(){
	    	redirect('account/account_profile');
	    }

	    function setting_neraca(){
        	redirect('akun/settingneraca');
        }
        function setting_laba_rugi(){
        	redirect('akun/settingrugilaba');
        }
        function settingmapping(){
        	redirect('akun/settingmapping');
        }
        function tutuptahun(){
        	redirect('akun/tutuptahun');
        }
        
        function logout()
        {
            redirect('account/sign_out');
        }
	}