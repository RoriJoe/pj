<?php
    class Bug_model extends CI_Model{
        
        private $primary_key='Kode';
        private $table_name='issue';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_issue(){
            $q=$this->db->get('issue');
            return $q->result();
        }
        
        //model untuk save add data
        function insert($data)
        {
           $q=$this->db->insert($this->table_name, $data);  
        }
    }

    /*End of File*/
  /**Location: Model/plugin/bug_model*/  