<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Users_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($username, $email, $password) {
		
		$data = array(
			'login'   => $username,
			'email'      => $email,
			'passwd'   => $password,
			'fec_reg' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('wsoft_usuarios', $data);
		
	}

	 //insertamos un nuevo usuario en la tabla users
    public function insert_user()
    {
        $data = array(
            'username'       =>   'Juan68',
            'fname'          =>   'Juan',
            'lname'          =>   'Pérez',
            'register_date'  =>    '2013-01-19 10:00:00'
            );
            $this->db->insert('users',$data);
    }

    public function add_user($nombre, $apellidos, $genero, $email, $password, $tipo, $direccion, $telefono) {
		
		$data = array(
			'nombre'    => $nombre,
			'apellidos' => $apellidos,
			'sexo'      => $genero,
			'login'     => $email,
			'passwd'    => $password,
			'email'     => $email,
			'idnivel'   => $tipo,
			'direccion' => $direccion,
			'telefono'  => $telefono,
			'fec_reg'   => date('Y-m-j H:i:s')
		);
		
		return $this->db->insert('wsoft_usuarios', $data);
		
	}

	 //eliminamos al usuario con id = 1
    public function delete_user($id)
    {
        //$this->db->delete('wsoft_usuarios', array('id' => $id));
        $this->db->where('id', $id);
        $this->db->delete('wsoft_usuarios');
    }

    public function eliminar_user($id){
      $this->db->where('id', $id);
      $this->db->delete('wsoft_usuarios');
      return true;
    }
 
    //actualizamos los datos del usuario con id = 3
    public function update_user()
    {
        $data = array(
            'username' => 'silvia',
            'fname' => 'madrejo',
            'lname' => 'sánchez'
        );
        $this->db->where('id', 3);
        $this->db->update('users', $data);
    }
	
	public function login_user($email, $password) {        
        $this->db->select('c.*');
        $this->db->from('wsoft_clientes c');  
        $this->db->where('c.email', $email);
        $this->db->where('c.password', $password);
        $this->db->limit(1);       
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1) {
            return $query->result(); 
        }else{
            return false;   
        }
    }
	
	/**
	 * forgot_password function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function forgot_password($email){        
        $this->db->select('c.*');
        $this->db->from('wsoft_clientes c');  
        $this->db->where('c.email', $email);      		
        $this->db->limit(1); 
		
        $query = $this->db->get();
		
        if($query->num_rows() == 1) {
           return $query->result();               
        } else {
            return false;  
        }
	}
	/**
	 * get_codigo function.
	 * 
	 * @access public
	 * @param mixed $codigo
	 * @return bool true on success, false on failure
	 */
	public function get_codigo($codigo){        
        $this->db->select('id');
        $this->db->from('wsoft_clientes');        
        $this->db->where('forgot_pass_identity', $codigo);    
        $this->db->limit(1);          
        $query = $this->db->get();
        if($query->num_rows() == 1) {
           return $query->result();               
        } else {
            return false;  
        }
    }
	
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('passwd');
		$this->db->from('wsoft_usuarios');
		$this->db->where('login', $username);
		$passwd = $this->db->get()->row('passwd');
		
		return $this->verify_password($password, $passwd);

		
		/*//$this->db->select('id_user,fullname, username, password');
		$this->db->select('username, password');
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
        }*/
		
	}
	

	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function getVerificarEmail($email){
			
		$this->db->select('c.*');
        $this->db->from('wsoft_clientes c'); 
		$this->db->where('c.email', $email);
		
		$query = $this->db->get();		
       
	    if( $query->num_rows() > 0 ){
	      //return $query->result();
			return TRUE;
	    }else{
			return FALSE;
		}
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($id) {
		$this->db->select('u.id,u.login,u.email,u.nombre,u.apellidos, u.estado as status,u.fec_reg, e.id as idgrupo,e.grupo');
        $this->db->from('wsoft_usuarios u');
		$this->db->join('wsoft_tipo_usuarios e', 'u.idnivel = e.id');
		$this->db->where('u.id', $id);

		return $this->db->get()->row();
		
	}
	
	public function getCustomers($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
		$this->db->select('c.*, g.titulo as grupo, d.id as iddireccion, d.direccion,d.cod_ubigeo,
							u.Nombre as distrito, u.CodDpto, u.CodProv, u.CodDist
							
							');	
				
		$this->db->from('wsoft_clientes c');
		$this->db->join('wsoft_clientes_grupo g', 'g.id = c.id_grupo', 'inner');
		$this->db->join('wsoft_clientes_direcciones d', 'd.id_cliente = c.id', 'left');
		$this->db->join('wsoft_ubigeos u', 'u.CodUbigeo = d.cod_ubigeo', 'left');
		if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getCustomerAddress($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
		$this->db->select('d.*, g.titulo as grupo, c.nombres, c.apellidos, c.telefono,
							u.Nombre, u.CodDpto, u.CodProv, u.CodDist
							
							');	
				
		$this->db->from('wsoft_clientes_direcciones d');
		$this->db->join('wsoft_clientes c', 'c.id = d.id_cliente', 'inner');
		$this->db->join('wsoft_clientes_grupo g', 'g.id = c.id_grupo', 'inner');
		$this->db->join('wsoft_ubigeos u', 'u.CodUbigeo = d.cod_ubigeo', 'left');
		if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
	
	public function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }

	//public function get_users_tipos($id = false){
	public function get_users_tipos(){

            $this->db->select('u.*');
            $this->db->from('wsoft_tipo_usuarios u');   
            $this->db->order_by('u.grupo', 'asc');
      
        $query = $this->db->get();
        //if($query->num_rows() > 0 )
          //  return $query->result();
        //}

	    if( $query->num_rows() > 0 )
	      return $query->result();
	    else
	      return FALSE;

    }


	 //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function get_users($id = false){
        if($id === false)
        {
            $this->db->select('u.id,u.nombre,u.apellidos, u.estado as status,u.fec_reg,e.grupo');
            $this->db->from('wsoft_usuarios u');
            $this->db->join('wsoft_tipo_usuarios e', 'u.idnivel = e.id');
            //$this->db->order_by('u.nombre, u.apellidos', 'asc');
            $this->db->order_by('u.apellidos', 'asc');
        }else{
           // $this->db->select('u.username,u.fname,u.lname,u.register_date,e.titulo,e.entrada,e.publish_date');
            //$this->db->from('users u');
            //$this->db->join('entradas e', 'u.id = e.id_user');
            //$this->db->where('u.id',$id);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }
    function get_usuarios($porpagina,$segmento){

    	$this->db->select('u.id,u.nombre,u.apellidos, u.estado as status,u.fec_reg,e.grupo');
        $this->db->from('wsoft_usuarios u');
        $this->db->join('wsoft_tipo_usuarios e', 'u.idnivel = e.id'); 
        $this->db->order_by('u.apellidos', 'asc');
  		//$query = $this->db->get('alumnos',$porpagina,$segmento);
	    $query = $this->db->get('',$porpagina,$segmento);
	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;
  	}

    function get_total_usuarios(){
    	//return $this->db->count_all('wsoft_usuarios');
    	$consulta = $this->db->get('wsoft_usuarios');
		return  $consulta->num_rows() ;
  	}

  	function total_paginados($por_pagina,$segmento){
  		$this->db->select('u.id,u.nombre,u.apellidos, u.estado as status,u.fec_reg,e.grupo');
        $this->db->from('wsoft_usuarios u');
        $this->db->join('wsoft_tipo_usuarios e', 'u.idnivel = e.id'); 
        $this->db->order_by('u.apellidos', 'asc');

           //$consulta = $this->db->get('wsoft_usuarios',$por_pagina,$segmento);
            $consulta = $this->db->get('',$por_pagina,$segmento);
            if($consulta->num_rows()>0){
                foreach($consulta->result() as $fila){
		    		$data[] = $fila;
				}
                return $data;
            }
	}
	
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	private function md5_password($password) {
		
		return md5($password);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}


	private function verify_password_md5($password, $hash) {
		
		return md5($password, $hash);
		
	}

	private function verify_password($password, $passwd) {
		
		if($password==$passwd)
			return true;
		else
			return false;
		
	}
	
}
