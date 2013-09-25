<?php
    class Tr_po extends CI_Controller{
        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('tr_po_model');
        }

        //Get Data untuk Table List
        function index(){
            $data['hasil']=$this->tr_po_model->get_paged_list();
            $this->load->view('content/tr_pemesanan/list_tr_pemesanan', $data);
        }
        
        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getpo();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
                $skr=substr($temp,2,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = "PO".$tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = "PO".$tb."0".$ang;}
                        else{
                            $no = "PO".$tb."00".$ang;
                        }
                    }else {
                        $no = "PO".$tb."001";
                    }
            echo $no;
        }
        
        function add_currency(){
            $id=$this->input->post('cur');
            
             $data= array(
                'value'=>$id
             );
             $in = $this->tr_po_model->add_cur($data,$id);
             if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
        
        function tableDetail(){ 
            $po=$this->input->post('po');

            $data['hasil']=$this->tr_po_model->get_detail_po($po);
            $data['kode']=$po;
            $this->load->view("content/tr_pemesanan/detail_pemesanan",$data);
        }
    }

/*
 * End Of File
 * File Location: controller/tr_po
 */