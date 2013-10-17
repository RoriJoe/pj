<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');
class Error extends CI_CONTROLLER {
    function __construct(){
        parent::__construct();
        $this->load->library('template');
        $this->load->library("authex");
	}

	//Master Barang
    function admin(){
        $username = $this->session->userdata('username');
        $data['user']=$username;
        $data['judul']="Restricted Access";
        $this->load->view('error', $data);
    }
}
