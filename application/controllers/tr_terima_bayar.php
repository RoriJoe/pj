<?php
    class Tr_terima_bayar extends CI_Controller{
        function __construct(){
            parent::__construct();
            #load library dan helper yang dibutuhkan
            $this->load->model('tr_terima_bayar_model');
        }

        function index(){
            $data['hasil']=$this->tr_terima_bayar_model->get_list();
            $this->load->view('content/tr_terima_bayar/list_terima_bayar', $data);
        }

        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->get_terimabyr();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
                $skr=substr($temp,0,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = $tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = $tb."0".$ang;}
                        else{
                            $no = $tb."00".$ang;
                        }
                    }else {
                        $no = $tb."001";
                    }
            echo $no;
        }

        function get_so(){
        	$temp="";
        	$id = $this->input->post('so');
        	$result = $this->tr_invoice_model->get_so($id);
        	foreach ($result as $rr)
            {
                $temp=$rr->Perusahaan."|".$rr->Kode_Plg."|".$rr->Alamat1."|".$rr->No_Do;
            }
            echo $temp;
        }
        function Detail_SO(){ //viewdo utk tabel detail DO
        	$this->load->model('tr_terima_bayar_model');
           $no=$this->input->post('no');

           $data['hasil']=$this->tr_terima_bayar_model->get_detail_invo($no);
            $data['kode']=$no; 
            $this->load->view("content/tr_terima_bayar/detail_terima_bayar",$data);
        }
		
		function Detail_bayar(){ //viewdo utk tabel detail DO
        	$this->load->model('tr_terima_bayar_model');
           $no=$this->input->post('no');

           $data['hasil']=$this->tr_terima_bayar_model->get_detail_bayar($no);
            $data['kode']=$no; 
            $this->load->view("content/tr_terima_bayar/detail_terima_byr1",$data);
        }
		
		function Detail_invo(){ //viewdo utk tabel detail DO
        	$this->load->model('tr_terima_bayar_model');
           $no=$this->input->post('no');

           $data['hasil']=$this->tr_terima_bayar_model->get_detail_invoic($no);
            $data['kode']=$no; 
            $this->load->view("content/tr_terima_bayar/detail_terima_byr2",$data);
        }
        //SAVE ADD NEW TRIGGER
        function save($modes)
        {

            $id         = $this->input->post('id');
            $_tgl      	= date('Y-m-d', strtotime($this->input->post('_tgl')));
            $kode_plg   = $this->input->post('kode_plg');
            $totInv     = $this->input->post('totInv');
			$totByr     = $this->input->post('totByr');
			$baris1     = $this->input->post('baris1');
			$baris2     = $this->input->post('baris2');
			$baris3     = $this->input->post('baris3');
			
			$arrInvoice     = $this->input->post('arrInvoice');
			$arrNbayar     = $this->input->post('arrNbayar');
			$arrNinvo     = $this->input->post('arrNinvo');
			$arrJenisB     = $this->input->post('arrJenisB');
			$arrNilaiB     = $this->input->post('arrNilaiB');
			
			$arrJenis     = $this->input->post('arrJenis');
			$arrBank1     = $this->input->post('arrBank1');
			$arrReken1     = $this->input->post('arrReken1');
			
			$arrRef     = $this->input->post('arrRef');
			$arrTgl1     = $this->input->post('arrTgl1');
			$arrTgl2     = $this->input->post('arrTgl2');
			$arrNil     = $this->input->post('arrNil');
			$arrBank2     = $this->input->post('arrBank2');
			$arrReken2     = $this->input->post('arrReken2');
			
			
			
			
            $empty  	= empty($empty) ? NULL : $empty;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data1= array(
                'Kode'      =>$id,
                'Kode_plg'   =>$kode_plg,
                'Tgl'    	=>$_tgl
            );
			
			
			
            if($modes=="add"){
                $in = $this->tr_terima_bayar_model->insert($data1,$id);
				
				//insert detail
				for($i=0;$i<$baris1;$i++){
				$data= array(
					'Kode'   =>$id,
					'NoInvoice' =>$arrInvoice[$i],
					'NilaiInvoice'    	=>$arrNinvo[$i],
					'NilaiBayar'    =>$arrNbayar[$i],
					'Total'=>$totInv
				);
				$this->tr_terima_bayar_model->insert_det1($data);
			}
			
			for($i=0;$i<$baris2;$i++){
				$data2= array(
					'Kode'   =>$id,
					'Jenis'    =>$arrJenisB[$i],
					'Nilai'    =>$arrNilaiB[$i],
					'Total'  =>$totByr  
				);
				$this->tr_terima_bayar_model->insert_det2($data2);
			}
			
			for($i=0;$i<$baris3;$i++){
			$tgl1=date('Y-m-d', strtotime($arrTgl1[$i]));
			$tgl2=date('Y-m-d', strtotime($arrTgl2[$i]));
				$data3= array(
					'Kode'   =>$id,
					'Jenis'    =>$arrJenis[$i],
					'DariBank'    =>$arrBank1[$i],
					'DariRek'    =>$arrReken1[$i],
					'Ref'    =>$arrRef[$i],
					'TglGiro'    =>$tgl1,
					'TglCair'    =>$tgl2,
					'Nilai'    =>$arrNil[$i],
					'TerimaBank'    =>$arrBank2[$i],
					'TerimaRek'    =>$arrReken2[$i]
				);
				$this->tr_terima_bayar_model->insert_det3($data3);
			}
				
                if($in == "ok")
                {
                    echo "ok";
                }
                else{
                    echo "gagal";
                }
            }else if($modes=="edit"){
                $in = $this->tr_invice_model->update($data2,$id);
                if($in == "ok")
                {
                    echo "ok";
                }
                else{
                    echo "gagal";
                }
            } 
        }

        //save delete
        function delete()
        {
            $po=$this->input->post('id');
            $r = $this->tr_terima_bayar_model->delete($po);
			$this->tr_terima_bayar_model->delete_d($po);
			$this->tr_terima_bayar_model->delete_d2($po);
			$this->tr_terima_bayar_model->delete_d3($po);
            echo $r;
        }

		function invoice_call(){
            $id = $this->input->post('id');
			 $ro = $this->input->post('ro');
            $query = $this->tr_terima_bayar_model->get_invoice_list($id);

            $final['']='-- No Invoice --';
            foreach ($query as $a) 
            {
                $final[$a->Kode] = $a->Kode;
            }

            echo form_dropdown('invoi'.$ro,$final,'1',"id='invoi".$ro."' onchange='displayResult(this,".$ro.")'");
        }
		function ambil_invoice(){
            $temp="";
            $invoice=$this->input->post('invoice');
            $this->load->model("tr_terima_bayar_model");
            $tm = $this->tr_terima_bayar_model->get_invo($invoice);

            foreach ($tm as $rr)
            {
                $temp=$rr->Kode."|".$rr->Kode_plg."|".$rr->Tgl."|".$rr->granTotal;
            }
            echo $temp;
        }
		
		function view_inv_pelanggan(){

            $data['hasil']=$this->tr_terima_bayar_model->get_list_inv();
            //load view
            $this->load->view('content/list/list_pelanggan',$data);
        }
		
		
		//bank
		function bank_call(){
            
			 $ro = $this->input->post('ro');
            $query = $this->tr_terima_bayar_model->get_bank_list();

            $final['']='-- Bank --';
            foreach ($query as $a) 
            {
                $final[$a->nama_bank] = $a->nama_bank;
            }

            echo form_dropdown('bank'.$ro,$final,'1',"id='bank".$ro."' onchange='displayResult2(this,".$ro.")'");
        }
		function rek_call(){
            $bank=$this->input->post('bank');
			 $ro = $this->input->post('ro');
            $query = $this->tr_terima_bayar_model->get_rek_list($bank);

            $final['']='-- Rek --';
            foreach ($query as $a) 
            {
                $final[$a->no_rekening] = $a->no_rekening;
            }

            echo form_dropdown('rek'.$ro,$final,'1',"id='rek".$ro."' style='width:105px;'");
        }
		

    }