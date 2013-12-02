<?php
    class Tr_invoice extends CI_Controller{
        function __construct(){
            parent::__construct();
            #load library dan helper yang dibutuhkan
            $this->load->model('tr_invoice_model');
            $this->load->library(array('account/authorization'));
        }

        function index(){
            $data['hasil']=$this->tr_invoice_model->get_list();
            $this->load->view('content/tr_invoice/list_invoice', $data);
        }

        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->get_invoice();
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

        function getSJ(){
            $id=$this->input->post('id');
            $query = $this->tr_invoice_model->get_h_invoice($id);
            foreach($query as $row)
            {
                $originalDate = $row->Tgl;
                $dmy = date("d-m-Y", strtotime($originalDate));

                $final['Perusahaan'] = $row->Perusahaan;
                $final['Kode_Sj'] = $row->Kode_SJ;
                $final['Term'] = $row->Term;
                $final['Alamat'] = $row->Alamat1;
                $final['Tanggal'] = $dmy;

                $final['Total'] = $row->Total;
                $final['Disc'] = $row->Discount;
                $final['Dpp'] = $row->Dpp;
                $final['Ppn'] = $row->Ppn;
                $final['Grand'] = $row->Grand;

            }
            echo json_encode($final);
        }

        function retrieveTotal(){
            $id=$this->input->post('id');
            $query = $this->tr_invoice_model->get_h_so($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $final['Total'] = $row->Total;
                $final['Disc'] = $row->discount;
                $final['Dpp'] = $row->dpp;
                $final['Ppn'] = $row->ppn;
                $final['Grand'] = $row->grandttl;            
            }
            echo json_encode($final);
        }

        function Detail_SJ(){ //viewdo utk tabel detail DO
            $sj=$this->input->post('sj');

            $data['hasil']=$this->tr_invoice_model->get_detail_sj($sj);
            $this->load->view("content/tr_invoice/detail_invoice",$data);
        }

        //SAVE ADD NEW TRIGGER
        function save($modes)
        {

            $id         = $this->input->post('id');
            $_tgl      	= date('Y-m-d', strtotime($this->input->post('_tgl')));
            $so        	= $this->input->post('so');
			 $plg        	= $this->input->post('plg');
            $term     	= $this->input->post('term');
            $empty  	= empty($empty) ? NULL : $empty;

            $to = $this->input->post('to');            
            $disc = $this->input->post('disc');
            $dpp = $this->input->post('dpp');
            $ppn = $this->input->post('ppn');
            $grant = $this->input->post('grant');

            //ADD TO ARRAY FOR SEND TO MODEL
            $data1= array(
                'Kode'      =>$id,
                'Kode_SJ'   =>$so,
				'Kode_plg'   =>$plg,
                'Term'     	=>$term,
                'Tgl'    	=>$_tgl,
                'Status'    =>$empty,
                'Total'     =>$to,
                'Discount'  =>$disc,
                'Dpp'       =>$dpp,
                'Ppn'       =>$ppn,
                'Grand'     =>$grant,
				'Temp'		=>$grant
            );

            $data2= array(
                'Kode_SJ'   =>$so,
                'Term'     	=>$term,
				'Kode_plg'   =>$plg,
                'Tgl'    	=>$_tgl,
                'Status'    =>$empty,
                'Total'     =>$to,
                'Discount'  =>$disc,
                'Dpp'       =>$dpp,
                'Ppn'       =>$ppn,
                'Grand'     =>$grant,
				'Temp'		=>$grant
            );

            if($modes=="add"){
                $in = $this->tr_invoice_model->insert($data1,$id);               
                if($in == "ok")
                {
                    echo "ok";
                }
                else{
                    echo "gagal";
                }
            }else if($modes=="edit"){
                $in = $this->tr_invoice_model->update($data2,$id);
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
            $r = $this->tr_invoice_model->delete($po);
            echo $r;
        }        
		
		function update3()
        {
            $invo=$this->input->post('sj');
            $sj=$this->input->post('so');

			
            $data= array(
                    'Kode_SJ'=>$sj
            );
            $q = $this->tr_invoice_model->updateBatal($data,$invo);
            echo $q;
        }
    }