<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Marcas_model extends CI_Model {

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
	public function create_estado($username, $email, $password) {
		
		$data = array(
			'login'   => $username,
			'email'      => $email,
			'passwd'   => $password,
			'fec_reg' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('wsoft_usuarios', $data);
		
	}

	 //insertamos un nuevo usuario en la tabla users
    public function insert_estado()
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
	public function get_user_id_from_username($username) {
		
		$this->db->select('id');
		$this->db->from('wsoft_usuarios');
		$this->db->where('login', $username);

		return $this->db->get()->row('id');
		
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

	//public function get_users_tipos($id = false){
	public function get_users_tipos(){

            $this->db->select('u.*');
            $this->db->from('wsoft_tipo_usuarios u');   
            $this->db->order_by('u.grupo', 'asc');
      
        $query = $this->db->get();
        //if($query->num_rows() > 0 )
          //  return $query->result();
        //}

	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;

    }
	
  	public function sp_getMarcasAll(){	     
	    $query="CALL sp_getMarcasAll()";
	    $parameters=array();
	    $result = $this->db->query($query,$parameters);  
		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	   
	    //return $result->result();
    }
	

/*
public function get_users_tipos($id){
        if($id === false){
            $this->db->select('u.*');
            $this->db->from('wsoft_tipo_usuarios u');   
            $this->db->order_by('u.grupo', 'asc');
        }else{
            $this->db->select('u.*');
            $this->db->from('wsoft_tipo_usuarios u'); 
            $this->db->where('u.id',$id);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }*/
	/*public function get_users() {

		$this->db->from('wsoft_usuarios');
		return $this->db->get()->row();
		
	}*/

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
	
	

	
}
