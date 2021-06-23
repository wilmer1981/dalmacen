<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

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

        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('categorias_model','',TRUE);
		$this->load->model('generales_model','',TRUE);
				
    }

	public function index() {  	
         
        //$this->data['empleados'] = $this->categorias_model->get('categorias','','','','');
        $this->data['categorias'] = $this->categorias_model->getCategorias('','','c.id_categoria=0','','');
        // $this->data['empleados'] = $this->categorias_model->get('categorias','','',$config['per_page'],$config['per_star']);

		
		$this->data['menuContenido'] = 'Contenido'; 
        $this->data['menuCategorias'] = 'Categroias';	
		
		$this->data['breadcrumbs'] = 'home/breadcrumbs';   
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/categorias/categorias';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function adicionar() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(              
				'nombre' => $this->input->post('txtNombre') 				
            );

            if ($this->categorias_model->add('categorias', $data) == TRUE) {
                //$this->session->set_flashdata('success','Categoria agregado con éxito!');
                //redirect(base_url() . 'categorias/adicionar/');
				echo "Ok";
            } else {
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
				echo "Error";
			}
        }
	}
	
	public function adicionarsss() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(              
				'nombre' => $this->input->post('txtNombre') 				
            );

            if ($this->categorias_model->add('categorias', $data) == TRUE) {
                //$this->session->set_flashdata('success','Categoria agregado con éxito!');
                //redirect(base_url() . 'categorias/adicionar/');
				echo "Ok";
            } else {
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
				echo "Error";
			}
        }
	}



    public function editar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {


            $id   = $this->input->post('txtId');
            $data = array(              
                'nombre' => $this->input->post('txtNombre')                 
            );

            if($this->input->post('opcion')=='categoria'){
                if($this->categorias_model->edit('categorias',$data,'id',$id) == TRUE) {   
                        echo "Ok";       
                }else {       
                        echo "Error";
                }
            }else{
                if($this->categorias_model->edit('subcategorias',$data,'id',$id) == TRUE) {   
                        echo "Ok";       
                }else {       
                        echo "Error";
                }
            }


        }


    }
	
	
    public function excluir(){

            if(!$this->permission->checkPermission($this->session->userdata('permiso'),'dCategoria')){
               $this->session->set_flashdata('error','No tiene permiso para eliminar Categoria.');
               redirect(base_url());
            }

                 //$varID=$this->uri->segment(3);
             $id =  $this->input->post('id');
    
            if ($id == null){
                $this->session->set_flashdata('error','Error al intentar eliminar Categoria.');            
                redirect(base_url().'categorias');
            }else{      
                $this->categorias_model->delete('categorias','id',$id); 
               // $this->clientes_model->delete('temp_customers_info','customers_info_id',$id); 
               // $this->clientes_model->delete('temp_customers','customers_id',$id); 
				echo "Ok";
                //$this->session->set_flashdata('success','Categoria eliminado con éxito!');  
            }
            //redirect(base_url().'categorias');
    }


	public function editarpopup() {  

        if(!$this->permission->checkPermission($this->session->userdata('permiso'),'eCategoria')){
           $this->session->set_flashdata('error','No tiene permiso para editar categoria.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        //validaciones

            $this->form_validation->set_rules('id', 'Id categoria', 'trim|xss_clean');
            $this->form_validation->set_rules('name', 'Categoria', 'trim|xss_clean');

        
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {        
                $id = $this->input->post('id');
                $data = array(  
                                'nombre' => $this->input->post('name')                   
                        );
                 //function edit($table,$data,$fieldID,$ID)                               
                if ($this->categorias_model->edit('categorias',$data,'id',$id) == TRUE) {
                        $this->session->set_flashdata('success','Contacto agregado con éxito!');
                       // redirect(base_url() . 'categorias');                                       
                } else {
                    $this->data['custom_error'] = '<div class="form_error"><p>Ocorrio un error.</p></div>';
                }
        
                    
        }//fin else
  

        $this->data['id']   = $_POST['id']; 
        $this->data['name'] = $_POST['name']; 		      
        $this->load->view('almacen/categorias/categoriasEditar',  $this->data);    
    }


    public function subcategorias() {   
        $idcat = $this->uri->segment(3);
        
        //$this->data['empleados'] = $this->categorias_model->get('categorias','','','','');
        $this->data['subcategorias'] = $this->categorias_model->getSubcategorias('','','id_categoria="'.$idcat.'"','','');
        // $this->data['empleados'] = $this->categorias_model->get('categorias','','',$config['per_page'],$config['per_star']);
        $this->data['categoria']    = $this->categorias_model->getById('categorias',$idcat);

		
		$this->data['menuContenido'] = 'Ventas'; 
        $this->data['menuCategorias'] = 'Articulos';
		
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'almacen/categorias/subcategorias';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function adicionarSubcategoria() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('documentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array( 
                'id_categoria' => $this->input->post('txtIdCat'),             
                'nombre' => $this->input->post('txtNombre')                 
            );

            if ($this->categorias_model->add('subcategorias', $data) == TRUE) {
                //$this->session->set_flashdata('success','Categoria agregado con éxito!');
                //redirect(base_url() . 'categorias/adicionar/');
                echo "Ok";
            } else {
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
                echo "Error";
            }
        }
    }
	
	public function getCboSubcategorias(){
   
        if($this->input->post('idcategoria')){
            $idcat    = $this->input->post('idcategoria');      
                    
            $subcategorias = $this->generales_model->get('wsoft_categorias','','id_categoria="'.$idcat.'"','','');
                      
            echo '<option value="" selected>-- Seleccione --</option>';
            foreach($subcategorias as $fila){         
                echo '<option value="'.$fila->id .'">'.mb_strtoupper($fila->titulo, 'UTF-8').'</option>';
            }      
        }
    }
    

}
