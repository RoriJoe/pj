<?php
    class Ms_satuan extends CI_Controller{
        function __construct(){
            parent::__construct();

            $this->load->model('ms_satuan_model');
        }
        function index(){
            //request data table
            $data['hasil']=$this->ms_satuan_model->get_paged_list();
            //load view
            $this->load->view('content/master_satuan/ms_satuan_list',$data);
        }

        //SAVE ADD NEW TRIGGER
        function insert()
        {
            $id=$this->input->post('kd');                       
            $nm=$this->input->post('nm');
            
            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'Kode_satuan'=>$id,
                    'Value'=>$nm,
            );
            
            $in = $this->ms_satuan_model->insert($data,$id);
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
            $nm=$this->input->post('nm');
            
            $data= array(
                    'Kode_satuan'=>$id,
                    'Value'=>$nm,
            );
            $q = $this->ms_satuan_model->update($data,$id);
            echo $q;
        }

        //Delete Data
        function delete()
        {
            $id=$this->input->post('id');
            $r = $this->ms_satuan_model->delete($id);
            echo $r;
        }
    }