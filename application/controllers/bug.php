<?php
    class Bug extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model('bug_model');
        }
        
        function view(){
            $data['hasil'] = $this->bug_model->get_issue();
            $this->load->view("content/list/list_bug",$data);
        }
        
        function insert()
        {
            //GET VARIABLE FROM MODEL //kd:kd, nama1:nama1, nama2:nama2, uk:uk, ps:ps, st:st
            $nama=$this->input->post('nama');
            $title=$this->input->post('title');
            $desc=$this->input->post('desc');
            $priority=$this->input->post('priority');

            //ADD TO ARRAY FOR SEND TO MODEL
            $data= array(
                    'email'=>$nama,
                    'title'=>$title,
                    'desc'=>$desc,
                    'priority'=>$priority,
            );

            $in = $this->bug_model->insert($data);
        }
    }