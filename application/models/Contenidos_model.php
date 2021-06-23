<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Contenidos_model extends CI_Model {

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
	public function sp_getSiteOffline(){    

		$results = array();
		
		$this->db->select('s.*');
		$this->db->from('wsoft_site s');      
		
		$query = $this->db->get();

		if($query->num_rows() > 0) {
		  $results = $query->row();
		}
		  return $results;   
  
    }
	

    public function sp_getContenidos($content){	     
	    $query="CALL sp_getContenidos(?)";
	    $parameters=array($content);
	    $result = $this->db->query($query,$parameters);  
		$rest = $result->row();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	   
	    //return $result->result();
    }

   	public function sp_getBanners(){	     
	    $query="CALL sp_getBanners()";
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

	public function get_categorias(){
	     
	   $this->db->select('c.*');
        $this->db->from('wsoft_categorias c');   
        $this->db->order_by('c.descripcion', 'asc');      
        $query = $this->db->get();
	
	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;
    }
	
	public function sp_getCategorias(){	     
	    $query="CALL sp_getCategorias()";
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

    public function sp_getSubCategorias(){	     
	    $query="CALL sp_getSubCategorias()";
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

    public function sp_getProductos($idsub,$perpage=0,$start=0,$one=false,$array='array'){	     
	    $sql="CALL sp_getProductos(?,?,?)";
		$parameters = array($idsub,$perpage,$start);

	    /*
	    $result = $this->db->query($query,$parameters);  

		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}*/

		$query = $this->db->query($sql, $parameters);

	    $result =  !$one  ? $query->result() : $query->row();
        return $result;		
    }

    public function sp_getBreadcrumbs($opcion,$url){	     
	    $sql="CALL sp_getBreadcrumbs(?,?)";
		$parameters = array($opcion,$url);

	    $result = $this->db->query($sql,$parameters);  

		//$rest  = $result->result();
		$rest  = $result->row();

		
		$result->next_result();
		$result->free_result();

		//if(count($rest) > 0) {
		//if($rest > 0 ){
		//if($result->num_rows > 0 ){
		if($result !== NULL) {   
			return $rest;
		} else {	
			return FALSE;
		}

		//$query = $this->db->query($sql, $parameters);

	    //$result =  !$one  ? $query->result() : $query->row();
	  //  $result =  $query->row();
       // return $result;		
    }


	
	public function sp_getCategoriasLimit($limit){	     
	    $query="CALL sp_getCategoriasLimit(?)";
	    $parameters=array($limit);
	    $result = $this->db->query($query,$parameters); 
		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();		
	   
	   // if(count($rest) > 0) {
	    //if($result->num_rows > 0 ){
	    if ($result !== NULL) {   
			return $rest;
		} else {	
			return FALSE;
		}	   
    }

	public function get_categorias_limit($limit){
        $this->db->select('c.*');
        $this->db->from('wsoft_categorias c');   
        $this->db->order_by('c.descripcion', 'asc');  
		$this->db->limit($limit);		
        $query = $this->db->get();		
	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;
    }

		
	public function get_marcas($idcategoria){
        $this->db->select('c.*');
        $this->db->from('wsoft_marcas c');   
		$this->db->where('idcategoria',$idcategoria);
        $this->db->order_by('c.descripcion', 'asc');      
        $query = $this->db->get();
	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;

    }
	public function sp_getMarcas($idcategoria){	     
	    $query="CALL sp_getMarcas(?)";
	    $parameters=array($idcategoria);
	    $result = $this->db->query($query,$parameters); 
		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();		
	   
	    if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	   
    }
	
	public function get_modelos($idmarca){

        $this->db->select('m.*');
        $this->db->from('wsoft_modelos m');   
		$this->db->where('idmarca',$idmarca);
        $this->db->order_by('m.descripcion', 'asc');      
        $query = $this->db->get();
	    if( $query->num_rows > 0 )
	      return $query->result();
	    else
	      return FALSE;

    }
	public function sp_getModelos($idmarca){	     
	    $query="CALL sp_getModelos(?)";
	    $parameters=array($idmarca);
	    $result = $this->db->query($query,$parameters); 
		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();		
	   
	    if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	   
    }

    public function count($table,$where) {
    	$this->db->from($table);  
    	$this->db->where('subcategoria_id',$where);
    	$query = $this->db->get();

    	//$query->num_rows();

        return $query->num_rows();
    }

/*
    public function count($table,$where) {    	
        return $this->db->count_all($table);
    }*/


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
