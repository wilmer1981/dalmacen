<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_model extends CI_Model {


  public function __construct() {
        parent::__construct();
  }
  

  /*
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

*/



  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

    
    public function getAll($fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select('p.*, s.nombre as subcategoria, c.nombre as categoria');
        $this->db->from('productos p');
        $this->db->join('subcategorias s', 's.id = p.id_subcategoria', 'inner');
        $this->db->join('categorias c', 'c.id = s.id_categoria', 'inner');
       // $this->db->join('ingresos_detalle i', 'i.cod_articulo = p.codigo', 'inner');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenus($where='',$one=false,$array='array'){
        $this->db->select('t.id, t.titulo, t.estado, t.descripcion, t.alias,
					COUNT(IF(m.estado = "1",1,NULL)) as publicados,
       				COUNT(IF(m.estado = "0",1,NULL)) as despublicados'
					);
    	$this->db->from('wsoft_menus_tipo t'); 
		$this->db->join('wsoft_menus m', 'm.id_tipo = t.id', 'left'); 
		if($where){
            $this->db->where($where);
        }
		$this->db->group_by('t.id,t.titulo,t.estado');	      
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenusItems($where='',$one=false,$array='array'){
        $this->db->select('m.*, t.titulo as menu');
    	$this->db->from('wsoft_menus m');
        $this->db->join('wsoft_menus_tipo t', 't.id = m.id_tipo', 'left'); 
		if($where){
            $this->db->where($where);
        }		
       
        //$this->db->group_by('m.id_tipo');
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenus_OK($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
         $this->db->select('t.*, 
				         COUNT(CASE WHEN m.estado = 1 THEN 1 END) as publicados, 
						 COUNT(CASE WHEN m.estado = 0 THEN 1 END) as despublicados');
    	$this->db->from('menus_tipo t');
        $this->db->join('menus m', 'm.id_tipo = t.id', 'left');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        $this->db->group_by('m.id_tipo');
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenusTipo($one=false,$array='array'){
   		$sql = "SELECT t.id, t.titulo, t.estado, t.descripcion,
      				COUNT(IF(m.estado = '1',1,NULL)) as publicados,
       				COUNT(IF(m.estado = '0',1,NULL)) as despublicados
				FROM wsoft_menus_tipo AS t
					LEFT JOIN wsoft_menus AS m ON m.id_tipo=t.id
				GROUP BY t.id,t.titulo,t.estado
			    ";			
		$query = $this->db->query($sql);        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenuItems($table,$fields,$where,$perpage=0,$start=0,$one=false,$array='array'){
      
			$sql = "SELECT m.id, m.titulo, m.estado,
				
					FROM wsoft_menus AS m  WHERE m.id_tipo=$where
					GROUP BY m.id,m.titulo,m.estado
					";		

		 
		$query = $this->db->query($sql);        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getMenuItemsub($table,$fields,$where,$perpage=0,$start=0,$one=false,$array='array'){
   
			$sql = "SELECT i.*			
					FROM menus_items as i
					WHERE i.id_menu=$where
					";		
	
		 
		$query = $this->db->query($sql);        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function getMenuItemsId($table,$fields,$where,$perpage=0,$start=0,$one=false,$array='array'){
   
      $sql = "SELECT m.*, a.titulo as articulo, a.alias as aliasarticulo
              FROM menus AS m
               LEFT JOIN articulos AS a ON a.id=m.id_contenido
              WHERE m.id=$where
            ";
     
        $query = $this->db->query($sql);        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function getMenuId($where='',$one=false,$array='array'){
                  
        $this->db->select('m.*, a.titulo as articulo, a.alias as aliasarticulo');
        $this->db->from('menus as m'); 
        $this->db->join('articulos as a','a.id=m.id_contenido','left');    
        if($where){
            $this->db->where($where);
        }     
    
        $query = $this->db->get();    

	      
		$result =  !$one  ? $query->result() : $query->row();
        return $result;
    }




	public function getMenuTipoId($where){

             
        $this->db->select('*');
        $this->db->from('menus_tipo'); 		
        if($where){
            $this->db->where($where);
        }     
		
        $query = $this->db->get();        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function getById($id){
        $this->db->select('p.*, p.id_unidad, s.nombre as subcategoria, c.id as id_categoria,c.nombre as categoria, d.id_marca, d.modelo, d.pasos,d.peso,d.presentacion,m.nombre as marca');
        $this->db->from('productos p');
        $this->db->join('productos_detalle d', 'd.id_producto = p.id', 'left');
        $this->db->join('subcategorias s', 's.id = p.id_subcategoria', 'inner');
        $this->db->join('categorias c', 'c.id = s.id_categoria', 'inner');
        $this->db->join('marcas m', 'm.id = d.id_marca', 'left');
        $this->db->join('unidades u', 'u.id = p.id_unidad', 'left');
        $this->db->where('p.id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }


    public function getProductosReporte($categoria, $perpage=0,$start=0,$one=false,$array='array'){

              

        if ($categoria == ""){   

              $this->db->select('p.*, s.nombre as subcategoria, c.nombre as categoria');
              $this->db->from('productos p');
              $this->db->join('subcategorias s', 's.id = p.id_subcategoria', 'inner');
              $this->db->join('categorias c', 'c.id = s.id_categoria', 'inner');    
     

         }else{

             // $array = array('c.id' => $categoria);   
              $this->db->select('p.*, s.nombre as subcategoria, c.nombre as categoria');
              $this->db->from('productos p');
              $this->db->join('subcategorias s', 's.id = p.id_subcategoria', 'inner');
              $this->db->join('categorias c', 'c.id = s.id_categoria', 'inner');
              $this->db->where('c.id',$categoria);       

        }

       $this->db->limit($perpage,$start);     
      
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }




    function pesquisar($termo){
         $data = array();
         // buscando clientes
         $this->db->like('cliente',$termo);
         $this->db->limit(5);
         $data['clientes'] = $this->db->get('cliente')->result();

         // buscando os
         $this->db->like('idOs',$termo);
         $this->db->limit(5);
         $data['os'] = $this->db->get('os')->result();

         // buscando produtos
         $this->db->like('descricao',$termo);
         $this->db->limit(5);
         $data['produtos'] = $this->db->get('produtos')->result();

         //buscando serviços
         $this->db->like('nome',$termo);
         $this->db->limit(5);
         $data['servicos'] = $this->db->get('servicos')->result();

         return $data;


    }

    
    function add($table,$data){
        $this->db->insert($table, $data);         
    
    if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
    		{
    			return TRUE;
    		}
    		
    		return FALSE;       
    }

    function AddEdit($table,$data,$fieldID,$ID){
       
        $result = $this->getValidationById($table,$fieldID,$ID);

        //si existe detalle_producto
        if($result==TRUE){
            $this->db->where($fieldID,$ID);
            $this->db->update($table, $data);
        }else{
            $this->db->insert($table, $data);  
        }       

        if ($this->db->affected_rows() >= 0)
        {
          return TRUE;
        }
        
        return FALSE;       
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

    public function sp_addProductoEdit($data){   
      $sql = "CALL sp_addProductoEdit(?,?,?,?, @p_count_insert, @p_count_update)"; 
      $parameters = array($data['codigo'],$data['nombre'],$data['id_unidad'],$data['precio_venta']);
      $result = $this->db->query($sql, $parameters); 
      //$rest = $result->result();
      $rest = $result->row();

      $result->next_result();
      $result->free_result();   

     // $query=$this->db->query($sql);
     // return $query->result();    

      /*  if ($this->db->affected_rows() == '1'){
        //return TRUE;     
        return $result->result();
      }   */
      if(count($rest) > 0) {
        return $rest;
      }
      return FALSE;       
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



       public function sp_addProductoEditsssss($data){   
      $sql = "CALL sp_addProductoEdit(?,?,?,?,@tupdate,@tinsert)";
      $parameters = array($data['codigo'],$data['nombre'],$data['id_unidad'],$data['precio_venta']);
      $result = $this->db->query($sql, $parameters);        
      if ($this->db->affected_rows() == '1'){
        //return TRUE;
        return $result->result_object();
        //return $result->result();
      }   
    return FALSE;       
    }


    //verifica si existe registro
    function getValidationById($table,$fieldID,$ID){
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

    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
    if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }   
	
	function count($table){
		return $this->db->count_all($table);
	}

    function getOsAbertas(){
        $this->db->select('os.*, clientes.nomeCliente');
        $this->db->from('os');
        $this->db->join('clientes', 'clientes.idClientes = os.clientes_id');
        $this->db->where('os.status','Abierto');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    function getProdutosMinimo(){

        $sql = "SELECT * FROM produtos WHERE estoque <= estoqueMinimo LIMIT 10"; 
        return $this->db->query($sql)->result();

    }

    function getOsEstatisticas(){
        $sql = "SELECT status, COUNT(status) as total FROM os GROUP BY status ORDER BY status";
        return $this->db->query($sql)->result();
    }

    public function getEstatisticasFinanceiro(){
        $sql = "SELECT SUM(CASE WHEN baixado = 1 AND tipo = 'receita' THEN valor END) as total_receita, 
                       SUM(CASE WHEN baixado = 1 AND tipo = 'despesa' THEN valor END) as total_despesa,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'receita' THEN valor END) as total_receita_pendente,
                       SUM(CASE WHEN baixado = 0 AND tipo = 'despesa' THEN valor END) as total_despesa_pendente FROM lancamentos";
        return $this->db->query($sql)->row();
    }


    public function getEmitente()
    {
        return $this->db->get('emitente')->result();
    }

    public function addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email, $logo){
       
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('email', $email);
       $this->db->set('url_logo', $logo);
       return $this->db->insert('emitente');
    }


    public function editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$email){
        
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('email', $email);
       $this->db->where('id', $id);
       return $this->db->update('emitente');
    }


    public function editLogo($id, $logo){
        
        $this->db->set('url_logo', $logo); 
        $this->db->where('id', $id);
        return $this->db->update('emitente'); 
         
    }

    public function getByMaxId($table,$field){

    $this->db->select_max($field);
    $query= $this->db->get($table);
    //SELECT MAX(age) as age FROM tbl_user   
    if ($query->num_rows() > 0){
           return $query->row();
    }
        return null;
    }

  public function autoCompleteProductos($q){
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nombre', $q);
        $query = $this->db->get('productos');

        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['descripcion'].' | Precio: S/. '.$row['precoVenda'].' | Stock: '.$row['estoque'],'estoque'=>$row['estoque'],'id'=>$row['idProdutos'],'preco'=>$row['precoVenda']);
            }
            echo json_encode($row_set);
        }
  }

//autocompletar productos para venta o compra
  public function autoCompleteProductssssso($filtro){
      $sql="SELECT concat(p.codigo,' - ', p.nombre) AS label, 
              p.codigo as codigoproducto, p.nombre, d.precio_compra, d.precio_venta, d.cantidad as cantidad 
        FROM productos AS p 
        INNER JOIN productos_detalle AS d ON d.cod_articulo = p.codigo 
        WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";
      $query=$this->db->query($sql);
      return $query->result();
  }
  
  public function autoCompleteProducto($filtro){
                   //CONCAT_WS(' ', NOMBRE, APELLIDO1, APELLIDO2 )
      $sql = "SELECT CONCAT_WS(' ',p.codigo,p.nombre) AS label, 
              p.codigo as codigoproducto, CONCAT_WS(' ',p.nombre) as nombre, p.precio_compra, p.precio_venta, p.stock
            FROM productos AS p   
            INNER JOIN productos_detalle as d on d.codigo=p.codigo 
            INNER JOIN marcas as m on m.id=d.id_marca         
            WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";

      $query=$this->db->query($sql);
      return $query->result();
  }

  public function autoCompleteProductoD($filtro,$tipo){
    //CONCAT_WS (  ' ', NOMBRE, APELLIDO1, APELLIDO2 )
   
      $sql="SELECT CONCAT_WS(' ',p.codigo,p.nombre,d.modelo, m.nombre) AS label, 
              p.codigo as codigoproducto, CONCAT_WS(' ',p.nombre,d.modelo, m.nombre) as nombre, p.precio_compra, p.precio_venta, p.stock, CONCAT_WS(' ',z.dscto1,z.dscto2,z.dscto3) as descuento
           FROM productos AS p   
           INNER JOIN productos_detalle   as d on d.codigo=p.codigo      
           INNER JOIN pagos_tipo          as z on z.id=$tipo 
           INNER JOIN marcas              as m on m.id=d.id_marca          
        WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";
      $query=$this->db->query($sql);
      return $query->result();
    }

  //busqueda por codigo del producto
    public function busquedaProductoD($filtro,$tipo){

      if($tipo!=""){

      $sql="SELECT CONCAT_WS(' ',p.codigo,p.nombre) AS label, 
              p.codigo as codigoproducto, CONCAT_WS(' ',p.nombre) as nombre, p.precio_compra, p.precio_venta, p.stock, CONCAT_WS(' ',z.dscto1,z.dscto2,z.dscto3) as descuento, u.nombre as unidad, m.nombre as marca
           FROM productos AS p   
           INNER JOIN productos_detalle   as d on d.codigo=p.codigo 
           INNER JOIN unidades            as u on u.id=p.id_unidad      
           INNER JOIN pagos_tipo          as z on z.id=$tipo 
           INNER JOIN marcas              as m on m.id=d.id_marca          
        WHERE p.codigo=".$filtro;
      }else{

      $sql="SELECT CONCAT_WS(' ',p.codigo,p.nombre) AS label, 
            p.codigo as codigoproducto, CONCAT_WS(' ',p.nombre) as nombre, p.precio_compra, p.precio_venta, p.stock, u.nombre as unidad, m.nombre as marca
           FROM productos AS p   
           INNER JOIN productos_detalle   as d on d.codigo=p.codigo 
           INNER JOIN unidades            as u on u.id=p.id_unidad    
           INNER JOIN marcas              as m on m.id=d.id_marca          
        WHERE p.codigo=".$filtro;

      }
      $query=$this->db->query($sql);
      return $query->result();
    }



    public function comprobarExistencia($codigo){
      $sql="SELECT codigo 
           FROM productos AS p            
        WHERE codigo='".$codigo."'";

      $query=$this->db->query($sql);

       if ($query->num_rows() > 0){
           return true;
      }else{
         return false;
      }

      //return $query->result();
    }


}