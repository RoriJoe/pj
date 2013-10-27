<?php
    class Tr_surat_jalan extends CI_Controller{

        private $limit=10;

        function __construct(){
            parent::__construct();

            #load library dan helper yang dibutuhkan
            $this->load->library(array('table','form_validation'));
            $this->load->helper(array('form','url'));
            $this->load->model('tr_surat_jalan_model');
        }

        #Fungsi untuk table samping
        function index(){
            //Get data dari model
            $data['hasil']=$this->tr_surat_jalan_model->get_paged_list();
            //load view
            $this->load->view('content/tr_surat_jalan/tr_surat_jalan_Detail',$data);
        }

        #Fungsi saat table samping di klik /*NOT USE ANYMORE!!!!!*/
        function passSJ()
        {
            $sj=$this->input->post('sj');
            $qq=$this->tr_surat_jalan_model->get_h_sj($sj);
            foreach ($qq as $rr)
            {
			$originalDate = $rr->Tgl;
			$dmy = date("d-m-Y", strtotime($originalDate));
                $temp=$rr->No_Sj."|".$rr->Perusahaan."|".$rr->No_Do."|".$rr->No_Po."|".$rr->Kode_Gudang."|".$rr->No_Mobil."|".$dmy."|".$rr->Keterangan."|".$rr->Kode_Plg;
            }
            echo $temp;
        }

        function getSJ(){
            $id=$this->input->post('id');
            $query = $this->tr_surat_jalan_model->get_h_sj($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $originalDate = $row->Tgl;
                $dmy = date("d-m-Y", strtotime($originalDate));

                $final['Perusahaan'] = $row->Perusahaan;
                $final['Kirim'] = $row->Kirim;
                $final['Do'] = $row->No_Do;
                $final['Po'] = $row->No_Po;
                $final['Gudang'] = $row->Kode_Gudang;
                $final['Mobil'] = $row->No_Mobil;
                $final['Tgl'] = $dmy;
                $final['Keterangan'] = $row->Keterangan;
                $final['Kode_Plg'] = $row->Kode_Plg;

            }
            echo json_encode($final);
        }

        #Fungsi Insert Data baru
        function insertheader()
        {
            $sj=$this->input->post('sj');
            $_tgl=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $_do=$this->input->post('_do');
            $gg=$this->input->post('gg');
            $pn=$this->input->post('pn');
            $po=$this->input->post('po');
            $mbl=$this->input->post('mbl');
            $ket=$this->input->post('ket');
            $myvar  = empty($myvar) ? NULL : $myvar;
            $data= array(
                    'No_Sj'=>$sj,
                    'Tgl'=>$_tgl,
                    'No_Do'=>$_do,
                    'No_Po'=>$po,
                    'No_Mobil'=>$mbl,
                    'Kode_Plg'=>$pn,
                    'Kode_Gudang'=>$gg,
                    'Kirim'=>$myvar,
                    'Keterangan'=>$ket
                );
            $in = $this->tr_surat_jalan_model->insertSj($data,$sj);

            //detail SJ
            $kd_brg=$this->input->post('kd_brg');
            $nama=$this->input->post('nama');
            $nbu=$this->input->post('nbu');
            $qty=$this->input->post('qty');
            $ktr=$this->input->post('ktr');
            $totaltx=$this->input->post('totaltx');
            for($i=0;$i<$totaltx;$i++){
                $datadet= array(
                    'No_Sj'=>$sj,
                    'Kode_Brg'=>$kd_brg[$i],
                    'Barang'=>$nama[$i],
                    'Barang_SJ'=>$nbu[$i],
                    'Qty1'=>$qty[$i],
                    'Keterangan'=>$ktr[$i]
                );
                $this->tr_surat_jalan_model->insertSj_det($datadet,$sj);
            }
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }

        function update2()
        {
            $_tgl=date('Y-m-d', strtotime($this->input->post('_tgl')));
            $_do=$this->input->post('_do');
            $gg=$this->input->post('gg');
            $pn=$this->input->post('pn');
            $po=$this->input->post('po');
            //$ot=$this->input->post('ot');
            $mbl=$this->input->post('mbl');
            $ket=$this->input->post('ket');
            $myvar = empty($myvar) ? NULL : $myvar;

            $sj=$this->input->post('sj');

            $data= array(
                    'Tgl'=>$_tgl,
                    'No_Do'=>$_do,
                    'No_Po'=>$po,
                    'No_Mobil'=>$mbl,
                    'Kode_Plg'=>$pn,
                    'Kode_Gudang'=>$gg,
                    'Keterangan'=>$ket
            );
            $q = $this->tr_surat_jalan_model->updateSj($data,$sj);
            echo $q;

			//detail SJ
            $kd_brg=$this->input->post('kd_brg');
            $nama=$this->input->post('nama');
            $nbu=$this->input->post('nbu');
            $qty=$this->input->post('qty');
            $ktr=$this->input->post('ktr');
            $totaltx=$this->input->post('totaltx');

            $datadet= array(
                'Kode_Brg'=>$kd_brg,
                'Barang'=>$nama,
                'Barang_SJ'=>$nbu,
                'Qty1'=>$qty,
                'Keterangan'=>$ktr
            );
			$this->tr_surat_jalan_model->updateSj_det($datadet,$sj);
        }

        #Delete
        function delete()
        {
            $sj=$this->input->post('sj');
            $r = $this->tr_surat_jalan_model->delete($sj);
            echo $r;
            $this->tr_surat_jalan_model->delete_det($sj);
        }

        #viewSO utk tabel detail SO
        function viewDo(){
            $so=$this->input->post('so');
            $data['hasil']=$this->tr_surat_jalan_model->get_detail_do($so);
            $data['kode']=$so;
            $this->load->view("content/tr_surat_jalan/detail_surat_jalan",$data);

        }
        #viewSO utk tabel detail SJ
        function viewSJ(){
            $sj=$this->input->post('sj');
            $data['hasil']=$this->tr_surat_jalan_model->get_detail_sj($sj)->result();
            $this->load->view("content/tr_surat_jalan/detail_surat_jalan",$data);
        }

        #Untuk auto generate
        function ang()
        {
            $tb=date('ym');
            $ang="";
            $temp = "";
            $this->load->model("combo_model");
            $ag=$this->combo_model->getang();
                foreach ($ag as $rr)
                {
                    $temp=$rr->No_Sj;
                }
                $skr=substr($temp,0,4);
                if($skr==$tb){
                    $ang=intval(substr($temp,-3))+1;
                    if(strlen($ang) == 3){
                    $no = $tb.$ang;}else if(strlen($ang) == 2){
                    $no = $tb."0".$ang;}else{
                    $no = $tb."00".$ang;
                    }
                }else {
                    $no = $tb."001";
                }

            echo $no;
        }

        #Fungsi ketika SO dipilih
        function ambil_do(){
            $temp="";
            $_do=$this->input->post('_do');
            $this->load->model("tr_surat_jalan_model");
            $tm = $this->tr_surat_jalan_model->get_do($_do);

            foreach ($tm as $rr)
            {
                $temp=$rr->Perusahaan."|".$rr->Otorisasi."|".$rr->Kode_Gudang."|".$rr->No_Po."|".$rr->Kode_Plg;
            }
            echo $temp;
        }

        #Show All 
        function view_po_pelanggan(){

            $data['hasil']=$this->tr_surat_jalan_model->get_list();
            //load view
            $this->load->view('content/list/list_pelanggan',$data);
        }

        function so_call(){
            $id = $this->input->post('id');
            $query = $this->tr_surat_jalan_model->get_so_list($id);

            $final['']='-- Select SO --';
            foreach ($query as $a) 
            {
                $final[$a->No_Do] = $a->No_Do;
            }

            echo form_dropdown('_do',$final,'1','id="_do" onchange="displayResult(this)"');
        }

        function mobil_call(){
            $query = $this->tr_surat_jalan_model->get_mobil_list();

            $final['']='-- Select Mobil --';
            foreach ($query as $a) 
            {
                $final[$a->No_mobil] = $a->No_mobil;
            }

            echo form_dropdown('_mbl',$final,'1','id="_mbl"');
        }

		function cek_kirim(){
            $id=$this->input->post('id');
            $query = $this->tr_surat_jalan_model->get_kirim($id);
            $data['message']=array();
            foreach($query as $row)
            {
                $final['Kirim'] = $row->Kirim;
            }
            echo json_encode($final);
        }
    }