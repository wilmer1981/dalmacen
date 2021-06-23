<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller {

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
        if((!$this->session->userdata('logado'))){
            redirect('home/login');
        }
        /*if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('home/login');
        }*/

        $this->load->helper(array('codegen_helper','url'));
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
        $this->load->model('documentos_model','',TRUE);
		
        $this->data['menuTipodoc'] = 'Tipodoc';
        $this->data['menuMantenimiento'] = 'Mantenimiento';
       
    }

	public function index() {   
	
     

       // $user_id= $this->session->userdata('id');   
        
        $this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','','','');

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'mantenimiento/documentos/documentos';  
        $this->load->view('layout/template',  $this->data);
    
    }



    public function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'documento' => set_value('txtNombre'),         
                'operacion' => set_value('cboOperacion'),
                'serie' => set_value('txtSerie'),  
                'numero' => set_value('txtNumero')        
            );

            if ($this->documentos_model->add('documentos_tipo', $data) == TRUE) {
                $this->session->set_flashdata('success','Documento agregado con éxito!');
                redirect(base_url() . 'documentos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }

        $this->data['documentostipo'] = $this->documentos_model->get('documentos_tipo','','','','');
      
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/documentos/documentosAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {

        $id = $this->uri->segment(3);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'documento' => set_value('txtNombre'),         
                'operacion' => set_value('cboOperacion'),
                'serie' => set_value('txtSerie'),  
                'numero' => set_value('txtNumero'),
                'fech_act' => date('Y-m-d H:M:i')        
            );

            if ($this->documentos_model->edit('documentos_tipo', $data,'id',$id) == TRUE) {
                $this->session->set_flashdata('success','Documento editado con éxito!');
                redirect(base_url() . 'documentos/editar/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }

        $this->data['documentos']     = $this->documentos_model->get('documentos','','id="'.$id.'"','','');
        $this->data['documentostipo'] = $this->documentos_model->get('documentos_tipo','','','','');

 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'mantenimiento/documentos/documentosEditar';
        $this->load->view('layout/template',  $this->data);

    }


 


	public function lista() {
      // $this->lista();
		$config['base_url'] = base_url().'empleados/gerenciar/';
       // $config['total_rows'] = $this->clientes_model->count('customers');
        $total_c1 = $this->empleados_model->count('empleados');
  
        $config['total_rows'] = $total_c1;
        $config['per_page'] = 10;
        if($this->uri->segment(3)){
            $config['per_star'] = $this->uri->segment(3);
        }else{
            $config['per_star'] = 0;
        }
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>'; 
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>'; 
        $config['cur_tag_open'] = '<li class="active"><span>'; 
        $config['cur_tag_close'] = '<span></span></span></li>'; 
        $config['prev_tag_open'] = '<li>'; 
        $config['prev_tag_close'] = '</li>'; 
        $config['next_tag_open'] = '<li>'; 
        $config['next_tag_close'] = '</li>'; 
        //$config['first_link'] = '&laquo;'; 
        $config['first_link'] = 'Primera';
        //$config['prev_link'] = '‹'; 
        $config['prev_link'] = 'Anterior';
        //$config['last_link'] = '&raquo;'; 
        $config['last_link'] = '&Uacute;ltima';
        //$config['next_link'] = '›'; 
        $config['next_link'] = 'Pr&oacute;xima';
        $config['first_tag_open'] = '<li>'; 
        $config['first_tag_close'] = '</li>'; 
        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>'; 

       // $user_id= $this->session->userdata('id');   
        
        $this->data['empleados'] = $this->empleados_model->getEmpleados('',$config['per_page'],$config['per_star']);
		      
        $this->load->view('mantenimiento/empleados/empleadosLista',  $this->data);
    
    }

    public function delete(){

           /* if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dMarca')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Marcas.');
               redirect(base_url());
            }*/

            //$varID=$this->uri->segment(3);
            // $id =  $this->input->post('id');
             $id     =  $_POST['id'];
             $estado =  $_POST['estado'];

            if($estado==1){
                $status=0;
            }else{
                $status=1;
            }
    
            if ($id == null){
               // $this->session->set_flashdata('error','Error al intentar eliminar Usuario.');            
                //redirect(base_url().'usuarios');
                echo "No hay Id";
            }else{      
                //$this->usuarios_model->delete('usuarios','id',$id);
                    $data = array(
                        'estado' => $status,                  
                        'fech_act'=> date('Y-m-d H:m:i')                         
                    );   
                $this->documentos_model->edit('documentos', $data,'id',$id);         
                echo "Ok";
                //$this->session->set_flashdata('success','Marca eliminado con éxito!');  
            }
            //redirect(base_url().'marcas');
    }



}
