<?php
    class Ms_pelanggan extends CI_Controller{
                
        function __construct(){
            parent::__construct();
            
            #load library dan helper yang dibutuhkan
            $this->load->model('ms_pelanggan_model');
        }

        //Get Data untuk table Detail 
        function index(){
            //request data table
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
                
            //load view
            $this->load->view('content/master_pelanggan/ms_pelanggan_Detail',$data);
        }
        
        #Show All 
        function viewPelanggan(){
            //request data table
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
                
=======
            //$data['hasil']=$this->ms_pelanggan_model->get_paged_list( 1
            //$this->limit,$offset,$order_column,$order_type)->result(); 2
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
>>>>>>> bc5f7597b2598924438ce99f0a458ab271d8700a
=======
            //$data['hasil']=$this->ms_pelanggan_model->get_paged_list( 1
            //$this->limit,$offset,$order_column,$order_type)->result(); 2
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
>>>>>>> bc5f7597b2598924438ce99f0a458ab271d8700a
=======
            //$data['hasil']=$this->ms_pelanggan_model->get_paged_list( 1
            //$this->limit,$offset,$order_column,$order_type)->result(); 2
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
>>>>>>> bc5f7597b2598924438ce99f0a458ab271d8700a
=======
            //$data['hasil']=$this->ms_pelanggan_model->get_paged_list( 1
            //$this->limit,$offset,$order_column,$order_type)->result(); 2
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
>>>>>>> bc5f7597b2598924438ce99f0a458ab271d8700a
=======
            //$data['hasil']=$this->ms_pelanggan_model->get_paged_list( 1
            //$this->limit,$offset,$order_column,$order_type)->result(); 2
            $data['hasil']=$this->ms_pelanggan_model->get_paged_list();
>>>>>>> bc5f7597b2598924438ce99f0a458ab271d8700a
            //load view
            $this->load->view('content/list/list_pelanggan',$data);
        }
        

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd,pr:pr,cp:cp,al:al,kt:kt,kp:kp,tl1:tl1,tl2:tl2,tl3:tl3,fx1:fx1,fx2:fx2,np:np
            $id=$this->input->post('kd');            
            $pr=$this->input->post('pr');            
            $cp=$this->input->post('cp');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $kp=$this->input->post('kp');
            $tl1=$this->input->post('tl1');            
            $tl2=$this->input->post('tl2');            
            $tl3=$this->input->post('tl3');
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $np=$this->input->post('np');
            $myvar  = empty($myvar) ? NULL : $myvar;
            
            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'Kode'=>$id,
                    'Nama'=>$cp,
                    'Nama1'=>$myvar,
                    'Perusahaan'=>$pr,
                    'Alamat1'=>$al,
                    'Alamat2'=>$myvar,
                    'Kota'=>$kt,
                    'KodeP'=>$kp,
                    'Telp'=>$tl1,  
                    'Telp1'=>$tl2,
                    'Telp2'=>$tl3,
                    'Fax1'=>$fx1,
                    'Fax2'=>$fx2,  
                    'Limit'=>$myvar,
                    'Piutang'=>$myvar,
                    'NPWP'=>$np,
                    'Lama'=>$myvar
            );
            
            $in = $this->ms_pelanggan_model->insert($data,$id);
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
        /*
        function viewupdate()
        {
            $id=$this->input->post('id');
            $data['hasil']=$this->ms_pelanggan_model->getUpdate($id);
            $this->load->view("content/update_pelanggan",$data);
        }
        */
        function update()
        {
            $id=$this->input->post('kd');            
            $pr=$this->input->post('pr');            
            $cp=$this->input->post('cp');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $kp=$this->input->post('kp');
            $tl1=$this->input->post('tl1');            
            $tl2=$this->input->post('tl2');            
            $tl3=$this->input->post('tl3');
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $np=$this->input->post('np');
            $myvar  = empty($myvar) ? NULL : $myvar;
            
            $data= array(
                    'Nama'=>$cp,
                    'Nama1'=>$myvar,
                    'Perusahaan'=>$pr,
                    'Alamat1'=>$al,
                    'Alamat2'=>$myvar,
                    'Kota'=>$kt,
                    'KodeP'=>$kp, 
                    'Telp'=>$tl1, 
                    'Telp1'=>$tl2,
                    'Telp2'=>$tl3,
                    'Fax1'=>$fx1,
                    'Fax2'=>$fx2,  
                    'Limit'=>$myvar,
                    'Piutang'=>$myvar,
                    'NPWP'=>$np,
                    'Lama'=>$myvar
            );
            $q = $this->ms_pelanggan_model->update($data,$id);
            echo $q;
        }
        
        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_pelanggan_model->delete($id);
            echo $r;
        }
        
        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getpel();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
                $skr=substr($temp,1,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = "P".$tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = "P".$tb."0".$ang;}
                        else{
                            $no = "P".$tb."00".$ang;
                        }
                    }else {
                        $no = "P".$tb."001";
                    }
            echo $no;
        }
    }