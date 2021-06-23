<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Mlogin extends CI_Model {
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    function login($username, $password) {
        
        $this->db->select('id,fullname, login, passwd');
        $this->db->from('wsoft_usuarios');
        $this->db->where('login', $username);
        //$this->db->where('passwd', md5($password));
        $this->db->where('passwd', $password);
        $this->db->limit(1);
         
        
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
        }
    }
}
  
/* End of file modelog.php */
/* Location: ./application/models/modelog.php */
