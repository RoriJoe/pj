<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');

class Piutang extends CI_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('piutang_model');
	}

	function index(){
		$data['hasil']=$this->piutang_model->get_list();
		$this->load->view('content/piutang/list_piutang',$data);
	}

	function invoice_call(){
		$id = $this->input->post('id');
		$query = $this->piutang_model->get_invo_list($id);

		$final['']='-- Select --';
		foreach ($query as $a) 
		{
			$final[$a->Kode] = $a->Kode;
		}

		echo form_dropdown('_invoice',$final,'1','id="_invoice" onchange="displayResult(this)"');
	}

	function detail_invoice(){
        $keyword=$this->input->post('x');
        $query=$this->piutang_model->find($keyword);

            $data['message']=array();
            foreach($query as $row)
            {
                $final['Tgl'] = date("d-m-Y", strtotime($row->Tgl));;
                $final['Term'] = $row->Term;
                $final['Status'] = $row->Status;
                $final['No_Po'] = $row->No_Po;
                $final['Total'] = $row->Total;
            }
        echo json_encode($final);
	}
}