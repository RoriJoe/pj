<?php
    class User extends CI_Controller{

        function __construct(){
            parent::__construct();
			
            #load library dan helper yang dibutuhkan
            $this->load->model('user_model');
            $this->load->helper(array('form','url'));
            $this->load->library("authex");
        }

        //List
        function index(){
            $data['hasil']=$this->user_model->get_list();
            $this->load->view('content/password/list_user',$data);
        }

        function save($modes){
            $username = $this->input->post('user');
            $password = $this->input->post('password');
            $nama = $this->input->post('nama');
            $level = $this->input->post('lev');
            $myvar  = empty($myvar) ? NULL : $myvar;

            if($modes == "add"){
                $data = array(
                    "username" => $username,
                    "password" => md5($password),
                    "Nama" => $nama,
                    "Level" => $level,
                    "Last_Login" => $myvar,
                );

                $in = $this->user_model->insert($data,$username);
            }
            else if($modes == "edit")
            {
                $data = array(
                    "password" => md5($password),
                    "Nama" => $nama,
                    "Level" => $level,
                    "Last_Login" => $myvar,
                );

                $in = $this->user_model->update($data,$username);
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
            $kode=$this->input->post('user');
            $r = $this->user_model->delete($kode);
            echo $r;
        }
    }