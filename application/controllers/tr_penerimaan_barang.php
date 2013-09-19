<?php
    class Tr_penerimaan_barang extends CI_Controller{

        private $limit=10;

        function __construct(){
            parent::__construct();
			
            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('tr_penerimaan_barang_model');
        }
		
		//Get Data untuk table Detail
        function index(){
            //load data surat jalan
            $data['hasil']=$this->tr_penerimaan_barang_model->get_paged_list();
			
            //load view
            $this->load->view('content/tr_penerimaan_barang_Detail',$data);
        }


        function insert()
        {
            $a=$this->input->post('_bpb');
            $b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');
            $d=$this->input->post('_sp');
            $e=$this->input->post('_ref');

            $myvar  = empty($myvar) ? NULL : $myvar;
            $data= array(
                    'No_Bpb'=>$a,
                    'Tgl_Bpb'=>$b,
                    'No_Reff'=>$e,
                    'Kode_Supp'=>$d,
                    'Kode_Gudang'=>$c,
                );
            $in = $this->tr_penerimaan_barang_model->insert($data,$a);

			//DETAIL 
			$arrKode=$this->input->post('_arrKd_brg');
			$arrQty=$this->input->post('_arrQty');
			$arrKet=$this->input->post('_arrKet');
			$totalRow=$this->input->post('totalRow');
			for($i=0;$i<$totalRow;$i++){
                $datadet= array(
                    'No_Bpb'=>$a,
                    'Kode_brg'=>$arrKode[$i],
                    'Qty1'=>$arrQty[$i],
                    'Keterangan'=>$arrKet[$i]
                );
                $this->tr_penerimaan_barang_model->insert_det($datadet);
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
			$a=$this->input->post('_bpb');
            $b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');
            $d=$this->input->post('_sp');
            $e=$this->input->post('_ref');

            $myvar  = empty($myvar) ? NULL : $myvar;
            $data= array(
                    'Tgl_Bpb'=>$b,
                    'No_Reff'=>$e,
                    'Kode_Supp'=>$d,
                    'Kode_Gudang'=>$c,
                );
				
            $in = $this->tr_penerimaan_barang_model->update($data,$a);
			
			//DETAIL SO
			$arrKode=$this->input->post('_arrKd_brg');
			$arrQty=$this->input->post('_arrQty');
			$arrKet=$this->input->post('_arrKet');
			$totalRow=$this->input->post('totalRow');
			for($i=0;$i<$totalRow;$i++){
                $datadet= array(
                    'Qty1'=>$arrQty[$i],
                    'Keterangan'=>$arrKet[$i]
                );
                $this->tr_penerimaan_barang_model->update_det($datadet,$a,$arrKode[$i]);
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
            $kode=$this->input->post('_bpb');
            $r = $this->tr_penerimaan_barang_model->delete($kode);
            echo $r;
            $this->tr_penerimaan_barang_model->delete_det($kode);
        }
		
        function DetailTable(){
            $bpb=$this->input->post('bpb');

            $data['hasil']=$this->tr_penerimaan_barang_model->get_detail_pb($bpb);
            $data['kode']=$bpb;
            $this->load->view("content/detail_penerimaan_barang",$data);
        }
		
		#Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getbpb();
                foreach ($ag as $rr)
                {
                    $temp=$rr->No_Bpb;
                }
                $skr=substr($temp,3,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = "BPB".$tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = "BPB".$tb."0".$ang;}
                        else{
                            $no = "BPB".$tb."00".$ang;
                        }
                    }else {
                        $no = "BPB".$tb."001";
                    }
            echo $no;
        }
    }