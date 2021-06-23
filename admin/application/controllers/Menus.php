<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {

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

        $this->load->helper(array('sistema_helper','url'));
        $this->load->model('empleados_model','',TRUE);
        $this->load->model('usuarios_model','',TRUE);
		$this->load->model('documentos_model','',TRUE);
		$this->load->model('permisos_model','',TRUE);	
		$this->load->model('menus_model','',TRUE);	
        $this->load->model('categorias_model','',TRUE);
		
        $this->data['menuMenus'] = 'Gestor de Menus';
      
       
    }

	public function index() {   
	        
        $this->data['menus'] = $this->menus_model->getMenusTipo();
		//var_dump($this->data['menus']);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu'; 
		$this->data['breadcrumbs'] = 'home/breadcrumbs';		

        // cargamos  la interfaz
		$this->data['menuGestorMenus'] = 'Mantenimiento';   
		   
        $this->data['view']   = 'menus/menu';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
 
    public function menusubadd() {  
        $id = $this->uri->segment(3);		
	    $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            
            $alias      = urls_amigables($this->input->post('txtTitulo'));

            $data = array(
                'id_menu' => $id,  
                'titulo' => set_value('txtTitulo'),
                'alias' => $alias, 
                'link' => $alias, 
                'id_categoria' => set_value('cboTipoItem'),
                'id_contenido' => set_value('txtIdEmpleado'),
                'estado' => set_value('cboStatus')
            );

            if ($this->menus_model->add('menus_items', $data) == TRUE) {
                $this->session->set_flashdata('success','Menu registrado con éxito!');
                redirect(base_url() . 'menu/menusubadd/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  
        
 echo "Medu:".$id;
		
	$this->data['tipomenu'] = $this->menus_model->get('menus_tipo','','','','');	        
        //$this->data['menusitem'] = $this->menus_model->getMenuItems('','',$id,'','');
        $this->data['menusitem'] = $this->menus_model->getMenuItemsub('','',$id,'','');
        $this->data['categorias'] = $this->categorias_model->get('categorias','','','','');

	var_dump($this->data['menusitem']);
        
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';      

        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_add';  
        $this->load->view('layout/template',  $this->data);
    
    }
    
	// REGISTRAR MENU 
    public function addmenu(){ 			
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            
            $alias      = urls_amigables($this->input->post('txtTitulo'));

            $data = array(     
                'titulo' => $this->input->post('txtTitulo'),                
                'descripcion' => $this->input->post('txtDescripcion'),
				'alias' => $alias
            );

            if ($this->menus_model->add('wsoft_menus_tipo', $data) == TRUE) {
                $this->session->set_flashdata('success','Menu registrado con éxito!');
                redirect(base_url() . 'menus/addmenu');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }    
   
		$this->data['menuGestorMenus'] = 'Mantenimiento';          
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';
        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_add';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	// EDITAR MENU 
	public function updatemenu(){ 
		$id = $this->uri->segment(3);		 
	 
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            
            $alias = urls_amigables($this->input->post('txtTitulo'));
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			$descripcion = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);

            $data = array(     
                'titulo' => $this->input->post('txtTitulo'),                
                'descripcion' => $descripcion,
				'alias' => $alias,
				'fech_act' => date('Y-m-d H:i:s')
				
            );

            if ($this->menus_model->edit('wsoft_menus_tipo', $data,'id',$id) == TRUE) {
                $this->session->set_flashdata('success','Menu editado con éxito!');
                redirect(base_url() . 'menus/updatemenu/'.$id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }

		//$this->data['registro'] = $this->menus_model->getMenusTipo();  
		$this->data['registro'] = $this->menus_model->getMenus('t.id="'.$id.'"');  		
	    
   
		$this->data['menuGestorMenus'] = 'Mantenimiento';          
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';
        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_edit';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
	public function items(){
		$id = $this->uri->segment(3);	
		if(empty($id)){
			$this->data['menus'] = $this->menus_model->getMenusItems('');
			$this->data['titulomenu'] = "Todo los Items";
		}else{
			
			$this->data['menus'] 		= $this->menus_model->getMenusItems('m.id_tipo="'.$id.'"');
			$titulo 					= $this->menus_model->getMenusItems('t.id="'.$id.'"');				
			$this->data['titulomenu'] 	= $titulo[0]->menu;
		}		        
        	
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu'; 
		$this->data['breadcrumbs'] = 'home/breadcrumbs';		

        // cargamos  la interfaz
		$this->data['menuItems'] = 'Mantenimiento';   
		   
        $this->data['view']   = 'menus/menu_items';  
        $this->load->view('layout/template',  $this->data);
    
    }	
	
	// REGISTRAR MENU 
    public function additems(){   
	
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            
             $alias      = urls_amigables($this->input->post('txtTitulo'));
			$allowedTags ='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			//$descripcion = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);

            $data = array(     
                'titulo' => set_value('txtTitulo'),
				//'descripcion' => $descripcion,
				'estado' => set_value('cboStatus'),
				'id_tipo' => set_value('cboMenu'),
                'alias' => $alias,
				'link' => set_value('txtLink')				
            );

            if ($this->menus_model->add('wsoft_menus', $data) == TRUE) {
                $this->session->set_flashdata('success','Menu registrado con éxito!');
                redirect(base_url() . 'menus/additems');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  
         
		$this->data['tipomenu'] = $this->menus_model->get('wsoft_menus_tipo','','','','');	      
   
		$this->data['menuItems'] = 'Mantenimiento';          
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';
        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_items_add';  
        $this->load->view('layout/template',  $this->data);
    
    }
	
		// REGISTRAR MENU 
    public function updateitems(){   
		  $id = $this->uri->segment(3); 
		//echo $id;	
		
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|required'); 

        if($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        }else{
            
            $alias = urls_amigables($this->input->post('txtTitulo'));
			$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
			$allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
			//$descripcion = strip_tags(stripslashes($this->input->post('txtDescripcion')),$allowedTags);

            $data = array(     
                'titulo' => set_value('txtTitulo'),
				//'descripcion' => $descripcion,
				'estado' => set_value('cboStatus'),
				'id_tipo' => set_value('cboMenu'),
                'alias' => $alias, 
				'link' => set_value('txtLink'), 
				'fech_act' => date('Y-m-d H:i:s')				
				
            );

            if ($this->menus_model->edit('wsoft_menus', $data,'id',$id) == TRUE) {
                $this->session->set_flashdata('success','Menu editado con éxito!');
                redirect(base_url('menus/updateitems/'.$id));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
            }
        }  
         
		$this->data['tipomenu'] = $this->menus_model->get('wsoft_menus_tipo','','','','');
		//$this->data['tipomenu'] = $this->menus_model->getMenus('');  
		$this->data['registro'] = $this->menus_model->getMenusItems('m.id="'.$id.'"');  				
   
		$this->data['menuItems'] = 'Mantenimiento';          
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';   
		$this->data['breadcrumbs'] = 'home/breadcrumbs';
        // cargamos  la interfaz
        $this->data['view']   = 'menus/menu_items_edit';  
        $this->load->view('layout/template',  $this->data);
    
    }


	public function register() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|xss_clean');
        $this->form_validation->set_rules('txtDescripcion', 'Descripcion', 'trim|xss_clean');


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			if($this->input->post('txtTipo')=="M"){
				$tabla="menus";
				$data = array( 
					'id_tipo' => $this->input->post('txtId'),				
					'titulo' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion') 				
				);
				
			}else{
				$tabla="menus_tipo";
				$data = array(              
					'titulo' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion') 				
				);
			}
           

            if ($this->menus_model->add($tabla, $data) == TRUE) {  
			//if ($this->menus_model->add('menus_tipo', $data) == TRUE) {  			
				echo "Ok";
            } else {
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
				echo "Error";
			}
        }
	}
	
	public function update() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
		$this->form_validation->set_rules('txtTitulo', 'Titulo', 'trim|xss_clean');
        $this->form_validation->set_rules('txtDescripcion', 'Descripcion', 'trim|xss_clean');


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			$id = $this->input->post('txtId');
			if($this->input->post('txtTipo')=="M"){
				$tabla="menus";
				$data = array( 
					'id_tipo' => $this->input->post('txtId'),				
					'titulo' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion'), 
					'fech_act' => date('Y-m-d H:i:s') 					
				);
				
			}else{
				$tabla="menus_tipo";
				$data = array(              
					'titulo' => $this->input->post('txtTitulo'),
					'descripcion' => $this->input->post('txtDescripcion'),
					'fech_act' => date('Y-m-d H:i:s') 					
				);
			}
           

            if ($this->menus_model->edit($tabla, $data,'id',$id) == TRUE) {					
				echo "Ok";
            } else {
                //$this->data['custom_error'] = '<div class="form_error"><p>Ha ocurrido un error.</p></div>';
				echo "Error";
			}
        }
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
                $this->empleados_model->edit('empleados', $data,'id',$id);         
                echo "Ok";
                //$this->session->set_flashdata('success','Marca eliminado con éxito!');  
            }
            //redirect(base_url().'marcas');
    }
	
	public function getMenuItems(){
        $options = "";
        if($this->input->post('idmenu')){
            $id     = $this->input->post('idmenu'); 
			$menuitems  = $this->menus_model->getMenusItems('m.id_tipo="'.$id.'"');     
        ?>
          <option value="0" selected> Menu Item Padre </option>
          <?php
            foreach($menuitems as $t)
            {
            ?>
            <option value="<?php echo $t->id; ?>"><?php echo mb_strtoupper($t->titulo, 'UTF-8');?></option>
            <?php
            }
        }
    }




}
