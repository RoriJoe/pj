<?php
    class Error_msg extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        function index(){
            $this->load->view('missing');
        }

        function restricted(){
            $this->load->view('denied');
        }
    }