<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');
class Staff extends Staff_Controller
{
    /* Only a logged in user with level 1 or better (an admin)
        can access anything in this controller */
    function __construct()
    {
        parent::__construct();

        //load the library
        $this->load->library("authex");

        //this is how we protect it
        if(! $this->authex->logged_in())
        {
            redirect("login");
        }
        else
        {
            $user_info = $this->authex->get_userdata();

            //make sure they are level 1 or Admin
            if($user_info->Level > 2)
            {
                redirect("error/admin"); //again, for example
            }
        }
    }
}