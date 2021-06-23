<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

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
        $this->load->model('paises_model','',TRUE);
        $this->load->model('proveedores_model','',TRUE);
	
    }

	public function index() {   
       
        $this->data['proveedores'] = $this->proveedores_model->getProveedores('','','');



        $this->data['menuProveedores'] = 'Proveedores';
        $this->data['menuCompras'] = 'Compras';    
       
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'compras/proveedores/proveedores';  
        $this->load->view('layout/template',  $this->data);
    
    }

    public function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        $this->form_validation->set_rules('txtRazonsocial', 'Razon Social', 'trim|required');
        $this->form_validation->set_rules('cboPais', 'Pais', 'required');
        $this->form_validation->set_rules('cboEstado', 'Estado', 'required');
        $this->form_validation->set_rules('txtNombre', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('txtApellidos', 'Apellidos', 'trim|required');      
        $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|is_unique[contactos.email]');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

             $data = array(

                'razon_social' => set_value('txtRazonsocial'),
                'ruc' => set_value('txtRuc'),
                'direccion' => set_value('txtDireccion'),
                'ciudad' => set_value('txtCiudad'),
                'id_pais' => set_value('cboPais'),               
                'id_estado' => set_value('cboEstado'),
                'url_web' => set_value('txtWeb')               
            );            

            if ($this->proveedores_model->add('proveedores', $data) == TRUE) {
                
                $maximo=$this->proveedores_model->getByMaxId('proveedores','id');
                $id=$maximo->id;

                $data = array(
                    'tipo_contacto' => 'P',
                    'id_tipocontacto' => $id,
                    'nombres' => set_value('txtNombre'),
                    'apellidos' => set_value('txtApellidos'),        
                    'telefono' => set_value('txtTelefono'),  
                    'celular' => set_value('txtCelular'),               
                    'email' => set_value('txtEmail')                 
                );


                $this->proveedores_model->add('contactos', $data);

                $this->session->set_flashdata('success','Proveedor y su contacto agregado con éxito!');
                redirect(base_url() . 'proveedores/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
		
		$this->data['documentos'] = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
        $this->data['paises']     = $this->paises_model->get('pais','','','','');
		//var_dump($this->data['documentos']);
        
        $this->data['menuProveedores'] = 'Proveedores';
        $this->data['menuCompras'] = 'Compras'; 

        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'compras/proveedores/proveedoresAdicionar';
        $this->load->view('layout/template',  $this->data);

    }

    public function editar() {

        $id = $this->uri->segment(3);

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        $this->form_validation->set_rules('txtRazonsocial', 'Razon Social', 'trim|required');
        $this->form_validation->set_rules('cboPais', 'Pais', 'required');
        $this->form_validation->set_rules('cboEstado', 'Estado', 'required');
        $this->form_validation->set_rules('txtNombre', 'Nombres', 'trim|required');
        $this->form_validation->set_rules('txtApellidos', 'Apellidos', 'trim|required');      
        $this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('txtEmail', 'Email', 'required|valid_email|is_unique[contactos.email]');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

             $data = array(
                'razon_social' => set_value('txtRazonsocial'),
                'ruc' => set_value('txtRuc'),
                'direccion' => set_value('txtDireccion'),
                'ciudad' => set_value('txtCiudad'),
                'id_pais' => set_value('cboPais'),               
                'id_estado' => set_value('cboEstado'),
                'url_web' => set_value('txtWeb'),
                'fech_act' => date('Y-m-d H:m:i')

            );           

      
            if ($this->proveedores_model->edit('proveedores',$data,'id',$id) == TRUE){
                
                $data = array(
                    'tipo_contacto' => 'P',
                    'id_tipocontacto' => $id,
                    'nombres' => set_value('txtNombre'),
                    'apellidos' => set_value('txtApellidos'),        
                    'telefono' => set_value('txtTelefono'),  
                    'celular' => set_value('txtCelular'),               
                    'email' => set_value('txtEmail'),
                    'fech_act' => date('Y-m-d H:m:i')                
                );


                $this->proveedores_model->edit('contactos',$data,'id_tipocontacto',$id); 

                $this->session->set_flashdata('success','Proveedor y su contacto agregado con éxito!');
                redirect(base_url() . 'proveedores/editar/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }
        
        $this->data['proveedor']   = $this->proveedores_model->getProveedores('p.id="'.$id.'"','','');
        $this->data['contactos']   = $this->proveedores_model->getContactos('c.id_tipocontacto="'.$id.'"','','');
        $this->data['documentos']  = $this->documentos_model->getDocumentos('documentos','','operacion="P"','','');
        $this->data['paises']      = $this->paises_model->get('pais','','','','');
        $this->data['estados']     = $this->paises_model->get('estado','','','','');
        //var_dump($this->data['contactos']);

         $this->data['menuProveedores'] = 'Proveedores';
        $this->data['menuCompras'] = 'Compras'; 
 
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['view']   = 'compras/proveedores/proveedoresEditar';
        $this->load->view('layout/template',  $this->data);

    }

    public function getEstados(){
        $options = "";
        if($this->input->post('idpais')){
            $idpais   = $this->input->post('idpais');
            $estados  = $this->paises_model->get('estado','',$where='id_pais="'.$idpais.'"','','');
        ?>
          <option value="" disabled selected>-- Escoje Estado --</option>
          <?php
            foreach($estados as $fila)
            {
            ?>
            <option value="<?php echo $fila->id; ?>"><?php echo $fila->nombre; ?></option>
            <?php
            }
        }
    }


    public function get_json(){

        // armamos las condiciones segun sea el caso .. ------------------------
        $query          = $this->input->post('query');
        $qtype          = $this->input->post('qtype');
        $letter_pressed = $this->input->post('letter_pressed');
        $page           = $this->input->post('page');
        $rp             = $this->input->post('rp');
        $sortname       = $this->input->post('sortname');
        $sortorder      = $this->input->post('sortorder');

        $consulta = $this->user_model->get_json($query,$qtype,$letter_pressed,$page,$rp,$sortname,$sortorder);

        // imprimimos los datos en formato json
        echo $consulta;
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
        
        $this->data['proveedores'] = $this->proveedores_model->getProveedores('',$config['per_page'],$config['per_star']);
              
        $this->load->view('compras/proveedores/proveedoresLista',  $this->data);
    
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
                $this->proveedores_model->edit('proveedores', $data,'id',$id);         
                echo "Ok";
                //$this->session->set_flashdata('success','Marca eliminado con éxito!');  
            }
            //redirect(base_url().'marcas');
    }



}
