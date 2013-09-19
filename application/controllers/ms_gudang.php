<?php
    class Ms_gudang extends CI_Controller{
        
        private $limit=10;
        
        function __construct(){
            parent::__construct();
            
            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('ms_gudang_model');
        }

        //Get Data untuk table Detail 
        function index($offset=0,$order_column='Kode',$order_type='asc'){
            //request data table
            $data['hasil']=$this->ms_gudang_model->get_paged_list(
                $this->limit,$offset,$order_column,$order_type)->result();
                
            //load view
            $this->load->view('content/ms_gudang_Detail',$data);
        }
		
		#Show All 
        function viewGudang($offset=0,$order_column='Kode',$order_type='asc'){
            //request data table
            $data['hasil']=$this->ms_gudang_model->get_paged_list(
                $this->limit,$offset,$order_column,$order_type)->result();
                
            //load view
            $this->load->view('content/list_gudang',$data);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            $id=$this->input->post('kd');                       
            $nm=$this->input->post('nm');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $tl1=$this->input->post('tl1');            
            $tl2=$this->input->post('tl2');            
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $myvar  = empty($myvar) ? NULL : $myvar;
            
            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'Kode'=>$id,
                    'Nama'=>$nm,
                    'Alamat'=>$al,
                    'Alamat2'=>$myvar,
                    'Kota'=>$kt,
                    'Telp'=>$tl1,
                    'Milik_Sendiri'=>$myvar,
                    'Telp1'=>$tl2,
                    'Fax'=>$fx1,
                    'Fax1'=>$fx2,
                    'Contac1'=>$myvar,
                    'Contac2'=>$myvar,  
                    'Title1'=>$myvar,
                    'Title2'=>$myvar
            );
            
            $in = $this->ms_gudang_model->insert($data,$id);
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
            $data['hasil']=$this->ms_gudang_model->getUpdate($id);
            $this->load->view("content/update_gudang",$data);
        }
        //save update
        function update()
        {
            $id=$this->input->post('kd');                       
            $nm=$this->input->post('nm');
            $al=$this->input->post('al');
            $kt=$this->input->post('kt');
            $tl1=$this->input->post('tl1');            
            $tl2=$this->input->post('tl2');            
            $fx1=$this->input->post('fx1');
            $fx2=$this->input->post('fx2');
            $myvar  = empty($myvar) ? NULL : $myvar;
            
            $data= array(
                    'Nama'=>$nm,
                    'Alamat'=>$al,
                    'Alamat2'=>$myvar,
                    'Kota'=>$kt,
                    'Telp'=>$tl1,
                    'Milik_Sendiri'=>$myvar,
                    'Telp1'=>$tl2,
                    'Fax'=>$fx1,
                    'Fax1'=>$fx2,
                    'Contac1'=>$myvar,
                    'Contac2'=>$myvar,  
                    'Title1'=>$myvar,
                    'Title2'=>$myvar
            );
            $q = $this->ms_gudang_model->update($data,$id);
            echo $q;
        }
        //save delete
        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_gudang_model->delete($id);
            echo $r;
        }
        
        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getgd();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
                $skr=substr($temp,1,4);
                    if($skr==$tb){
                        $ang=intval(substr($temp,-3))+1;
                        if(strlen($ang) == 3){
                            $no = "G".$tb.$ang;
                        }
                        else if(strlen($ang) == 2){
                            $no = "G".$tb."0".$ang;}
                        else{
                            $no = "G".$tb."00".$ang;
                        }
                    }else {
                        $no = "G".$tb."001";
                    }
            echo $no;
        }
    }