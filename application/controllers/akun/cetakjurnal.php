<?php
	class cetakjurnal extends CI_Controller {
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('account/authorization', 'form_validation'));
			$this->load->model(array('account/account_model', 'akun/mjurnal'));
		}

		function index(){
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			$data['Jurnal']=$this->mjurnal->GetDetailJurCtk();
			$Tgla = strtotime($this->mjurnal->GetTglJurnal("MIN"));
			$Tglb = strtotime($this->mjurnal->GetTglJurnal("MAX"));
			$TglAwlb = date('d F Y', $Tgla);
			$TglAkhrb = date('d F Y', $Tglb);
			$data['TglAwl']=$TglAwlb;
			$data['TglAkhr']=$TglAkhrb;
			$data['Combo']=$this->mjurnal->GetComboJurnal();
			$data['ComboMin']=$this->mjurnal->GetMMJurnal("MIN");
			$data['ComboMax']=$this->mjurnal->GetMMJurnal("MAX");
			$this->load->view("akun/cetakjurnal",$data);
		}
		function CariJurnal(){
			$data['Jurnal']=$this->mjurnal->SearchDetailJurCtk($_POST['TglAwl'],$_POST['TglAkhr'],$_POST['NoVo1'],$_POST['NoVo2']);
			$this->load->view("akun/AjxCetakJurnal",$data);
		}
		
	}