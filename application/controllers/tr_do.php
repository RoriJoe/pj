<?php
    class Tr_do extends CI_Controller{

        private $limit=10;

        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('tr_do_model');
        }

        //Get Data untuk table Detail
        function index(){
            //request data table
            $data['hasil']=$this->tr_do_model->get_paged_list();

            //load view
            $this->load->view('content/SO/tr_do_Detail', $data);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np
			$so = $this->input->post('so');
			$tglSo = date('Y-m-d', strtotime($this->input->post('tglSo')));
			$po = $this->input->post('po');
			$tglPo = date('Y-m-d', strtotime($this->input->post('tglPo')));
			$pl = $this->input->post('pl');
			$sl = $this->input->post('sl');
			$to = $this->input->post('to');
			
			$disc = $this->input->post('disc');
			$dpp = $this->input->post('dpp');
			$ppn = $this->input->post('ppn');
			$grant = $this->input->post('grant');
			$temp=8;
            $myvar  = empty($myvar) ? NULL : $myvar;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
				'No_Do'=>$so,
				'Tgl'=>$tglSo,
				'No_Po'=>$po,
				'Tgl_Po'=>$tglPo,
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
                    'Keterangan'=>$arrKet[$i]
                );
                $this->tr_do_model->insertDo_det($datadet,$so);
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
			$tglPo = date('Y-m-d', strtotime($this->input->post('tglPo')));
			$pl = $this->input->post('pl');
			$sl = $this->input->post('sl');
			$to = $this->input->post('to');
			//$total = $this->input->post('total');
			$temp=8;
            $myvar  = empty($myvar) ? NULL : $myvar;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(				
				'Tgl'=>$tglSo,
				'No_Po'=>$po,
				'Tgl_Po'=>$tglPo,
				'Kode_Plg'=>$pl,
				'Kode_Gudang'=>$temp,
				'Kirim'=>$myvar,
				'Otorisasi'=>$sl,
				'Total'=>$to
            );

            $in = $this->tr_do_model->updateDo($data,$so);
            
			
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
                    'Qty'=>$arrQty[$i],
                    'Harga'=>$arrHarga[$i],
                    'Jumlah'=>$arrJumlah[$i],
                    'Keterangan'=>$arrKet[$i]
                );
                $this->tr_do_model->updateDo_det($datadet,$so,$arrKode[$i]);
            }
			
			if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
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