<?php
    class Saw extends CI_Controller{

        function __construct(){
            parent::__construct();
			
            #load library dan helper yang dibutuhkan
            $this->load->model('saw_model');
            $this->load->library(array('account/authorization'));
        }

        //List
        function index(){
            $data['hasil']=$this->saw_model->get_list();
            $this->load->view('content/saw/list_saw',$data);
        }

        function auto_gen()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getSaw();
                foreach ($ag as $rr)
                {
                    $temp=$rr->No_Saw;
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

        function detail(){
            $id=$this->input->post('id');

            $data['hasil']=$this->saw_model->get_detail($id);
            $data['kode']=$id;
            $this->load->view("content/saw/saw_d",$data);
        }
		
		function addBarang(){
            $data['hasil']=$this->saw_model->get_barang();
            $this->load->view("content/saw/saw_detail",$data);
        }

        function qtyBarang(){
            $id=$this->input->post('id');
            $data['hasil']=$this->saw_model->get_qtybarang($id);
            $data['kode']=$id;
            $this->load->view("content/saw/saw_detail",$data);
        }

        function noqtyBarang(){
            $id=$this->input->post('id');
            $data['hasil']=$this->saw_model->get_noqtybarang($id);
            $data['kode']=$id;
            $this->load->view("content/saw/saw_detail",$data);
        }
        function all(){
            $id=$this->input->post('id');
            $data['hasil']=$this->saw_model->get_allbarang($id);
            $data['kode']=$id;
            $this->load->view("content/saw/saw_detail",$data);
        }
		
        function insert($modes)
        {
            $a=$this->input->post('noSaw');
            $b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');

            $myvar  = empty($myvar) ? NULL : $myvar;
            
            if($modes == "add"){
                $data= array(
                    'No_Saw'=>$a,
                    'Tgl'=>$b,
                    'Kd_Gudang'=>$c,
                );
                $in = $this->saw_model->insert($data,$a);

                //DETAIL 
                $arrKode=$this->input->post('_arrKd_brg');
                $arrQty=$this->input->post('_arrQty');
                $arrKet=$this->input->post('_arrKet');
                $arrData=$this->input->post('arrData');
                for($i=0;$i<$arrData;$i++){
                    $datadet= array(
                        'No_Saw'=>$a,
                        'Kd_Brg'=>$arrKode[$i],
                        'QtySaw1'=>$arrQty[$i]
                    );
                    $this->saw_model->insert_det($datadet);
                }
				for($i=0;$i<$arrData;$i++){
                    $this->saw_model->update_brg($arrKode[$i],$arrQty[$i]);
                }
				
            }else if ($modes == "edit"){
                $data= array(
                    'Tgl'=>$b,
                    'Kd_Gudang'=>$c,
                );
                
                $in = $this->saw_model->update($data,$a);

                //DETAIL 
                $arrKode=$this->input->post('_arrKd_brg');
                $arrQty=$this->input->post('_arrQty');
                $arrKet=$this->input->post('_arrKet');
                $arrData=$this->input->post('arrData');
                $datadet= array(
                    'No_Saw'=>$a,
                    'Kd_Brg'=>$arrKode,
                    'QtySaw1'=>$arrQty
                );
                $this->saw_model->update_det($datadet,$a);

                for($i=0;$i<$arrData;$i++){
                    $this->saw_model->update_brg($arrKode[$i],$arrQty[$i]);
                }
            }
            else if ($modes == "edit2"){
                $data= array(
                    'Tgl'=>$b,
                    'Kd_Gudang'=>$c,
                );
                
                $in = $this->saw_model->update($data,$a);

                //DETAIL 
                $arrKode=$this->input->post('_arrKd_brg');
                $arrQty=$this->input->post('_arrQty');
                $arrKet=$this->input->post('_arrKet');
                $arrData=$this->input->post('arrData');
                for($i=0;$i<$arrData;$i++){
                    $datadet= array(
                        'No_Saw'=>$a,
                        'Kd_Brg'=>$arrKode[$i],
                        'QtySaw1'=>$arrQty[$i]
                    );
                    $this->saw_model->insert_det($datadet);
                }
                for($i=0;$i<$arrData;$i++){
                    $this->saw_model->update_brg($arrKode[$i],$arrQty[$i]);
                }
            }


            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }

        function delete()
        {
            $kode=$this->input->post('noSaw');
            $r = $this->saw_model->delete($kode);
            echo $r;
            $this->saw_model->delete_det($kode);
        }
        
        //save update
        
        function update()
        {
            $a=$this->input->post('noSaw');
            $b=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $c=$this->input->post('_gd');
            $d=$this->input->post('_sp');
            $e=$this->input->post('_ref');

            $myvar  = empty($myvar) ? NULL : $myvar;
            $data= array(
                    'Tgl'=>$b,
                    'No_Reff'=>$e,
                    'Kode_Supp'=>$d,
                    'Kd_Gudang'=>$c,
                );
                
            $in = $this->tr_penerimaan_barang_model->update($data,$a);
            
            //DETAIL SO
            $arrKode=$this->input->post('_arrKd_brg');
            $arrQty=$this->input->post('_arrQty');
            $arrKet=$this->input->post('_arrKet');
            $arrData=$this->input->post('arrData');
            for($i=0;$i<$arrData;$i++){
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
    }