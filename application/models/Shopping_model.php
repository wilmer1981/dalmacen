<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Shopping_model extends CI_Model {

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
	
 

    function get_products_count($st = NULL)
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


    function get_total_usuarios(){
    	//return $this->db->count_all('wsoft_usuarios');
    	$consulta = $this->db->get('wsoft_usuarios');
		return  $consulta->num_rows() ;
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
	
	public function getOrder($where='',$one=false,$array='array'){			
			$this->db->select("p.*, CONCAT(c.nombres,' ',c.apellidos) as cliente, c.nombres, c.apellidos, z.direccion,
							COUNT(d.cantidad) as cantidad, 
							SUM(d.precio_unit * d.cantidad) as total");
			$this->db->from('wsoft_pedidos p');
			$this->db->join('wsoft_pedidos_detalle d', 'd.id_pedido = p.id', 'inner');
			$this->db->join('wsoft_clientes c', 'c.id = p.id_cliente', 'inner');
			$this->db->join('wsoft_productos e', 'e.id = d.id_producto', 'inner');
			$this->db->join('wsoft_clientes_direcciones z', 'z.id = p.id_direccion', 'inner');
			$this->db->group_by('p.id');
					
		if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get();        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;      
    }
	
	public function getOrderDetail($where='',$one=false,$array='array'){			
			$this->db->select("p.*,e.nombre as producto, d.cantidad, d.precio_unit, c.nombres, c.apellidos");
			$this->db->from('wsoft_pedidos p');
			$this->db->join('wsoft_pedidos_detalle d', 'd.id_pedido = p.id', 'inner');
			$this->db->join('wsoft_clientes c', 'c.id = p.id_cliente', 'inner');
			$this->db->join('wsoft_productos e', 'e.id = d.id_producto', 'inner');
			
		if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;      
    }
	

	
}
