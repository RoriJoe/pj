<?php
    class Report extends CI_Controller{
	
	    function __construct(){
	        parent::__construct();
	
	        #load library dan helper yang dibutuhkan
	        $this->load->library(array('table','form_validation'));
	        $this->load->helper(array('form','url'));
	    }
		
		function print_sj(){ //just for testing!!!!
			$data['judul'] = "Annual Report";
			$data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			$this->load->view("content/print_sj", $data);
		}
		
		function print_report_sj(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model');
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Surat_Jalan - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_sj',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
		
		function print_report_do(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model'); //edit!!
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Delivery_Order - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_do',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
		
		function print_report_mutasi(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model'); //edit!!
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Mutasi - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_mutasi',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
		
		function print_report_os(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model'); //edit!!
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Outstanding - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_os',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
		
		function print_report_penerimaan(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model'); //edit!!
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Penerimaan - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_penerimaan',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
		
		function print_report_ks(){
			#Export Function goes here#
			 /*This Function is used for Exporting Pdf
			 * Any chnage in this fuction may cause unknown behaviour
			 */
			 $this->load->model('tr_surat_jalan_model'); //edit!!
			 $this->load->helper('pdfexport_helper.php');
			
			 $data['tanggal'] = date('d/m/Y');
			 $data['jam'] = date('H:i:s');
			 $data['filename'] = "Report_Kartu_Stock - ". date('dmY');
			 $data['hasil2']=$this->tr_surat_jalan_model->get_paged_list();
			 //$data['htmView'] = $this->load->view('content/print_sj',$data,TRUE);
			 $templateView  = $this->load->view('content/print_ks',$data,TRUE);
			 exportMeAsMPDF($templateView,$data['filename']);                                                                 
		}
	}