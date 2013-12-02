<?php
    class Tr_do extends CI_Controller{
        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            //$this->load->helper(array('form','url'));
            $this->load->model('tr_do_model');
            $this->load->library(array('account/authentication', 'account/authorization'));
        }

        //Get Data untuk table Detail
        function index(){
            $data['hasil']=$this->tr_do_model->get_paged_list();
            $this->load->view('content/SO/tr_do_Detail', $data);
        }

        function retrieveForm(){
            $id=$this->input->post('id');
            $query = $this->tr_do_model->get_h_so($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $originalDate1 = $row->Tgl;
                $dmy1 = date("d-m-Y", strtotime($originalDate1));
                $originalDate2 = $row->Tgl_Po;
                $dmy2 = date("d-m-Y", strtotime($originalDate2));
                $tgl2 = '';
                if ($originalDate2 != null){
                    $tgl2 = $dmy2;
                }else{
                    $tgl2 = '';   
                }
                

                $final['Tgl'] = $dmy1;
                $final['Tgl_Po'] = $tgl2;
                $final['Po'] = $row->No_Po;
                $final['Nama_Plg'] = $row->Perusahaan;
                $final['Kode_Plg'] = $row->Kode_Plg;
                $final['Nama_Gudang'] = $row->Kirim;
                $final['Kode_Gudang'] = $row->Kode_Gudang;
                $final['Term'] = $row->Lama;
                $final['Kirim'] = $row->Kirim;
                $final['Otorisasi'] = $row->Otorisasi;
                $final['Total'] = $row->Total;
                $final['Disc'] = $row->discount;
                $final['Dpp'] = $row->dpp;
                $final['Ppn'] = $row->ppn;
                $final['Grand'] = $row->grandttl;            
            }
            echo json_encode($final);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np
			$myvar  = empty($myvar) ? NULL : $myvar;
            $so = $this->input->post('so');
			$tglSo = date('Y-m-d', strtotime($this->input->post('tglSo')));
			$po = $this->input->post('po');
			$tglPo = $this->input->post('tglPo');
            $tgl2 = '';
            if ($tglPo != ''){
                $tgl2 = date('Y-m-d', strtotime($this->input->post('tglPo')));
            }else{
                $tgl2 = $myvar;
            }
			$pl = $this->input->post('pl');
			$sl = $this->input->post('sl');
			$to = $this->input->post('to');
            $term = $this->input->post('term');
			
			$disc = $this->input->post('disc');
			$dpp = $this->input->post('dpp');
			$ppn = $this->input->post('ppn');
			$grant = $this->input->post('grant');
			$temp=8;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
				'No_Do'=>$so,
				'Tgl'=>$tglSo,
				'No_Po'=>$po,
				'Tgl_Po'=>$tgl2,
				'Kode_Plg'=>$pl,
				'Kode_Gudang'=>$temp,
				'Kirim'=>$myvar,
				'Otorisasi'=>$sl,
				'Total'=>$to,
				'discount'=>$disc,
				'dpp'=>$dpp,
				'ppn'=>$ppn,
				'grandttl'=>$grant
            );

            $term=array('Lama'=>$term);

            $this->tr_do_model->updateTerm($term,$pl);
            $in = $this->tr_do_model->insertDo($data,$so);
            
			
			//DETAIL SO
			$arrKode=$this->input->post('arrKode');
			$arrQty=$this->input->post('arrQty');
			$arrSatuan=$this->input->post('arrSatuan');
			$arrHarga=$this->input->post('arrHarga');
			$arrJumlah=$this->input->post('arrJumlah');
			$arrKet=$this->input->post('arrKet');
			$totalRow=$this->input->post('totalRow');
			for($i=0;$i<$totalRow;$i++){
                $datadet= array(
                    'No_Do'=>$so,
                    'Kode_Brg'=>$arrKode[$i],
                    'Qty'=>$arrQty[$i],
                    'Harga'=>$arrHarga[$i],
                    'Jumlah'=>$arrJumlah[$i],
                    'Keterangan'=>$arrKet[$i],
					'QtyTemp'=>$arrQty[$i]
                );
                $this->tr_do_model->insertDo_det($datadet,$so);
            }
			//update stok jual
			for($i=0;$i<$totalRow;$i++){
                $this->tr_do_model->update_brg($arrKode[$i],$arrQty[$i]);
            }
			
			if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }

        //save update
        function update()
        {

            $so = $this->input->post('so');
			$tglSo = date('Y-m-d', strtotime($this->input->post('tglSo')));
			$po = $this->input->post('po');
			$tglPo = $this->input->post('tglPo');

			$pl = $this->input->post('pl');
			$sl = $this->input->post('sl');
			$to = $this->input->post('to');
			$disc = $this->input->post('disc');
			$dpp = $this->input->post('dpp');
			$ppn = $this->input->post('ppn');
			$grant = $this->input->post('grant');
            $term = $this->input->post('term');
			//$total = $this->input->post('total');
			$temp=8;
            $myvar  = empty($myvar) ? NULL : $myvar;

            $tgl2 = '';
            if ($tglPo != ''){
                $tgl2 = date('Y-m-d', strtotime($this->input->post('tglPo')));
            }else{
                $tgl2 = $myvar;
            }

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(				
				'Tgl'=>$tglSo,
				'No_Po'=>$po,
				'Tgl_Po'=>$tgl2,
				'Kode_Plg'=>$pl,
				'Kode_Gudang'=>$temp,
				'Kirim'=>$myvar,
				'Otorisasi'=>$sl,
				'Total'=>$to,
				'discount'=>$disc,
				'dpp'=>$dpp,
				'ppn'=>$ppn,
				'grandttl'=>$grant
            );
            $term=array('Lama'=>$term);
            $this->tr_do_model->updateTerm($term,$pl);
            $in = $this->tr_do_model->updateDo($data,$so);
            
			
			//DETAIL SO
			$arrKode=$this->input->post('arrKode');
			$arrQty=$this->input->post('arrQty');
			$arrSatuan=$this->input->post('arrSatuan');
			$arrHarga=$this->input->post('arrHarga');
			$arrJumlah=$this->input->post('arrJumlah');
			$arrKet=$this->input->post('arrKet');
			$totalRow=$this->input->post('totalRow');
                $datadet= array(
                    'Kode_Brg'=>$arrKode,
                    'Qty'=>$arrQty,
                    'Harga'=>$arrHarga,
                    'Jumlah'=>$arrJumlah,
                    'Keterangan'=>$arrKet,
					'QtyTemp'=>$arrQty
                );
            $this->tr_do_model->updateDo_det($datadet,$so);
			
			if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
		
		function update3()
        {
            $so=$this->input->post('sj');
            $po=$this->input->post('so');

			$arrKode=$this->input->post('arrKode');
			$arrQty=$this->input->post('arrQty');
			 $totalRow=$this->input->post('totalRow');
			 for($i=0;$i<$totalRow;$i++){
                $this->tr_do_model->update_brg2($arrKode[$i],$arrQty[$i]);//buat kembaliin qty
            }
            $data= array(
                    'No_Po'=>$po
            );
            $q = $this->tr_do_model->updateBatal($data,$so);
            echo $q;
        }
        //save delete
        function delete()
        {
            $so=$this->input->post('so');
            $r = $this->tr_do_model->delete($so);
            echo $r;
            $this->tr_do_model->delete_det($so);
        }

        function tableDetail(){ //viewdo utk tabel detail DO
            $so=$this->input->post('so');

            $data['hasil']=$this->tr_do_model->get_detail_do($so);
            $data['kode']=$so;
            $this->load->view("content/SO/detail_DO",$data);

        }
        
        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getso();
                foreach ($ag as $rr)
                {
                    $temp=$rr->No_Do;
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

        function viewSO(){
            $data['hasil'] = $this->tr_do_model->view();
            $this->load->view("content/list/list_so",$data);
        }
    }