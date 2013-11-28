<?php if ( ! defined('BASEPATH')) exit('Hacking Attemp Detected!');

class Authex{

 function Authex()
 {
     $CI =& get_instance();

     //load libraries
     $CI->load->database();
     $CI->load->library("session");
 }

 function get_userdata()
 {
     $CI =& get_instance();

     if( ! $this->logged_in())
     {
         return false;
     }
     else
     {
          $query = $CI->db->get_where("muser", array("username" => $CI->session->userdata("username")));
          return $query->row();
     }
 }

 function logged_in()
 {
     $CI =& get_instance();
     return ($CI->session->userdata("username")) ? true : false;
 }

 function login($username, $password)
 {
     $CI =& get_instance();

     $data = array(
         "username" => $username,
         "password" => md5($password)
     );

     $query = $CI->db->get_where("muser", $data);

     if($query->num_rows() !== 1)
     {
         /* their username and password combination
         * were not found in the databse */
         return false;
     }
     else
     {
         //update the last login time
         $last_login = date("Y-m-d H-i-s");

         $data = array(
             "last_login" => $last_login
         );

         $CI->db->update("muser", $data);

         //store user id in the session
         $dataset = array(
            'username' => $query->row()->username,
            'Nama' => $query->row()->Nama,
            'level' => $query->row()->Level,
            'image' => $query->row()->image
            );
         $CI->session->set_userdata($dataset);

         return true;
     }
 }

 function logout()
 {
     $CI =& get_instance();
     $dataset = array(
        'username',
        'Nama',
        'level'
        );
     $CI->session->unset_userdata($dataset);
 }

 function register($username, $password, $name, $level)
 {
     $CI =& get_instance();

     if($this->can_register($username))
     {
         $data = array(
             "username" => $username,
             "password" => md5($password),
             "Nama" => $name,
             "Level" => $level
         );

         $CI->db->insert("muser", $data);

         return true;
     }

     return false;
 }

 function can_register($username)
 {
     $CI =& get_instance();

     $query = $CI->db->get_where("muser", array("username" => $username));

     return ($query->num_rows() < 1) ? true : false;
 }
}