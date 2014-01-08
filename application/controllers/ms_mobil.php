<?php
    class Ms_mobil extends CI_Controller{
        function __construct(){
            parent::__construct();

            $this->load->model('ms_mobil_model');
            $this->load->library(array('account/authentication', 'account/authorization'));
        }
        function index(){
            $data['hasil']=$this->ms_mobil_model->get_paged_list();
            $this->load->view('content/master_mobil/ms_mobil_list',$data);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            $id=$this->input->post('kd');                       
            
            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'No_mobil'=>$id,
            );
            
            $in = $this->ms_mobil_model->insert($data,$id);
            if($in == "ok")
            {
                echo "ok";
            }
            else{
                echo "gagal";
            }
        }

        //save update
        function update()
        {
            $id=$this->input->post('kd'); 
            $idTemp=$this->input->post('kdTemp');                       
            
            $data= array(
                'No_mobil'=>$id,
            );
            $q = $this->ms_mobil_model->update($data,$idTemp);
            echo $q;
        }

        //Delete Data
        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_mobil_model->delete($id);
            echo $r;
        }
    }