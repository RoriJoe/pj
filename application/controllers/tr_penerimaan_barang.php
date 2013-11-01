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
            $this->load->view('content/tr_penerimaan/tr_penerimaan_barang_detail',$data);
        }

        function viewPO(){
            $id=$this->input->post('po');
            $data['hasil']=$this->tr_penerimaan_barang_model->get_detail_po($id);
            $this->load->view("content/tr_penerimaan/detail_penerimaan_barang",$data);
        }

        function viewPOdata(){
            $id=$this->input->post('po');
            $query=$this->tr_penerimaan_barang_model->get_detail_poData($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $final['Kode_Gudang'] = $row->Kode_gud;
                $final['Gudang'] = $row->Nama;
                $final['Kode_Supplier'] = $row->Kode_sup;
                $final['Supplier'] = $row->Perusahaan;
            }
            echo json_encode($final);
        }


        function insert()
        {
            $a=$this->input->post('_bpb');
            //$b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');
            $d=$this->input->post('_sp');
            $e=$this->input->post('_ref');
            $f=$this->input->post('po');

            $myvar  = empty($myvar) ? NULL : $myvar;
            $tglPo = $this->input->post('_tgl');
            $tgl2 = '';
            if ($tglPo != ''){
                $tgl2 = date('Y-m-d', strtotime($this->input->post('_tgl')));
            }else{
                $tgl2 = $myvar;
            }

            
            $data= array(
                    'No_Bpb'=>$a,
                    'Tgl_Bpb'=>$tgl2,
                    'No_Reff'=>$e,
                    'Kode_Supp'=>$d,
                    'Kode_Gudang'=>$c,
                    'No_Po'=>$f,
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
			for($i=0;$i<$totalRow;$i++){
                $this->tr_penerimaan_barang_model->update_brg($arrKode[$i],$arrQty[$i]);
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
            //$b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');
            $d=$this->input->post('_sp');
            $e=$this->input->post('_ref');
            $f=$this->input->post('po');

            //$myvar  = empty($myvar) ? NULL : $myvar;
            $myvar  = empty($myvar) ? NULL : $myvar;
            $tglPo = $this->input->post('_tgl');
            $tgl2 = '';
            if ($tglPo != ''){
                $tgl2 = date('Y-m-d', strtotime($this->input->post('_tgl')));
            }else{
                $tgl2 = $myvar;
            }

            $data= array(
                    'Tgl_Bpb'=>$tgl2,
                    'No_Reff'=>$e,
                    'Kode_Supp'=>$d,
                    'Kode_Gudang'=>$c,
                    'No_Po'=>$f,
                );
				
            $in = $this->tr_penerimaan_barang_model->update($data,$a);
			
			//DETAIL SO
			$arrKode=$this->input->post('_arrKd_brg');
			$arrQty=$this->input->post('_arrQty');
			$arrKet=$this->input->post('_arrKet');
			$totalRow=$this->input->post('totalRow');

            $datadet= array(
                'Kode_brg'=>$arrKode,
                'Qty1'=>$arrQty,
                'Keterangan'=>$arrKet
            );
            $this->tr_penerimaan_barang_model->update_det($datadet,$a);
			
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
            $this->load->view("content/tr_penerimaan/detail_penerimaan_barang",$data);
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

        function po_call(){
            $query = $this->tr_penerimaan_barang_model->get_po_list();

            $final['']='-- Select PO --';
            foreach ($query as $a) 
            {
                $final[$a->Kode] = $a->Kode;
            }

            echo form_dropdown('po',$final,'1','id="po" onchange="get_po_data()"');
        }
    }