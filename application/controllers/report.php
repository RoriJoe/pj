<?php
    class Report extends CI_Controller{
	
	    function __construct(){
	        parent::__construct();
	
	        #load library dan helper yang dibutuhkan
	        $this->load->library(array('table','form_validation'));
	        $this->load->helper(array('form','url'));
	        $this->load->helper(array('my_pdf'));   //  Load helper
	    }
		
		function print_sj(){ //just for testing!!!!
			$data['judul'] = "Annual Report";
			$data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			$this->load->view("content/print_sj", $data);
		}
		
		function print_transaksi_po(){
			$this->load->model('tr_po_model');
            $id=$this->input->post('po');
            $kirim=$this->input->post('count');
            $data2= array(
                    'Counter'=>$kirim,
            );
            $q = $this->tr_po_model->update_kirim($data2,$id);

            $data['po']=$this->input->post('po');
			$data['_tgl1']=date('d-m-Y', strtotime($this->input->post('_tgl1')));
			$data['_tgl2']=date('d-m-Y', strtotime($this->input->post('_tgl2')));
			$data['kd_gud']=$this->input->post('kd_gud');
			$data['proy']=$this->input->post('proy');
			$data['permintaan']=$this->input->post('permintaan');
			$data['cur']=$this->input->post('cur');
			$data['urg']=$this->input->post('urg');
			$data['kd_sup']=$this->input->post('kd_sup');
			
			$data['dpp']=$this->input->post('dpp');
			$data['ppn']=$this->input->post('ppn');
			$data['to']=$this->input->post('to');
			$data['totalRow']=$this->input->post('totalRow');
			
			$data['arrKode']=$this->input->post('arrKode');
			$data['arrHarga']=$this->input->post('arrHarga');
			$data['arrJumlah']=$this->input->post('arrJumlah');
			$data['arrNilai']=$this->input->post('arrNilai');
			$data['arrNamabrg']=$this->input->post('arrNamabrg');
			$data['arrSatuan']=$this->input->post('arrSatuan');

			$this->load->view('content/print_transaksi_po',$data);
		}
		
		function print_transaksi_penerimaan(){
	
			$data['_bpb']=$this->input->post('_bpb');
			$data['_tgl']=date('d-m-Y', strtotime($this->input->post('_tgl')));
			$data['_gd']=$this->input->post('_gd');
			$data['_sp']=$this->input->post('_sp');
			$data['_ref']=$this->input->post('_ref');
			
			$data['totalRow']=$this->input->post('totalRow');
			
			$data['_arrKd_brg']=$this->input->post('_arrKd_brg');
			$data['_arrNm_brg']=$this->input->post('_arrNm_brg');
			$data['_arrUkur']=$this->input->post('_arrUkur');
			$data['_arrQty']=$this->input->post('_arrQty');
			$data['_arrKet']=$this->input->post('_arrKet');

			$this->load->view('content/print_transaksi_penerimaan',$data);
		}
		
		function print_transaksi_sj(){
			$this->load->model('tr_surat_jalan_model');
            $sj=$this->input->post('sj');
            $kirim=$this->input->post('count');
            $datas= array(
                    'Kirim'=>$kirim,
            );
            $q = $this->tr_surat_jalan_model->update_kirim($datas,$sj);
            
			$this->load->helper('pdfexport_helper.php');
			
			$data['sj']=$this->input->post('sj');
            $data['_tgl']=date('d-m-Y', strtotime($this->input->post('_tgl')));
            $data['_do']=$this->input->post('_do');
            $data['gg']=$this->input->post('gg');
            $data['pn']=$this->input->post('pn');
            $data['po']=$this->input->post('po');
            $data['mbl']=$this->input->post('mbl');
            $data['ket']=$this->input->post('ket');
			
			$data['kd_brg']=$this->input->post('kd_brg');
            $data['nama']=$this->input->post('nama');
            $data['nbu']=$this->input->post('nbu');
            $data['qty']=$this->input->post('qty');
            $data['ktr']=$this->input->post('ktr');
            $data['totaltx']=$this->input->post('totaltx');

			$data['filename'] = "SJ - ". date('dmY');
			$this->load->view('content/print_transaksi_sj',$data);
			//$templateView  = $this->load->view('content/print_transaksi_sj',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);
		}
		
		function print_transaksi_so(){
			//$this->load->helper('pdfexport_helper.php');
			
			$data['so']=$this->input->post('so');
            $data['tglSo']=date('d-m-Y', strtotime($this->input->post('tglSo')));
			$data['tglPo']=date('d-m-Y', strtotime($this->input->post('tglPo')));
            $data['po']=$this->input->post('po');
            $data['pl']=$this->input->post('pl');
            $data['sl']=$this->input->post('sl');
            $data['to']=$this->input->post('to');
			
			$data['disc']=$this->input->post('disc');
            $data['discT']=$this->input->post('discT');
			 $data['dpp']=$this->input->post('dpp');
            $data['ppnT']=$this->input->post('ppnT');
            $data['ppn']=$this->input->post('ppn');
            $data['grant']=$this->input->post('grant');
			
			$data['totalRow']=$this->input->post('totalRow');
			$data['arrKode']=$this->input->post('arrKode');
            $data['arrQty']=$this->input->post('arrQty');
            $data['arrSatuan']=$this->input->post('arrSatuan');
            $data['arrHarga']=$this->input->post('arrHarga');
            $data['arrJumlah']=$this->input->post('arrJumlah');
            $data['arrKet']=$this->input->post('arrKet');
			
			$data['filename'] = "Report_Transaksi_SJ - ". date('dmY');
			$this->load->view('content/print_transaksi_so',$data);
			//$templateView  = $this->load->view('content/print_transaksi_sj',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);
			//create_pdf($templateView, $data['filename']); //Create pdf     
		}

		
		//MASTER 
		
		function print_master_barang(){
			$this->load->model('report_model');
			$data['tanggal'] = date('d/m/Y');
			$data['filename'] = "Daftar Barang - ". date('dmY');
			$data['hasil2']=$this->report_model->print_master_barang();
			$templateView  = $this->load->view('content/print_master_barang',$data);
			      
		}
		
		function print_master_pelanggan(){
			$this->load->model('report_model');
			$data['tanggal'] = date('d/m/Y');
			$data['filename'] = "Daftar Pelanggan - ". date('dmY');
			$data['hasil2']=$this->report_model->print_master_pelanggan();
			$templateView  = $this->load->view('content/print_master_pelanggan',$data);
			      
		}
		function print_master_supplier(){
			$this->load->model('report_model');
			$data['tanggal'] = date('d/m/Y');
			$data['filename'] = "Daftar Pelanggan - ". date('dmY');
			$data['hasil2']=$this->report_model->print_master_supplier();
			$templateView  = $this->load->view('content/print_master_supplier',$data);
			      
		}
		function print_master_gudang(){
			$this->load->model('report_model');
			$data['tanggal'] = date('d/m/Y');
			$data['filename'] = "Daftar Pelanggan - ". date('dmY');
			$data['hasil2']=$this->report_model->print_master_gudang();
			$templateView  = $this->load->view('content/print_master_gudang',$data);
			      
		}
		/*
		REPORT SECTION
		*/
		
		function print_report_sj(){
			#Export Function goes here#
			/*This Function is used for Exporting Pdf
			* Any chnage in this fuction may cause unknown behaviour
			*/
			$this->load->model('report_model');
			//$this->load->helper('pdfexport_helper.php');

			$radio = $this->input->post("optionsRadios");
			if($radio=="Batas"){
			$tgl=date('Y-m-d', strtotime($this->input->post('_tgl')));

			$tgl2=date('Y-m-d', strtotime($this->input->post('_tgl2')));
			$radio = $radio." ( ".$this->input->post('_tgl')." - ".$this->input->post('_tgl2')." )";
			}else{ $tgl=""; $tgl2=""; }

			$data['periode']=$radio;
			$data['tanggal'] = date('d/m/Y');
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Surat_Jalan - ". date('dmY');
			$data['hasil2']=$this->report_model->print_sj($radio,$tgl,$tgl2);
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_sj',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);  
			create_pdf($templateView, $data['filename']); //Create pdf                                                               
		}
		
		function print_report_do(){
			$this->load->model('report_model'); //edit!!
			//$this->load->helper('pdfexport_helper.php');

			$radio = $this->input->post("optionsRadios");
			if($radio=="Batas"){
			$tgl=date('Y-m-d', strtotime($this->input->post('_tgl')));

			$tgl2=date('Y-m-d', strtotime($this->input->post('_tgl2')));
			$radio = $radio." ( ".$this->input->post('_tgl')." - ".$this->input->post('_tgl2')." )";
			}else{ $tgl=""; $tgl2=""; }

			$data['periode']=$radio;
			$data['tanggal'] = date('d/m/Y');
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Delivery_Order - ". date('dmY');
			$data['hasil2']=$this->report_model->print_do($radio,$tgl,$tgl2);
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_do',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);    
			create_pdf($templateView, $data['filename']); //Create pdf  
		}
		
		function print_report_mutasi(){
			#Export Function goes here#
			/*This Function is used for Exporting Pdf
			* Any chnage in this fuction may cause unknown behaviour
			*/
			$this->load->model('report_model'); //edit!!
			//$this->load->helper('pdfexport_helper.php');

			$barang1 = $this->input->post("barang1");
			$barang2 = $this->input->post("barang2");
			
			$tgl = date('Y-m-d', strtotime($this->input->post("_tgl")));
			$tgl2 = date('Y-m-d', strtotime($this->input->post("_tgl2")));
			$data['tanggal'] = date('d/m/Y');
			$data['periode'] = $this->input->post("_tgl")." - ".$this->input->post("_tgl2");
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Mutasi - ". date('dmY');
			$data['hasil2']=$this->report_model->print_mutasi($barang1,$barang2,$tgl,$tgl2);
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_mutasi',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);  
			create_pdf($templateView, $data['filename']);                                                               
		}
		
		function print_report_os(){
			#Export Function goes here#
			/*This Function is used for Exporting Pdf
			* Any chnage in this fuction may cause unknown behaviour
			*/
			$this->load->model('report_model'); //edit!!
			//$this->load->helper('pdfexport_helper.php');

			$data['tanggal'] = date('d/m/Y');
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Outstanding - ". date('dmY');
			$data['hasil2']=$this->report_model->print_os();
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_os',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);  
			create_pdf($templateView, $data['filename']);                                                               
		}
		
		function print_report_penerimaan(){
			#Export Function goes here#
			/*This Function is used for Exporting Pdf
			* Any chnage in this fuction may cause unknown behaviour
			*/
			$this->load->model('report_model'); //edit!!
			//$this->load->helper('pdfexport_helper.php');

			$radio = $this->input->post("optionsRadios");
			if($radio=="Batas"){
			$tgl=date('Y-m-d', strtotime($this->input->post('_tgl')));

			$tgl2=date('Y-m-d', strtotime($this->input->post('_tgl2')));
			$radio = $radio." ( ".$this->input->post('_tgl')." - ".$this->input->post('_tgl2')." )";
			}else{ $tgl=""; $tgl2=""; }

			$data['periode']=$radio;
			$data['tanggal'] = date('d/m/Y');
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Penerimaan - ". date('dmY');
			$data['hasil2']=$this->report_model->print_penerimaan($radio,$tgl,$tgl2);
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_penerimaan',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);
			create_pdf($templateView, $data['filename']);                                                                 
		}
		
		function print_report_ks(){
			#Export Function goes here#
			/*This Function is used for Exporting Pdf
			* Any chnage in this fuction may cause unknown behaviour
			*/
			$this->load->model('report_model'); //edit!!
			//$this->load->helper('pdfexport_helper.php');
			$barang1 = $this->input->post("barang1");
			$barang2 = $this->input->post("barang2");
			$tgl = $this->input->post("_tgl");
			$tgl2 = $this->input->post("_tgl2");
			$data['asd']= $barang1.$barang2;
			$data['tanggal'] = date('d/m/Y');
			$data['jam'] = date('H:i:s');
			$data['filename'] = "Report_Kartu_Stock - ". date('dmY');
			$data['hasil2']=$this->report_model->print_kartustock($barang1,$barang2,$tgl,$tgl2);
			//$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			$templateView  = $this->load->view('content/print_ks',$data,TRUE);
			//exportMeAsMPDF($templateView,$data['filename']);
			create_pdf($templateView, $data['filename']);                                                                 
		}
	}