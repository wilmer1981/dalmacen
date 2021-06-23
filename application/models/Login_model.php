<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Login_Model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    public function login($username, $password) {
        
        $this->db->select('id_user,fullname, username, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
         
        
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
			//$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			//redirect(base_url().'login','refresh');
        }
    }
	

  

}
  
/* End of file modelog.php */
/* Location: ./application/models/modelog.php */
