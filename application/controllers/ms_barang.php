<?php
    class Ms_barang extends CI_Controller{

        private $limit=10;

        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('ms_barang_model');
        }

        //Get Data untuk table Detail
        function index($offset=0,$order_column='Kode',$order_type='asc'){
            //request data table
            $data['hasil']=$this->ms_barang_model->get_paged_list(
                $this->limit,$offset,$order_column,$order_type)->result();

            //load view
            $this->load->view('content/master_barang/ms_barang_Detail',$data);
        }
        
        #POPUP Show Product
        function viewBarang(){
            //$this->load->model("tr_surat_jalan_model");
            $nama = $this->input->post('k');
            $data['hasil'] = $this->ms_barang_model->get_barang();
            $data['nama']=$nama;
            $this->load->view("content/list/list_Barang",$data);
        }
        
        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd, nama1:nama1, nama2:nama2, uk:uk, ps:ps, st:st
            $id=$this->input->post('_kd');
            $nama1=$this->input->post('_nama1');
            $nama2=$this->input->post('_nama2');
            $uk=$this->input->post('_uk');
            $ps=$this->input->post('_ps');
            $st=$this->input->post('_st');
            $myvar  = empty($myvar) ? NULL : $myvar;
            $myvar2  = empty($myvar2) ? NULL : $myvar2;
            $myvar3  = empty($myvar3) ? NULL : $myvar3;
            $myvar4  = empty($myvar4) ? NULL : $myvar4;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'Kode'=>$id,
                    'Ukuran'=>$uk,
                    'Nama'=>$nama1,
                    'Nama2'=>$nama2,
                    'Satuan1'=>$st,
                    'Qty1'=>$ps,
                    'QtyGudang'=>$myvar,
                    'Tgl_Saw'=>$myvar2,
                    'Saw'=>$myvar3,
                    'SawGudang'=>$myvar4,
            );

            $in = $this->ms_barang_model->insert($data,$id);
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
		
        function update()
        {
            $id=$this->input->post('_kd');
            $nama1=$this->input->post('_nama1');
            $nama2=$this->input->post('_nama2');
            $uk=$this->input->post('_uk');
            $ps=$this->input->post('_ps');
            $st=$this->input->post('_st');
            $myvar  = empty($myvar) ? NULL : $myvar;
            $myvar2  = empty($myvar2) ? NULL : $myvar2;
            $myvar3  = empty($myvar3) ? NULL : $myvar3;
            $myvar4  = empty($myvar4) ? NULL : $myvar4;

            $data= array(
                    'Ukuran'=>$uk,
                    'Nama'=>$nama1,
                    'Nama2'=>$nama2,
                    'Satuan1'=>$st,
                    'Qty1'=>$ps,
                    'QtyGudang'=>$myvar,
                    'Tgl_Saw'=>$myvar2,
                    'Saw'=>$myvar3,
                    'SawGudang'=>$myvar4,
            );
            $q = $this->ms_barang_model->update($data,$id);
            echo $q;
        }

        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_barang_model->delete($id);
            echo $r;
        }

        #Untuk auto generate
        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getbrg();
                foreach ($ag as $rr)
                {
                    $temp=$rr->Kode;
                }
				$skr=substr($temp,1,4);
					if($skr==$tb){
						$ang=intval(substr($temp,-3))+1;
						if(strlen($ang) == 3){
							$no = "B".$tb.$ang;
						}
						else if(strlen($ang) == 2){
							$no = "B".$tb."0".$ang;}
						else{
							$no = "B".$tb."00".$ang;
						}
					}else {
						$no = "B".$tb."001";
					}
            echo $no;
        }
		
		
		function add_satuan(){
			$id=$this->input->post('_sat');
			
			 $data= array(
				'Value'=>$id
			 );
			 $in = $this->ms_barang_model->add_sat($data,$id);
			 if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
		}
    }