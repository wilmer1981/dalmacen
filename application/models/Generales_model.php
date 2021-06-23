<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * General_model class.
 * 
 * @extends CI_Model
 */
class Generales_model extends CI_Model {

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
	
	//Valñidar existencia de registro
    public function getValidationById($table,$fieldID,$ID){
      $this->db->from($table);
      $this->db->where($fieldID,$ID);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0){
               return TRUE;
        }else{
            return FALSE;
        }

    }

   
    public function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        //$this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getUbigeo($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('Nombre','asc');
        //$this->db->limit($perpage,$start);
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
    
    public function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
    		{
    			return TRUE;
    		}
    		
    		return FALSE;        
    }   
	
	public function count_all($table){
		return $this->db->count_all($table);
	}
	
	public function count($table,$where) {
    	$this->db->from($table);  
    	$this->db->where('subcategoria_id',$where);
    	$query = $this->db->get();

    	//$query->num_rows();

        return $query->num_rows();
    }

    public function count_products($opcion,$id) {
		if($opcion=="subcategoria"){
			$where='id_subcategoria="'.$id.'" AND estado=1 AND id_categoria is not null';	
		}
		if($opcion=="categoria"){
			$where='id_categoria="'.$id.'" AND estado=1';		
		}
		
    	$this->db->from('wsoft_productos');  
    	$this->db->where($where);
		//$this->db->from($table);  
		//$this->db->where($idcol,$where);
    	$query = $this->db->get();

        return $query->num_rows();
    }

    public function getByMaxId($table,$field){
        $this->db->select_max($field);
        $query= $this->db->get($table);
        if ($query->num_rows() > 0){
               return $query->row();
        }
            return null;
    }
}