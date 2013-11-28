<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');
class Admin extends Staff_Controller
{
    /* Only a logged in user with level 1 or better (an admin)
        can access anything in this controller */
    function __construct()
    {
        parent::__construct();

        //load the library
        $this->load->library("authex");
        $this->load->library('template');

        //this is how we protect it
        if(! $this->authex->logged_in())
        {
            redirect("login");
        }
        else
        {
            $user_info = $this->authex->get_userdata();

            //make sure they are level 1 or Admin
            if($user_info->Level != 1)
            {
                redirect("error/admin"); //again, for example
                //$this->error_level();
            }
        }
    }

    function index(){
        redirect('admin/home');
    }

    function saw(){
        $data['judul']="Pendataan Saldo Awal";
        $this->template->display('content/saw/saw_h', $data);
    }

    function piutang(){
        $data['judul']="Status Piutang";
        $this->template->display('content/piutang/piutang', $data);
    }

    function user(){
        $data['judul']="Create Password";
        $data['error']="";
        $data['img'] = "";
        $this->template->display('content/password/password', $data);
    }

    function upload(){
        $this->load->model('user_model');

        $username = $this->input->post('users2');


        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '1000';
        $config['max_width'] = '300';
        $config['max_height'] = '300';
        $config['file_name'] = $username;

        $this->load->library('upload',$config);

        if(!$this->upload->do_upload()){
            $error['judul'] = "Create Password";
            $error['error'] = $this->upload->display_errors();
            $error['img'] = "";
            $this->template->display('content/password/password', $error);
        }else
        {
            $file_data = $this->upload->data();

            $data = array(
                "image" => $file_data['file_name']
            );

            $in = $this->user_model->update_image($data,$username);

            $data['judul']="Create Password";
            $data['error'] = "Image Uploaded!";
            $data['img'] = base_url().'/images/'.$file_data['file_name'];
            $this->template->display('content/password/password', $data);
        }
    }
}