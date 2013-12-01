<?php
    class Ms_barang extends CI_Controller{

        private $limit=10;

        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->model('ms_barang_model');
            $this->load->library(array('account/authentication', 'account/authorization'));
        }

        //Get Data untuk table Detail
        function index(){
            $data['hasil']=$this->ms_barang_model->get_paged_list();
            $this->load->view('content/master_barang/ms_barang_Detail',$data);
        }
        
        #POPUP Show Product
        function viewBarang(){
            //$nama = $this->input->post('k');
            $data['hasil'] = $this->ms_barang_model->get_paged_listPop();
            //$data['nama']=$nama;
            $this->load->view("content/list/list_barang",$data);
        }

        function retrieveForm(){
            $id=$this->input->post('id');
            $query = $this->ms_barang_model->get_selected($id);
            foreach($query as $row)
            {
                $originalDate = $row->Tgl_Saw;
                $date = date("d-m-Y", strtotime($originalDate));
                $dateFormat = '';
                if ($originalDate != null){
                    $dateFormat = $date;
                }else{
                    $dateFormat = '';   
                }

                $final['Tgl'] = $dateFormat;
                $final['Ukuran'] = $row->Ukuran;
                $final['Nama'] = $row->Nama;
                $final['Keterangan'] = $row->Nama2;
                $final['Persediaan'] = $row->Qty1;
                $final['Satuan'] = $row->Satuan1;
                $final['Beli'] = number_format($row->Harga_Beli,0,",",".");
                $final['Jual'] = number_format($row->Harga_Jual,0,",",".");         
            }
            echo json_encode($final);
        }

        #POPUP Show Product
        function viewBarang2(){
            //$nama = $this->input->post('k');
            $data['hasil'] = $this->ms_barang_model->get_paged_listPop();
            //$data['nama']=$nama;
            $this->load->view("content/list/list_barang_full",$data);
        }

        function getSelectedRadio(){
            $id=$this->input->post('id');
            $query = $this->ms_barang_model->get_selected($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $final['Nama'] = $row->Nama;
                $final['Ukuran'] = $row->Ukuran;
                $final['Satuan'] = $row->Satuan1;  
                $final['Harga'] = $row->Harga_Jual;    
                $final['Qty_Jual'] = $row->Qty1;       
            }
            echo json_encode($final);
        }

		
		//Saldo Awal
		function viewSaldoAwal(){
            
            $data['hasil'] = $this->ms_barang_model->get_saw();
            //$data['nama']=$nama;
            $this->load->view("content/saldo_awal",$data);
        }
        function checkBarang(){
            //$nama = $this->input->post('k');
            $totalRow=$this->input->post('totalRow');
            $id=$this->input->post('arrKode');
            for($i=0;$i<$totalRow;$i++){
                $datadet= array(
                    'Kode'   =>$id[$i],
                );
                $data['hasil'] = $this->ms_barang_model->check($datadet);
                $this->load->view("content/list/list_barang",$data);
            }
            
            //$data['nama']=$nama;
            
        }
        
        //SAVE ADD NEW TRIGGER
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd, nama1:nama1, nama2:nama2, uk:uk, ps:ps, st:st
            $id=$this->input->post('_kd');
            $nama1=$this->input->post('_nama1');
            $nama2=$this->input->post('_ket');
            $uk=$this->input->post('_uk');
            $ps=$this->input->post('_ps');
            $st=$this->input->post('_st');
            $hb=$this->input->post('_hb');
            $hj=$this->input->post('_hj');
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
                    'Harga_Beli'=>$hb,
                    'Harga_Jual'=>$hj
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
            $nama2=$this->input->post('_ket');
            $uk=$this->input->post('_uk');
            $ps=$this->input->post('_ps');
            $st=$this->input->post('_st');
            $hb=$this->input->post('_hb');
            $hj=$this->input->post('_hj');
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
                    'Harga_Beli'=>$hb,
                    'Harga_Jual'=>$hj
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

    //POP
    function popBarang(){
        $this->load->view('content/pop/barang');
    }