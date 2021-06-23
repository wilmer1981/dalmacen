<?php
class Grifo_model extends CI_Model {

 //private $db_grifo;

  public function __construct() {
        parent::__construct();
		//$this->db_grifo = $this->load->database('grifo', TRUE); 
  }

  /*
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

*/
    public function getImportacionesMYSQL($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db_grifo->select('i.*, COUNT(d.id_import) as items, SUM(d.cantidad) as cant_total, SUM(d.total_dinero) as total');
        $this->db_grifo->from('importacion i');
		$this->db_grifo->join('importacion_detalle d', 'd.id_import = i.id', 'inner');
        $this->db_grifo->limit($perpage,$start);
        if($where){
            $this->db_grifo->where($where);
        }
		$this->db_grifo->group_by('d.id_import');
        
        $query = $this->db_grifo->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
    
    public function getImportaciones($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db_grifo->select('d.Id_Import, COUNT(d.Id_Import) as items, SUM(d.Cantidad) as cant_total, SUM(d.TotalDinero) as total');
        $this->db_grifo->from('Grifo_Import i');
		$this->db_grifo->join('Grifo_Surtidor01 d', 'd.Id_Import = i.Id', 'inner');
       // $this->db_grifo->limit($perpage,$start);
        if($where){
            $this->db_grifo->where($where);
        }
		$this->db_grifo->group_by('d.Id_Import');
        
        $query = $this->db_grifo->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	

    public function getImportacionesItems($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db_grifo->select('d.*, ');
        $this->db_grifo->from('importacion i');
		$this->db_grifo->join('importacion_detalle d', 'd.id_import = i.id', 'inner');
        $this->db_grifo->limit($perpage,$start);
        if($where){
            $this->db_grifo->where($where);
        }
		//$this->db_grifo->group_by('d.id_import');
        
        $query = $this->db_grifo->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }	

    public function getImportacionesItemsDetalle($where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db_grifo->select('d.*, ');
        $this->db_grifo->from('importacion i');
		$this->db_grifo->join('importacion_detalle d', 'd.id_import = i.id', 'inner');
        $this->db_grifo->limit($perpage,$start);
        if($where){
            $this->db_grifo->where($where);
        }
		//$this->db_grifo->group_by('d.id_import');
        
        $query = $this->db_grifo->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }		


    public function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db_grifo->select($fields);
        $this->db_grifo->from($table);
        $this->db_grifo->limit($perpage,$start);
        if($where){
            $this->db_grifo->where($where);
        }
        
        $query = $this->db_grifo->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db_grifo->from('crm_usuario');
        $this->db_grifo->select('crm_usuario.*, permisos.nombre as permiso');
        $this->db_grifo->join('permisos', 'permisos.id_permiso = crm_usuario.id_permiso', 'left');
        $this->db_grifo->where('usuario_id',$id);
        $this->db_grifo->limit(1);
        return $this->db_grifo->get()->row();
    }
    

    
    function add($table,$data){
        $this->db_grifo->insert($table, $data);         
        if ($this->db_grifo->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
	
	public function saveImportacion($table,$arrarData){
      $this->db_grifo->trans_start();
      $this->db_grifo->insert($table, $arrarData);
      $ids = $this->db_grifo->insert_id();
      $this->db_grifo->trans_complete();

      return $ids;
    }
	
	public function saveImportacionMYSQL($arrarData){
      $this->db_grifo->trans_start();
      $this->db_grifo->insert('importacion', $arrarData);
      $ids = $this->db_grifo->insert_id();
      $this->db_grifo->trans_complete();

      return $ids;
    }
  
    
    function edit($table,$data,$fieldID,$ID){
        $this->db_grifo->where($fieldID,$ID);
        $this->db_grifo->update($table, $data);

        if ($this->db_grifo->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db_grifo->where($fieldID,$ID);
        $this->db_grifo->delete($table);
        if ($this->db_grifo->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }   
	
	function count($table){
		return $this->db_grifo->count_all($table);
	}

    function getOsAbertas(){
        $this->db_grifo->select('os.*, clientes.nomeCliente');
        $this->db_grifo->from('os');
        $this->db_grifo->join('clientes', 'clientes.idClientes = os.clientes_id');
        $this->db_grifo->where('os.status','Abierto');
        $this->db_grifo->limit(10);
        return $this->db_grifo->get()->result();
    }

    function getProdutosMinimo(){

        $sql = "SELECT * FROM produtos WHERE estoque <= estoqueMinimo LIMIT 10"; 
        return $this->db_grifo->query($sql)->result();

    }

    function getOsEstatisticas(){
        $sql = "SELECT status, COUNT(status) as total FROM os GROUP BY status ORDER BY status";
        return $this->db_grifo->query($sql)->result();
    }

    public function getEstatisticasFinanceiro(){
        $sql = "SELECT SUM(CASE WHEN baixado = 1 AND tipo = 'receita' THEN valor END) as total_receita, 
                       SUM(CASE WHEN baixado = 1 AND tipo = 'despesa' THEN valor END) as total_despesa,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'receita' THEN valor END) as total_receita_pendente,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'despesa' THEN valor END) as total_despesa_pendente FROM lancamentos";
        return $this->db_grifo->query($sql)->row();
    }


    public function getEmitente()
    {
        return $this->db_grifo->get('emitente')->result();
    }

    public function addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email, $logo){
       
       $this->db_grifo->set('nome', $nome);
       $this->db_grifo->set('cnpj', $cnpj);
       $this->db_grifo->set('ie', $ie);
       $this->db_grifo->set('rua', $logradouro);
       $this->db_grifo->set('numero', $numero);
       $this->db_grifo->set('bairro', $bairro);
       $this->db_grifo->set('cidade', $cidade);
       $this->db_grifo->set('uf', $uf);
       $this->db_grifo->set('telefone', $telefone);
       $this->db_grifo->set('email', $email);
       $this->db_grifo->set('url_logo', $logo);
       return $this->db_grifo->insert('emitente');
    }


    public function editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email){
        
       $this->db_grifo->set('nome', $nome);
       $this->db_grifo->set('cnpj', $cnpj);
       $this->db_grifo->set('ie', $ie);
       $this->db_grifo->set('rua', $logradouro);
       $this->db_grifo->set('numero', $numero);
       $this->db_grifo->set('bairro', $bairro);
       $this->db_grifo->set('cidade', $cidade);
       $this->db_grifo->set('uf', $uf);
       $this->db_grifo->set('telefone', $telefone);
       $this->db_grifo->set('email', $email);
       $this->db_grifo->where('id', $id);
       return $this->db_grifo->update('emitente');
    }


    public function editLogo($id, $logo){
        
        $this->db_grifo->set('url_logo', $logo); 
        $this->db_grifo->where('id', $id);
        return $this->db_grifo->update('emitente'); 
         
    }
	
	 public function getByMaxId($table,$field){

    $this->db_grifo->select_max($field);
    $query= $this->db_grifo->get($table);
    //SELECT MAX(age) as age FROM tbl_user   
    if ($query->num_rows() > 0){
           return $query->row();
    }
        return null;
    }
	
	public function addData($data){   
      $codigo = $data['codigo'];
      $nombre = $data['nombre'];
      $unidad = $data['id_unidad'];
      $precio = $data['precio_venta'];

      $sql    = "SELECT codigo FROM productos WHERE codigo =$codigo LIMIT 1";
      $result = $this->db->query($sql); 
      $respuesta   = $result->row();
      $count_update=0;
      $count_insert=0;

      if(count($respuesta) > 0) {
        //return $rest;
        $sql1    = "UPDATE productos 
                    SET nombre='".$nombre."', id_unidad='".$unidad."', precio_venta='".$precio."',fech_act=now()
                    WHERE codigo = '".$codigo."' LIMIT 1";
        $this->db->query($sql1); 
        $count_update = $count_update + 1; 
        return $count_update;    

      }else{
         $sql1    = "INSERT INTO productos  (codigo, id_subcategoria, nombre, id_unidad, precio_venta) values ($codigo, 11, $nombre,$unidad, $precio)";
          $this->db->query($sql1); 

         // $id = LAST_INSERT_ID();
          $ids = $this->db->insert_id();

          $sql2   = "INSERT INTO productos_detalle (id_producto, codigo, id_marca) values ($id, $codigo, 21)";
          $this->db->query($sql2); 
         $count_insert = $count_insert + 0;
         return $count_insert ;  
      }

      //return FALSE;       
    }
	
	
	public function addProductoEdit($data){   
      $codigo = $data['codigo'];
      $nombre = $data['nombre'];
      $unidad = $data['id_unidad'];
      $precio = $data['precio_venta'];

      $sql    = "SELECT codigo FROM productos WHERE codigo =$codigo LIMIT 1";
      $result = $this->db->query($sql); 
      $respuesta   = $result->row();
      $count_update=0;
      $count_insert=0;

      if(count($respuesta) > 0) {
        //return $rest;
        $sql1    = "UPDATE productos 
                    SET nombre='".$nombre."', id_unidad='".$unidad."', precio_venta='".$precio."',fech_act=now()
                    WHERE codigo = '".$codigo."' LIMIT 1";
        $this->db->query($sql1); 
        $count_update = $count_update + 1; 
        return $count_update;    

      }else{
         $sql1    = "INSERT INTO productos  (codigo, id_subcategoria, nombre, id_unidad, precio_venta) values ($codigo, 11, $nombre,$unidad, $precio)";
          $this->db->query($sql1); 

         // $id = LAST_INSERT_ID();
          $ids = $this->db->insert_id();

          $sql2   = "INSERT INTO productos_detalle (id_producto, codigo, id_marca) values ($id, $codigo, 21)";
          $this->db->query($sql2); 
         $count_insert = $count_insert + 0;
         return $count_insert ;  
      }

      //return FALSE;       
    }
	
}