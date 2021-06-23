<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {
    
    public function __construct() {
    /*
         if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }
     */

        parent::__construct();

        if((!$this->session->userdata('logado'))){
            redirect('home/login');
        }   
   
        $this->load->model('permisos_model', '', TRUE);  
	
		$this->data['menuUsuarios'] = 'Genereales';
        $this->data['menuPermisos'] = 'Configuraciones';	
    }
	

	public function index(){
        
        $this->load->library('pagination');        
        
        $config['total_rows'] = $this->permisos_model->count('wsoft_permisos');
        $config['per_page'] = 10;


		$this->data['results'] = $this->permisos_model->get('wsoft_permisos','id,nombre,estado,fech_reg','','','');
  
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
        $this->data['breadcrumbs'] = 'home/breadcrumbs';
        $this->data['view']   = 'mantenimiento/permisos/permisos';
	

        $this->load->view('layout/template',  $this->data);       
		
    }
	
    public function adicionar() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

       $this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomPermiso = $this->input->post('txtNombre');
            $fecha      = date('Y-m-d');
            $estado     = 1;

            $permisos = array(
					'cSistema' => $this->input->post('cSistema'),
					'cUsuario' => $this->input->post('cUsuario'),                  
					'cContenido' => $this->input->post('cContenido'),
					'cMenu' => $this->input->post('cMenu'),
					'cCotizacion' => $this->input->post('cCotizacion'),
					'cProducto' => $this->input->post('cProducto'),				
				  
					'vUsuario' => $this->input->post('vUsuario'),
					'aUsuario' => $this->input->post('aUsuario'),
					'eUsuario' => $this->input->post('eUsuario'), 
					'dUsuario' => $this->input->post('dUsuario'),					
					
					'vGrupo' => $this->input->post('vGrupo'),
					'aGrupo' => $this->input->post('aGrupo'),
					'eGrupo' => $this->input->post('eGrupo'),
					'dGrupo' => $this->input->post('dGrupo'),
					
					'vPermiso' => $this->input->post('vPermiso'),
					'aPermiso' => $this->input->post('aPermiso'),
					'ePermiso' => $this->input->post('ePermiso'),
					'dPermiso' => $this->input->post('dPermiso'),
					
					'vArticulo' => $this->input->post('vArticulo'),
					'aArticulo' => $this->input->post('aArticulo'),
					'eArticulo' => $this->input->post('eArticulo'),
					'dArticulo' => $this->input->post('dArticulo'),
					
					'vCategoria' => $this->input->post('vCategoria'),
					'aCategoria' => $this->input->post('aCategoria'),
					'eCategoria' => $this->input->post('eCategoria'),
					'dCategoria' => $this->input->post('dCategoria'),
					
					'vBanner' => $this->input->post('vBanner'),
					'aBanner' => $this->input->post('aBanner'),
					'eBanner' => $this->input->post('eBanner'),
					'dBanner' => $this->input->post('dBanner'),
					
					'vMenu' => $this->input->post('vMenu'),
					'aMenu' => $this->input->post('aMenu'),
					'eMenu' => $this->input->post('eMenu'),
					'dMenu' => $this->input->post('dMenu'),
					
					'vProducto' => $this->input->post('vProducto'),
					'aProducto' => $this->input->post('aProducto'),
					'eProducto' => $this->input->post('eProducto'),
					'dProducto' => $this->input->post('dProducto'),
					
					'vCatproducto' => $this->input->post('vCatproducto'),
					'aCatproducto' => $this->input->post('aCatproducto'),
					'eCatproducto' => $this->input->post('eCatproducto'),
					'dCatproducto' => $this->input->post('dCatproducto'),
					
					'vMarca' => $this->input->post('vMarca'),
					'aMarca' => $this->input->post('aMarca'),
					'eMarca' => $this->input->post('eMarca'),
					'dMarca' => $this->input->post('dMarca'),
					
					'vCotizacion' => $this->input->post('vCotizacion'),
					'aCotizacion' => $this->input->post('aCotizacion'),
					'eCotizacion' => $this->input->post('eCotizacion'),
					'dCotizacion' => $this->input->post('dCotizacion'),
					
					'vSistema' => $this->input->post('vSistema'),
					'vBackup' => $this->input->post('vBackup')			  

            );

            $permisos = serialize($permisos);

            $data = array(
                'nombre' => $nomPermiso,        
                'permisos' => $permisos,
                'estado' => $estado
            );

            if ($this->permisos_model->add('permisos', $data) == TRUE) {

                $this->session->set_flashdata('success', 'Permisos añadidos con éxito.');
                redirect(base_url() . 'permisos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Modelourrio un error.</p></div>';
            }
        }

        //$this->data['view'] = 'permisos/adicionarPermiso';
        //$this->load->view('tema/topo', $this->data);
        $this->data['header'] = 'home/header';
        $this->data['footer'] = 'home/footer';
        $this->data['menu']   = 'home/menu';
		$this->data['breadcrumbs'] = 'home/breadcrumbs';
		 
        $this->data['view']   = 'mantenimiento/permisos/permisosAdicionar';
        $this->load->view('layout/template',  $this->data);


    }

    public function editar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomPermiso = $this->input->post('txtNombre');
            $estado     = $this->input->post('estado');
			
            $permisos = array(
					'cSistema' => $this->input->post('cSistema'),
					'cUsuario' => $this->input->post('cUsuario'),                  
					'cContenido' => $this->input->post('cContenido'),
					'cMenu' => $this->input->post('cMenu'),
					'cCotizacion' => $this->input->post('cCotizacion'),
					'cProducto' => $this->input->post('cProducto'),				
				  
					'vUsuario' => $this->input->post('vUsuario'),
					'aUsuario' => $this->input->post('aUsuario'),
					'eUsuario' => $this->input->post('eUsuario'), 
					'dUsuario' => $this->input->post('dUsuario'),					
					
					'vGrupo' => $this->input->post('vGrupo'),
					'aGrupo' => $this->input->post('aGrupo'),
					'eGrupo' => $this->input->post('eGrupo'),
					'dGrupo' => $this->input->post('dGrupo'),
					
					'vPermiso' => $this->input->post('vPermiso'),
					'aPermiso' => $this->input->post('aPermiso'),
					'ePermiso' => $this->input->post('ePermiso'),
					'dPermiso' => $this->input->post('dPermiso'),
					
					'vArticulo' => $this->input->post('vArticulo'),
					'aArticulo' => $this->input->post('aArticulo'),
					'eArticulo' => $this->input->post('eArticulo'),
					'dArticulo' => $this->input->post('dArticulo'),
					
					'vCategoria' => $this->input->post('vCategoria'),
					'aCategoria' => $this->input->post('aCategoria'),
					'eCategoria' => $this->input->post('eCategoria'),
					'dCategoria' => $this->input->post('dCategoria'),
					
					'vBanner' => $this->input->post('vBanner'),
					'aBanner' => $this->input->post('aBanner'),
					'eBanner' => $this->input->post('eBanner'),
					'dBanner' => $this->input->post('dBanner'),
					
					'vMenu' => $this->input->post('vMenu'),
					'aMenu' => $this->input->post('aMenu'),
					'eMenu' => $this->input->post('eMenu'),
					'dMenu' => $this->input->post('dMenu'),
					
					'vProducto' => $this->input->post('vProducto'),
					'aProducto' => $this->input->post('aProducto'),
					'eProducto' => $this->input->post('eProducto'),
					'dProducto' => $this->input->post('dProducto'),
					
					'vCatproducto' => $this->input->post('vCatproducto'),
					'aCatproducto' => $this->input->post('aCatproducto'),
					'eCatproducto' => $this->input->post('eCatproducto'),
					'dCatproducto' => $this->input->post('dCatproducto'),
					
					'vMarca' => $this->input->post('vMarca'),
					'aMarca' => $this->input->post('aMarca'),
					'eMarca' => $this->input->post('eMarca'),
					'dMarca' => $this->input->post('dMarca'),
					
					'vCotizacion' => $this->input->post('vCotizacion'),
					'aCotizacion' => $this->input->post('aCotizacion'),
					'eCotizacion' => $this->input->post('eCotizacion'),
					'dCotizacion' => $this->input->post('dCotizacion'),
					
					'vSistema' => $this->input->post('vSistema'),
					'vBackup' => $this->input->post('vBackup')			  

            );
			
            $permisos = serialize($permisos);

            $data = array(
                'nombre' => $nomPermiso,
                'permisos' => $permisos,
                'estado' => $estado
            );

            if ($this->permisos_model->edit('wsoft_permisos', $data, 'id', $this->input->post('idpermiso')) == TRUE) {
                $this->session->set_flashdata('success', 'Permisos editados con éxito!');
                redirect(base_url() . 'permisos/editar/'.$this->input->post('idpermiso'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Modeloorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->permisos_model->getById($this->uri->segment(3));

        $this->data['header'] 		= 'home/header';
        $this->data['footer'] 		= 'home/footer';
        $this->data['menu']   		= 'home/menu';
        $this->data['breadcrumbs'] 	= 'home/breadcrumbs';
		
        $this->data['view']   = 'mantenimiento/permisos/permisosEditar';
        $this->load->view('layout/template',  $this->data);

    }
	
    function excluir(){

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Error al intentar eliminar el permiso.');            
            redirect(base_url().'index.php/permissoes/gerenciar/');
        }

        $this->db->where('permissoes_id', $id);
        $this->db->delete('permissoes_os');

        $this->Categorias_model->delete('permissoes','idPermissao',$id);             
        

        $this->session->set_flashdata('success','permiso eliminado con exito');            
        redirect(base_url().'index.php/permissoes/gerenciar/');
    }
}


/* End of file permissoes.php */
/* LModeloation: ./application/controllers/permissoes.php */