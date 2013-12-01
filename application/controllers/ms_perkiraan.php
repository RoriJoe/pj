<?php
    class Ms_perkiraan extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ms_perkiraan_model');
            $this->load->library(array('account/authentication', 'account/authorization'));
        }
        function index(){
            $data['hasil']=$this->ms_perkiraan_model->get_paged_list();
            $this->load->view('content/master_perkiraan/list_perkiraan',$data);
        }

        function CekNoAcc(){
            $Str = $_POST['Val'];
            $a = substr($Str,0,strripos($Str,"."));
            $CekAwl = $this->ms_perkiraan_model->CekAcc($Str);
            if($CekAwl==0){
                if($a=="")
                    echo 0;
                else{
                    $b = $this->ms_perkiraan_model->CekAcc($a);
                    if($b==1){
                        echo 0;
                    }else
                    echo 2;
                    }
            }else
                echo 1;
        }

        function retrieveForm(){
            $id=$this->input->post('id');
            $query = $this->ms_perkiraan_model->get_selected($id);
            foreach($query as $row)
            {
                $originalDate = $row->tanggalsaldoawal;
                $originalDate2 = $row->tanggalentry;
                $date = date("d-m-Y", strtotime($originalDate));
                $date2 = date("d-m-Y", strtotime($originalDate2));
                $dateFormat = '';
                if ($originalDate != null){
                    $dateFormat = $date;
                }else{
                    $dateFormat = '';   
                }

                $final['nama'] = $row->namaaccount;
                $final['level'] = $row->level;
                $final['typeRadio'] = $row->type;
                $final['tgl_entry'] = $date2;
                $final['tgl_saldo'] = $dateFormat;
                $final['saldo'] = number_format($row->saldo,0,",",".");     
            }
            echo json_encode($final);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            $id=$this->input->post('_kd');
            $nama1=$this->input->post('_nama1');
            $tipe=$this->input->post('_tipe');
            $level=$this->input->post('_level');
            $tgl = date('Y-m-d', strtotime($this->input->post('_tgl')));
            $tgl2=date('Y-m-d', strtotime($this->input->post('_tgl2')));
            $saldo=$this->input->post('_saldo');
            $myvar  = empty($myvar) ? NULL : $myvar;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'nomoraccount'=>$id,
                    'namaaccount'=>$nama1,
                    'level'=>$level,
                    'type'=>$tipe,
                    'tanggalentry'=>$tgl,
                    'tanggalsaldoawal'=>$tgl2,
                    'saldo'=>$saldo,

            );

            $in = $this->ms_perkiraan_model->insert($data,$id);
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
            $tipe=$this->input->post('_tipe');
            $level=$this->input->post('_level');
            $tgl = date('Y-m-d', strtotime($this->input->post('_tgl')));
            $tgl2=date('Y-m-d', strtotime($this->input->post('_tgl2')));
            $saldo=$this->input->post('_saldo');
            $myvar  = empty($myvar) ? NULL : $myvar;

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'namaaccount'=>$nama1,
                    'level'=>$level,
                    'type'=>$tipe,
                    'tanggalentry'=>$tgl,
                    'tanggalsaldoawal'=>$tgl2,
                    'saldo'=>$saldo,

            );
            $q = $this->ms_perkiraan_model->update($data,$id);
            echo $q;
        }

        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_perkiraan_model->delete($id);
            echo $r;
        }
    }