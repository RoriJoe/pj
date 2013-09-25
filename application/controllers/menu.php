<<<<<<< HEAD
<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
	class Menu extends CI_CONTROLLER {

		function __construct()
		{
			parent :: __construct();
			$this->is_logged_in();
            $this->load->library('template');
            $this->load->library('user_agent');
            $this->load->helper('url');
            $this->load->model('combo_model');
		}
		
        function is_logged_in()
		{
		  $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
		  redirect('login/index');
		  }
		}
        /*Load Home if login success*/
		function home()
		{
			$this->load->library('id_chart/id_chart');
			$data['c1'] = $this->id_chart->chart_embed('test',720,200,site_url('menu/example1'),base_url());
			$data['c2'] = $this->id_chart->chart_embed('test4',240,230,site_url('menu/example4'),base_url());
			
			$data['uagent'] = "";
            if ($this->agent->browser() == 'Internet Explorer' OR $this->agent->browser() == 'Firefox'){
                $data['uagent'] = "0";
            }else{
                $data['uagent'] = "1";
            }
            
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

        //Master Gudang
        function ms_gudang(){
            $data['judul']="Master Gudang";
            $this->template->display('content/master_gudang/ms_gudang', $data);
        }
        
        //Transaksi Pemesanan /PO
        function tr_pemesanan()
        {
            $data['judul']="Pemesanan / PO";
            $this->template->display('content/welcome_message', $data);
        }

        //Transaksi Pemesanan Barang
        function tr_penerimaan_barang()
        {
            $data['judul']="Penerimaan Barang";
            $this->template->display('content/tr_penerimaan_barang', $data);
        }

        //Transaksi Surat Jalan
        function tr_surat_jalan()
        {
            $data['list_gudang']=$this->combo_model->list_gudang();
            $data['judul']="Surat Jalan";
            $this->template->display('content/tr_surat_jalan', $data);
        }

        //Transaksi DO
        function tr_do()
        {
            //$data['list_pelanggan']=$this->combo_model->list_gudang();
			$username = $this->session->userdata('username');
			$data['user']=$username;
            $data['judul']="Detail Order";
            $this->template->display('content/tr_do', $data);
        }
		
		function report_sj(){
			$data['judul']="Report SJ";
			$this->template->display('content/report_sj', $data);
		}
		
		function report_do(){
			$data['judul']="Report DO";
			$this->template->display('content/report_do', $data);
		}
		
		function report_mutasi(){
			$data['judul']="Report Mutasi";
			$this->template->display('content/report_mutasi', $data);
		}

		function report_os(){
			$data['judul']="Report os";
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
			
			#$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			
			#$this->output->set_header("Pragma: no-cache"); 
            redirect('login');
        }

        /*----End Respon Click Side Menu----*/
=======
<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
	class Menu extends CI_CONTROLLER {

		function __construct()
		{
			parent :: __construct();
			$this->is_logged_in();
            $this->load->library('template');
            $this->load->library('user_agent');
            $this->load->helper('url');
            $this->load->model('combo_model');
		}
		
        function is_logged_in()
		{
		  $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
		  redirect('login/index');
		  }
		}
        /*Load Home if login success*/
		function home()
		{
			$this->load->library('id_chart/id_chart');
			$data['c1'] = $this->id_chart->chart_embed('test',720,200,site_url('menu/example1'),base_url());
			$data['c2'] = $this->id_chart->chart_embed('test4',240,230,site_url('menu/example4'),base_url());
			
			$data['uagent'] = "";
            if ($this->agent->browser() == 'Internet Explorer' OR $this->agent->browser() == 'Firefox'){
                $data['uagent'] = "0";
            }else{
                $data['uagent'] = "1";
            }
            
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

        //Master Gudang
        function ms_gudang(){
            $data['judul']="Master Gudang";
            $this->template->display('content/master_gudang/ms_gudang', $data);
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
            $this->template->display('content/tr_penerimaan_barang', $data);
        }

        //Transaksi Surat Jalan
        function tr_surat_jalan()
        {
            $data['list_gudang']=$this->combo_model->list_gudang();
            $data['judul']="Surat Jalan";
            $this->template->display('content/tr_surat_jalan', $data);
        }

        //Transaksi DO
        function tr_do()
        {
            //$data['list_pelanggan']=$this->combo_model->list_gudang();
			$username = $this->session->userdata('username');
			$data['user']=$username;
            $data['judul']="Detail Order";
            $this->template->display('content/tr_do', $data);
        }
		
		function report_sj(){
			$data['judul']="Report SJ";
			$this->template->display('content/report_sj', $data);
		}
		
		function report_do(){
			$data['judul']="Report DO";
			$this->template->display('content/report_do', $data);
		}
		
		function report_mutasi(){
			$data['judul']="Report Mutasi";
			$this->template->display('content/report_mutasi', $data);
		}

		function report_os(){
			$data['judul']="Report os";
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
			
			#$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			
			#$this->output->set_header("Pragma: no-cache"); 
            redirect('login');
        }

        /*----End Respon Click Side Menu----*/
>>>>>>> 5b157d4c2def79fddaf1aeb020df420b65eaa098
	}