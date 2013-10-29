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
        	$this->load->model('tr_do_model');
            $so=$this->input->post('so');

            $data['hasil']=$this->tr_do_model->get_detail_do($so);
            $data['kode']=$so;
            $this->load->view("content/tr_terima_bayar/detail_terima_bayar",$data);
        }
        //SAVE ADD NEW TRIGGER
        function save($modes)
        {

            $id         = $this->input->post('id');
            $_tgl      	= date('Y-m-d', strtotime($this->input->post('_tgl')));
            $so        	= $this->input->post('so');
            $term     	= $this->input->post('term');
            $empty  	= empty($empty) ? NULL : $empty;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data1= array(
                'Kode'      =>$id,
                'Kode_SO'   =>$so,
                'Term'     	=>$term,
                'Tgl'    	=>$_tgl,
                'Status'    =>$empty
            );

            $data2= array(
                'Kode_SO'   =>$so,
                'Term'     	=>$term,
                'Tgl'    	=>$_tgl,
                'Status'    =>$empty
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
            $r = $this->tr_invoice_model->delete($po);
            echo $r;
        }        

    }