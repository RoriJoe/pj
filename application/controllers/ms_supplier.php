<?php
    class Ms_supplier extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ms_supplier_model');
            $this->load->library(array('account/authentication', 'account/authorization'));
        }

        //Get Data untuk table Detail 
        function index(){
            $data['hasil']=$this->ms_supplier_model->get_paged_list();
            $this->load->view('content/master_supplier/ms_supplier_Detail',$data);
        }
		
		#Show All u/ table List
        function viewSupplier(){
            //request data table
            $data['hasil']=$this->ms_supplier_model->get_paged_list();
                
            //load view
            $this->load->view('content/list/list_supplier',$data);
        }

        //POP
        function popSupplier(){
            $this->load->view('content/pop/supplier');
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd,pr:pr,nm:nm,al:al,kt:kt,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,lk:lk
            $id=$this->input->post('kd');            
            $perusahaan=$this->input->post('pr');            
            $nama=$this->input->post('nm');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $tl1=$this->input->post('tl1');
            $tl2=$this->input->post('tl2');
            $tl3=$this->input->post('tl3');
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $lk=$this->input->post('lk');
            
            $myvar  = empty($myvar) ? NULL : $myvar;
            $myvar2  = empty($myvar2) ? NULL : $myvar2;
            
            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'Kode'=>$id,
                    'Nama'=>$nama,
                    'Nama1'=>$myvar,
                    'Perusahaan'=>$perusahaan,
                    'Alamat1'=>$al,
                    'Alamat2'=>$myvar2,
                    'Kota'=>$kt,
                    'Telp'=>$tl1,
                    'Telp1'=>$tl2,
                    'Telp2'=>$tl3,  
                    'Fax1'=>$fx1,
                    'fax2'=>$fx2,
                    'Limit_Kredit'=>$lk,
            );
            
            $in = $this->ms_supplier_model->insert($data,$id);
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
        
        //Lihat Data sebelum update
        function viewupdate()
        {
            $id=$this->input->post('id');
            $data['hasil']=$this->ms_supplier_model->getUpdate($id);
            $this->load->view("content/update_supplier",$data);
        }
        //save update
        function update()
        {
            $id=$this->input->post('kd');            
            $perusahaan=$this->input->post('pr');            
            $nama=$this->input->post('nm');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $tl1=$this->input->post('tl1');
            $tl2=$this->input->post('tl2');
            $tl3=$this->input->post('tl3');
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $lk=$this->input->post('lk');
            $myvar  = empty($myvar) ? NULL : $myvar;
            $myvar2  = empty($myvar2) ? NULL : $myvar2;
            
            $data= array(
                    'Nama'=>$nama,
                    'Nama1'=>$myvar,
                    'Perusahaan'=>$perusahaan,
                    'Alamat1'=>$al,
                    'Alamat2'=>$myvar2,
                    'Kota'=>$kt,
                    'Telp'=>$tl1,
                    'Telp1'=>$tl2,
                    'Telp2'=>$tl3,  
                    'Fax1'=>$fx1,
                    'fax2'=>$fx2,
                    'Limit_Kredit'=>$lk,
            );
            $q = $this->ms_supplier_model->update($data,$id);
            echo $q;
        }
        //save delete
        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_supplier_model->delete($id);
            echo $r;
        }
        
        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getsup();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
                $skr=substr($temp,1,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = "S".$tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = "S".$tb."0".$ang;}
                        else{
                            $no = "S".$tb."00".$ang;
                        }
                    }else {
                        $no = "S".$tb."001";
                    }
            echo $no;
        }
    }