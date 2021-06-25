<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Productos_model extends CI_Model {

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

	
	public function sp_getProductsLatest($one=false,$array='array'){	 
	
		$sql="CALL sp_getProductsLatest()";
		$parameters = array();
		
	    $result = $this->db->query($sql,$parameters);  

		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	  
    }

    public function sp_getProductsOffert($one=false,$array='array'){	 
	
		$sql="CALL sp_getProductsOffert()";
		$parameters = array();
		
	    $result = $this->db->query($sql,$parameters);  

		$rest = $result->result();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}	  
    }




    public function sp_getProductosFile($opcion='', $id=''){

      	$results = array();
      	if($opcion=='features'){
	      
			 $this->db->select('p.id as product_id, a.url as url_file');
	        $this->db->from('wsoft_productos p');
	        $this->db->join('wsoft_archivos a', 'a.producto_id = p.id and a.estado=1','LEFT');
	        $this->db->where('p.destacado', 'S');
			
      	}else if($opcion=='producto'){
	        $this->db->select('p.id as product_id, a.url as url_file');
	        $this->db->from('wsoft_productos p');
	        $this->db->join('wsoft_archivos a', 'a.producto_id = p.id and a.estado=1','LEFT');
	        $this->db->where('p.id', $id);
		}else{ //subcategoria
	        $this->db->select('p.id as product_id, a.url as url_file');
	        $this->db->from('wsoft_productos p');
	        $this->db->join('wsoft_archivos a', 'a.producto_id = p.id and a.estado=1','LEFT');
	        $this->db->where('p.subcategoria_id', $id); 
      	}
    	$query = $this->db->get();  
    
        if($query->num_rows() > 0) {
          $results = $query->result();
        }else{
          $results = $query->row();
        }
        return $results;  
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
	
	public function sp_getCategoriasLimit($limit){	     
	    $query="CALL sp_getCategoriasLimit(?)";
	    $parameters=array($limit);
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

    public function sp_getProductsFeatures(){	     
	    $query="CALL sp_getProductsFeatures()";
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

    public function sp_getProductoFeatures(){	     
	    $query="CALL sp_getProductsFeatures()";
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

    //Listar productos de la subcategoria
    public function sp_getProductosLis($opcion,$id,$idpad,$perpage=0,$start=0,$one=false,$array='array'){
		
		if($opcion=="subcategoria"){
			//$where='p.id_subcategoria="'.$id.'"  AND p.estado=1';
			$where='(p.id_subcategoria="'.$id.'" OR p.id_categoria="'.$idpad.'") AND p.estado=1';	
		}
		if($opcion=="categoria"){
			$where='p.id_categoria="'.$id.'" AND p.estado=1';		
		}
    	$results = array();   
    	$this->db->select('p.*, c.titulo as categoria, d.precio as precio_oferta, 
    		                    IF(d.estado = "1", 1,0) as oferta',FALSE);
    	$this->db->from('wsoft_productos p');
    	$this->db->join('wsoft_categorias c', 'c.id = p.id_categoria');
    	$this->db->join('wsoft_productos_descuentos d', 'd.id_producto = p.id', 'left');
		$this->db->join('wsoft_productos_images i', 'i.id_producto = p.id AND i.estado=1','LEFT');
    
    	$this->db->where($where);
     	$this->db->order_by('p.orden', 'asc');  
     	$this->db->group_by('p.id'); 
     	$this->db->limit($perpage,$start);

    	$query = $this->db->get();

    	$result =  !$one  ? $query->result() : $query->row();
        return $result;


       /* if($query->num_rows() > 0) {
        	$results = $query->result();
      	}
      	return $results;  */
    }  

     public function sp_getCategoriasList($opcion,$id,$one=false,$array='array'){
		
		if($opcion=="subcategoria"){
			$where='c.id_categoria="'.$id.'" AND c.estado=1';	
		}
		if($opcion=="categoria"){
			$where='c.id_categoria="'.$id.'" AND c.estado=1';		
		}
    	$results = array();   
    	$this->db->select('c.*');
    	$this->db->from('wsoft_categorias c');
        
    	$this->db->where($where);
     	$this->db->order_by('c.orden', 'asc');  
       
    	$query = $this->db->get();

    	$result =  !$one  ? $query->result() : $query->row();
        return $result;


       /* if($query->num_rows() > 0) {
        	$results = $query->result();
      	}
      	return $results;  */
    }  

    public function sp_getProductos($urlcat,$one=false,$array='array'){	     
	    $query="CALL sp_getProductos(?)";
		$parameters = array($urlcat);	
	    $result     = $this->db->query($query,$parameters); 
		$rest       = $result->result();
		
		$result->next_result();
		$result->free_result();

		if(count($rest) > 0) {
			return $rest;
		} else {	
			return FALSE;
		}

/*
		$query = $this->db->query($sql, $parameters);

	    $result =  !$one  ? $query->result() : $query->row();
        return $result;		
		*/
    }
	
	//busqueda de productos 
	public function get_products($limit, $start, $st = NULL)
    {
        if ($st == "NIL") $st = "";

        $results = array();  

		$this->db->select('p.*, c.titulo as categoria');
    	$this->db->from('wsoft_productos p');
    	$this->db->join('wsoft_categorias c', 'c.id = p.id_categoria');
		$this->db->join('wsoft_productos_images i', 'i.id_producto = p.id AND i.estado=1','LEFT');
  	
     	//$this->db->where('p.nombre',$st);
       	//$this->db->like('p.nombre', $st, 'both');
		$trozos=explode(" ",$st); 
		$numero=count($trozos); 
		if ($numero==1) { 
			$this->db->like('p.nombre', $st, 'both');	//productos
			$this->db->or_like('c.titulo', $st, 'both'); //categorias
			//$this->db->where('p.nombre LIKE', '%'.$st.'%');
			//$this->db->or_where('c.titulo LIKE', '%'.$st.'%');
		}else{
		  $this->db->where("MATCH(p.nombre)AGAINST('".$st."')", NULL, FALSE);  // solo funciona con tablas tipo MyIsam
		  $this->db->or_where("MATCH(c.titulo)AGAINST('".$st."')", NULL, FALSE);  
		}

	
     	$this->db->order_by('p.orden', 'asc');  
     	$this->db->group_by('p.nombre'); 		
	
     	//$this->db->group_by('p.id'); 
		
     	//$this->db->limit($limit,$start);
  
    	$query = $this->db->get();

        if($query->num_rows() > 0) {
        	$results = $query->result();
      	}
      	return $results;  
    }	 

	public function sp_getProducts($perpage=0,$start=0,$one=false,$array='array')
    {
        $results = array();   
    	$this->db->select('p.id as producto_id, c.id as categoria_id, p.subcategoria_id, p.nombre,p.descripcion, i.url_img, d.izaje, d.capacidad, d.velocidad, d.potencia,d.medidas,d.peso,d.longitud,d.certificacion,d.cruptura,d.omedidas, m.titulo as modelo, n.titulo as marca, a.url as url_file');
    	$this->db->from('wsoft_subcategorias s');
    	$this->db->join('wsoft_categorias c', 'c.id = s.categoria_id');
    	$this->db->join('wsoft_productos p', 'p.subcategoria_id = s.id and p.estado=1');
    	$this->db->join('wsoft_productos_detalle d', 'd.producto_id = p.id','LEFT');
    	$this->db->join('wsoft_modelos m', 'm.id = d.modelo_id','LEFT');
    	$this->db->join('wsoft_marcas n', 'n.id = d.marca_id','LEFT');
    	$this->db->join('wsoft_imagenes i', 'i.producto_id = p.id and i.estado=1','LEFT');
    	$this->db->join('wsoft_archivos a', 'a.producto_id = p.id and a.estado=1','LEFT');     
		
     	$this->db->order_by('p.orden', 'asc');  
     	$this->db->group_by('p.id'); 
     	$this->db->limit($perpage,$start);
  
    	$query = $this->db->get();

        if($query->num_rows() > 0) {
        	$results = $query->result();
      	}
      	return $results;  
    }

    public function get_products_count($st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "SELECT * FROM wsoft_productos WHERE nombre LIKE '%$st%'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	
    public function count($table){
    	//return $this->db->count_all('wsoft_usuarios');
    	$consulta = $this->db->get($table);
		return  $consulta->num_rows() ;
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
	
	public function getExistCustomer($ruc){
	     
	   $this->db->select('id');       
        $this->db->from('wsoft_clientes'); 
        $this->db->where('ruc',$ruc);
    
       /* $query = $this->db->get();
	
	    if( $query->num_rows > 0 )
			return $query->result();
	    else
	      return FALSE;*/
	  
	  return $this->db->get()->row();
    }

	  // Insert customer details in "customer" table in database.
	public function insert_customer($data)
	{
		$this->db->insert('wsoft_clientes', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
        // Insert order date with customer id in "orders" table in database.
	public function insert_order($data)
	{
		$this->db->insert('wsoft_pedidos', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
        // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('wsoft_pedidos_detalle', $data);
	}
		
	public function sp_getProducto($where='',$one=false,$array='array'){	
        //$data=array();     
	  	//$this->db->select('p.*, c.titulo as categoria, m.titulo as marca,o.opcion,o.opciones');
	  	$this->db->select('p.*,c.titulo as categoria, d.precio as precio_oferta,  IF(d.estado = "1", 1,0) as oferta',FALSE);
        $this->db->from('wsoft_productos p');
        $this->db->join('wsoft_categorias c', 'c.id = p.id_subcategoria', 'inner');
		$this->db->join('wsoft_productos_images i', 'i.id_producto = p.id', 'left');
		$this->db->join('wsoft_productos_descuentos d', 'd.id_producto = p.id', 'left');
		$this->db->join('wsoft_productos_opciones o', 'o.id_producto = p.id', 'left');
		$this->db->join('wsoft_marcas m', 'm.id = p.id_marca', 'left');
		$this->db->limit(1);

		if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;


 
    }
	
	 public function sp_getProductoImages($where='',$one=false,$array='array'){	
      	$this->db->select('i.*');
     	$this->db->from('wsoft_productos p');
     	$this->db->join('wsoft_productos_images i', 'i.id_producto = p.id', 'inner');
        $this->db->order_by('i.sort_order', 'asc');		
		if($where){
            $this->db->where($where);
        }    	
        $query = $this->db->get();        
        $result =  !$one  ? $query->result() : $query->row();
        
        return $result;	
      	 
    }
	

	
}
