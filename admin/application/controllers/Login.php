<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));  
        $this->load->helper('url');
        $this->load->model('home_model');
        $this->load->model('pedidos_model','',TRUE);
     
    }

	public function index() {
        //if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
        if((!$this->session->userdata('logado'))){
            
          $this->load->view('login/login'); 

        }else{
            $this->data['header'] = 'home/header';
            $this->data['footer'] = 'home/footer';
            $this->data['menu']   = 'home/menu';    
            
            $this->data['menuPanel'] = 'Panel';
            $this->data['view']      = 'home/panel';

            $this->load->view('layout/template',  $this->data); 
        }
          
      
    }

    public function login(){
        
        $this->load->view('login/login');
        
    }

    public function salir(){
        $this->session->sess_destroy();
        $this->load->view('login/login');

        //redirect('home/login');
    }

    public function verificarLoginsss(){
        
        //This method will have the credentials validation
       /* $this->load->library('form_validation');
        $data['resultado'] = '';
           
        $this->form_validation->set_rules('username','Username','required');
        //$this->form_validation->set_rules('username','Username','required|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 
        if($this->form_validation->run() == FALSE){
            //$this->session->set_flashdata('message', $this->ion_auth->errors());
             //Field validation failed.  User redirected to login page
              $data['resultado'] = 'verificar';
              echo json_encode($data);
           } else{
             //Go to private area
             // redirect('home', 'refresh');
             redirect(base_url(), 'refresh');
           }  */     
    }

    public function verificarLogin(){ 
    //function check_database($password){ 
        $this->load->library('encrypt');
        $username = $this->input->post('username');  
        $password = $this->input->post('password');  
        //$password = $this->encrypt->sha1($password);

        $result   = $this->home_model->login_user($username, $password);

        $data['resultado'] = '';
     
       if($result) {
             //$sess_array = array();
            $datos = array();
            foreach($result as $row) { 
                if($row->estado==0) {
                  $data['resultado'] = 'inactivo';
                  echo json_encode($data);
                } else{   
  				        $nombres = $row->nombres .' '. $row->apellidos;				
                  $datos = array('nome' => $nombres, 

  								'id' => $row->id,
  								//'permiso' => $row->permisos_id,
  								//'nompermisos' => $row->permisos,
                  //'imagen' => $row->url_imagen,
  								'logado' => TRUE);

                  $this->session->set_userdata($datos);
                  $data['resultado'] = 'ok';
                  echo json_encode($data);
                }
            }

       }else{
           $data['resultado'] = 'error';
           echo json_encode($data); 
       }
     }



    public function changePassword() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('login/login');
        }

        $oldPassw = $this->input->post('oldPassw');
        $passw    = $this->input->post('newPassw');
		
		//$this->load->library('encrypt');   
       // $oldPassw = $this->encrypt->sha1($oldPassw);
			
		
		$this->load->library('encrypthash'); 
        $oldPassw = $this->encrypthash->tep_encrypt_password($oldPassw);		
        $passw    = $this->encrypthash->tep_encrypt_password($passw);
		
        $result   = $this->home_model->changePassword($passw,$oldPassw,$this->session->userdata('id'));
        if($result){
            $this->session->set_flashdata('success','Contraseña modificada con éxito!');
            redirect(base_url() . 'home/micuenta');
        }
        else{
            $this->session->set_flashdata('error','Ocurrio un error al modificar la contraseña!');
            redirect(base_url() . 'home/micuenta');
            
        }
    }


}
