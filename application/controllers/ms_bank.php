<?php
    class Ms_bank extends CI_Controller{

        function __construct(){
            parent::__construct();

            $this->load->model('ms_bank_model');
        }

        //Get Data untuk table Detail
        function index(){
            $data['hasil']=$this->ms_bank_model->get_paged_list();
            $this->load->view('content/master_bank/list_bank',$data);
        }

        function detail(){
            $id=$this->input->post('id');

            $data['hasil']=$this->ms_bank_model->get_detail($id);
            $data['kode']=$id;
            $this->load->view("content/master_bank/detail_bank",$data);
        }

        function insert($modes)
        {
            $kd=$this->input->post('_kd');
            $al=$this->input->post('_al');
            $nm=$this->input->post('_nm');
            $date = date('Y-m-d H:i:s');
            $totalRow = $this->input->post('totalRow');

            $myvar  = empty($myvar) ? NULL : $myvar;

            if($modes == "add"){
                $data= array(
                    'kode_bank'=>$kd,
                    'nama_bank'=>$nm,
                    'alamat'=>$al,
                    'dibuat_oleh'=>'eddy',
                    'tanggal_buat'=>$date,
                    'diupdate_oleh'=>'eddy',
                    'tanggal_update'=>$date,
                );
                $in = $this->ms_bank_model->insert($data,$kd);

                //DETAIL 
                $_no_rekening=$this->input->post('_no_rekening');
                $_atas_nama=$this->input->post('_atas_nama');
                $_tipe=$this->input->post('_tipe');
                $_cabang=$this->input->post('_cabang');
                $_no_perkiraan=$this->input->post('_no_perkiraan');

                for($i=0;$i<$totalRow;$i++){
                    $datadet= array(
                        'kode_bank'=>$kd,
                        'no_rekening'=>$_no_rekening[$i],
                        'atas_nama'=>$_atas_nama[$i],
                        'tipe'=>$_tipe[$i],
                        'cabang'=>$_cabang[$i],
                        'no_perkiraan'=>$_no_perkiraan[$i],
                    );
                    $this->ms_bank_model->insert_det($datadet);
                }
            }
            else if ($modes == "edit")
            {
                $data= array(
                    'nama_bank'=>$nm,
                    'alamat'=>$al,
                    'diupdate_oleh'=>'eddy',
                    'tanggal_update'=>$date,
                );
                
                $in = $this->ms_bank_model->update($data,$kd);
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
            $kode=$this->input->post('id');
            $r = $this->ms_bank_model->delete($kode);
            echo $r;
            $this->ms_bank_model->delete_det($kode);
        }

        function add_tipe(){
            $id=$this->input->post('_val');
            
            $data= array(
            'Value'=>$id
            );
            $in = $this->ms_bank_model->add_tipe($data,$id);
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }
    }