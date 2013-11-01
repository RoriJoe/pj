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

        function retrieveForm(){
            $id=$this->input->post('id');
            $query = $this->tr_po_model->get_h_po($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $originalDate1 = $row->Tgl_po;
				$dmy1 = date("d-m-Y", strtotime($originalDate1));
				$originalDate2 = $row->Tgl_kirim;
				$dmy2 = date("d-m-Y", strtotime($originalDate2));

                $tgl2 = '';
                if ($originalDate2 != null){
                    $tgl2 = $dmy2;
                }else{
                    $tgl2 = '';   
                }

                $final['Tgl_Kirim'] = $dmy2;
                $final['Tgl_Po'] = $dmy1;
                $final['Permintaan'] = $row->Permintaan;
                $final['Currency'] = $row->Currency;
                $final['Urgent'] = $row->Urgent;
                $final['Nama_Gudang'] = $row->Nama;
                $final['Kode_Gudang'] = $row->Kode_gudang;
                $final['Nama_Supplier'] = $row->Perusahaan;
                $final['Kode_Supplier'] = $row->Kode_supplier;
                $final['Counter'] = $row->Counter;
                $final['Total'] = $row->Total;
                $final['Dpp'] = $row->DPP;
                $final['Ppn'] = $row->PPN;        
            }
            echo json_encode($final);
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

        //SAVE ADD NEW TRIGGER
        function save($modes)
        {

            $po         = $this->input->post('po');
            $_tgl1      = date('Y-m-d', strtotime($this->input->post('_tgl1')));
            $_tgl2      = date('Y-m-d', strtotime($this->input->post('_tgl2')));
            $tgl2 = '';
            if ($_tgl2 != null){
                $tgl2 = $_tgl2;
            }else{
                $tgl2 = '';
            }
            $cur        = $this->input->post('cur');
            $kd_gud     = $this->input->post('kd_gud');
            $proy       = $this->input->post('proy');
            $permintaan = $this->input->post('permintaan');
            $urg        = $this->input->post('urg');
            $kd_sup     = $this->input->post('kd_sup');
            $dpp        = $this->input->post('dpp');
            $ppn        = $this->input->post('ppn');
            $to         = $this->input->post('to');

            //ADD TO ARRAY FOR SEND TO MODEL
            $data1= array(
                'Kode'          =>$po,
                'Tgl_po'        =>$_tgl1,
                'Tgl_kirim'     =>$tgl2,
                'Permintaan'    =>$permintaan,
                'Currency'      =>$cur,
                'Urgent'        =>$urg,
                'Kode_supplier' =>$kd_sup,
                'Kode_gudang'   =>$kd_gud,
                'Nama_proyek'   =>$proy,
                'DPP'           =>$dpp,
                'PPN'           =>$ppn,
                'Total'         =>$to
            );

            $data2= array(
                'Tgl_po'        =>$_tgl1,
                'Tgl_kirim'     =>$tgl2,
                'Permintaan'    =>$permintaan,
                'Currency'      =>$cur,
                'Urgent'        =>$urg,
                'Kode_supplier' =>$kd_sup,
                'Kode_gudang'   =>$kd_gud,
                'Nama_proyek'   =>$proy,
                'DPP'           =>$dpp,
                'PPN'           =>$ppn,
                'Total'         =>$to
            );

            if($modes=="add"){
                $in = $this->tr_po_model->insertPo($data1,$po);

                //DETAIL po
                $arrKode    =$this->input->post('arrKode');
                $arrHarga   =$this->input->post('arrHarga');
                $arrJumlah  =$this->input->post('arrJumlah');
                $arrNilai   =$this->input->post('arrNilai');
                $totalRow   =$this->input->post('totalRow');

                for($i=0;$i<$totalRow;$i++){
                    $datadet= array(
                        'Kode_po'       =>$po,
                        'Kode_barang'   =>$arrKode[$i],
                        'Harga'         =>$arrHarga[$i],
                        'Jumlah'        =>$arrJumlah[$i],
                        'Nilai'         =>$arrNilai[$i]
                    );
                    $this->tr_po_model->insertPo_det($datadet,$po);
                }
                //update stok jual
				for($i=0;$i<$totalRow;$i++){
                    $this->tr_po_model->update_brg($arrKode[$i],$arrJumlah[$i]);
                }

                if($in == "ok")
                {
                    echo "ok";
                }
                else{
                    echo "gagal";
                }
            }else if($modes=="edit"){
            	//DETAIL po
                $arrKode    =$this->input->post('arrKode');
                $arrHarga   =$this->input->post('arrHarga');
                $arrJumlah  =$this->input->post('arrJumlah');
                $arrNilai   =$this->input->post('arrNilai');
                $totalRow   =$this->input->post('totalRow');

                $datadet= array(
                    'Kode_barang'   =>$arrKode,
                    'Harga'         =>$arrHarga,
                    'Jumlah'        =>$arrJumlah,
                    'Nilai'         =>$arrNilai
                );
                
                $in = $this->tr_po_model->updatePo($data2,$po);
                $this->tr_po_model->updatePo_det($datadet,$po);
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
            $po=$this->input->post('po');
            $r = $this->tr_po_model->delete($po);
            echo $r;
            $this->tr_po_model->delete_det($po);
        }

        function cek_kirim(){
            $id=$this->input->post('id');
            $query = $this->tr_po_model->get_kirim($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $final['Kirim'] = $row->Counter;
            }
            echo json_encode($final);
        }        
    }

/*
 * End Of File
 * File Location: controller/tr_po
 */