<?php
class Articulos_model extends CI_Model {



  function __construct() {
        parent::__construct();
  }

  /*
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

*/

  public function count_all(){
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }   
  
  public function getArticulos($fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){             
      $this->db->select('a.*,c.nombre as tipo');
      $this->db->from('articulos a');
      $this->db->join('categorias c', 'c.id = a.id_categoria', 'inner');
     
      $this->db->limit($perpage,$start);
      if($where){
          $this->db->where($where);
      }
      
      $query = $this->db->get();
      
      $result =  !$one  ? $query->result() : $query->row();
      return $result;
  }

 



  public function AddEdit($table,$data,$fieldID,$ID){       
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

    public function getEstadisticasVentas($fecha){
        if($fecha==0){
        $sql = "SELECT SUM(CASE WHEN tipo_pago = 'CRE' THEN 1 ELSE 0 END) as total_credito, 
                       SUM(CASE WHEN tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_contado,
                       SUM(CASE WHEN tipo_pago = 'CRE' OR tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_ventas                        
          FROM ventas
         ";
       }else{
          $sql = "SELECT SUM(CASE WHEN tipo_pago = 'CRE' THEN 1 ELSE 0 END) as total_credito, 
                       SUM(CASE WHEN tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_contado,
                       SUM(CASE WHEN tipo_pago = 'CRE' OR tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_ventas                        
          FROM ventas
         WHERE fech_reg='".$fecha."'";
       }


        return $this->db->query($sql)->row();
    }



    public function getEstadisticasPedidos($fecha){
        if($fecha==0){
        $sql = "SELECT 
        -- SUM(CASE WHEN id_tipocomprobante = 'CRE' THEN 1 ELSE 0 END) as total_credito, 
                       -- SUM(CASE WHEN id_tipocomprobante tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_contado,
                       SUM(CASE WHEN id_tipocomprobante = 9 THEN 1 ELSE 0 END) as total_orden                        
          FROM pedidos
         ";
       }else{
          $sql = "SELECT 
          -- SUM(CASE WHEN tipo_pago = 'CRE' THEN 1 ELSE 0 END) as total_credito, 
                       -- SUM(CASE WHEN tipo_pago = 'CON' THEN 1 ELSE 0 END) as total_contado,
                       SUM(CASE WHEN id_tipocomprobante = 9 THEN 1 ELSE 0 END) as total_orden                       
          FROM pedidos
         WHERE fech_reg='".$fecha."'";
       }


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

    public function autoCompleteProducto($filtro){
    $sql="SELECT concat(p.codigo,' - ', p.nombre) AS label, 
            p.codigo, p.nombre, det.precio_compra,d.precio_venta, d.cantidad 
      FROM productos AS p 
      INNER JOIN productos_detalle AS d ON d.id_producto = p.id 
      WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";
    $query=$this->db->query($sql);
    return $query->result();
  }

  public function autoCorrelativo($filtro){
     $sql="SELECT LPAD(d.numero+1,5,0) as cantidad, t.id 
            FROM documentos d
            INNER JOIN pedidos_tipo as t on t.id =c.id_tipocomprobante
          WHERE c.id_tipocomprobante='".$filtro."'";
          
    $query=$this->db->query($sql);
    return $query->result();
  }
/*
  public function autoCorrelativoComprobante($filtro){
     $sql="SELECT LPAD(c.cantidad+1,5,0) as numero, t.serie
            FROM correlativos as c
            INNER JOIN documentos_tipo as t on t.id =c.id_tipocomprobante
          WHERE c.id_tipocomprobante='".$filtro."'";
          
    $query=$this->db->query($sql);
    return $query->result();
  }
*/
  public function autoCorrelativoComprobante($filtro){
     //$sql="SELECT LPAD(d.numero+1,5,0) as numero, d.serie
     $sql="SELECT LPAD(d.numero,5,0) as numero, d.serie
            FROM documentos as d  
          WHERE d.id='".$filtro."'";
          
    $query=$this->db->query($sql);
    return $query->result();
  }

   public function getCorrelativo($id){
        $this->db->select('*');
        $this->db->from('documentos'); 
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
  //////////////////////////////////////////////////////

  public function saveOrderPedido($arrarOrder){
      $this->db->trans_start();
      $this->db->insert('pedidos', $arrarOrder);
      $ids = $this->db->insert_id();
      $this->db->trans_complete();

      return $ids;
  }
  public function saveOrderDetalle($arrarOrder){
      $this->db->trans_start();
      $this->db->insert('pedidos_detalle', $arrarOrder);
      $this->db->trans_complete();
  }

  /////////////// VENTAS /////////////////
   public function saveOrderVenta($arrarOrder){
      $this->db->trans_start();
      $this->db->insert('ventas', $arrarOrder);
      $ids = $this->db->insert_id();
      $this->db->trans_complete();

      return $ids;
  }
  
  /////////////// PAGOS /////////////////
   public function saveOrderPago($arrarOrder){
      $this->db->trans_start();
      $this->db->insert('pedidos_pagos', $arrarOrder);
      $ids = $this->db->insert_id();
      $this->db->trans_complete();

      return $ids;
  }
  

  public function TraePedido($order){
    $sql="SELECT p.*, 
        IF(c.id_tipocliente='2', c.razon_social, CONCAT(c.nombres,' ',c.apellidos)) as cliente, 
        IF(c.id_tipocliente='2', CONCAT(o.nombres,' ',o.apellidos), CONCAT(c.nombres,' ',c.apellidos)) as contacto, 
      c.num_documento, c.direccion,c.telefono, d.documento as comprobante,u.nombre as zona, t.codigo as tipoprecio,
      v.serie_comprobante as seriefact,v.num_comprobante as numfact, CONCAT(e.nombres,' ',e.apellidos) as empleado         
            FROM pedidos as p  
                INNER JOIN clientes   as c on c.id=p.id_cliente 
                INNER JOIN ubigeos    as u on u.CodUbigeo=c.ubigeo 
                INNER JOIN documentos as d on d.id=p.id_tipocomprobante
                INNER JOIN pagos_tipo as t on t.id=p.id_dscto
                INNER JOIN usuarios   as z on z.id = p.id_usuario
                INNER JOIN empleados  as e on e.id = z.id_empleado
                LEFT  JOIN contactos  as o on o.id_tipocontacto=c.id
                LEFT  JOIN ventas     as v on v.id_pedido = p.id
      WHERE p.id = '".$order."'";
      $query=$this->db->query($sql);
      return $query->result();
  }

   public function getVentasss($fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){             
      $this->db->select('p.*,c.codigo,q.nombre as tipopedido, q.id as idtipopedido, t.id as idtraslado, v.id as idventa, d.documento as comprobante,v.serie_comprobante as seriefact,v.num_comprobante as numfact, v.id_tipocomprobante as idtipocomp, IF(c.id_tipocliente = "2", c.razon_social, CONCAT(c.nombres," ",c.apellidos)) as cliente', FALSE);
      $this->db->from('pedidos p');
      $this->db->join('pedidos_tipo q', 'q.id = p.id_tipopedido', 'inner');
      $this->db->join('clientes c', 'c.id = p.id_cliente', 'inner');      
      $this->db->join('traslados t', 't.id_pedido = p.id', 'left');
      $this->db->join('ventas v', 'v.id_pedido = p.id', 'inner');
      $this->db->join('documentos d', 'd.id = v.id_tipocomprobante', 'inner');
      $this->db->limit($perpage,$start);
      if($where){
        $this->db->where($where);
      }
        
      $query = $this->db->get();        
      $result =  !$one  ? $query->result() : $query->row();
      return $result;
  }

  public function TraePedidoDetalle($order){
      $sql="SELECT d.*, u.prefijo as unidad
      FROM pedidos_detalle as d
      INNER JOIN productos as p on p.codigo=d.cod_producto
      INNER JOIN unidades  as u on u.id    =p.id_unidad

      WHERE id_pedido = '".$order."'";
      $query=$this->db->query($sql);
      return $query->result();
  }

  public function TraeTraslado($order){
    $sql="SELECT t.*, q.num_placa,q.num_licencia,CONCAT(q.nombres,' ',q.apellidos) as transportista, q.num_documento           
            FROM traslados as t     
                INNER JOIN transportistas as q on q.id=t.id_transportista           
      WHERE t.id_pedido = '".$order."'";
      $query=$this->db->query($sql);
      return $query->result();
  }


  //Actualizar STOCK
  public function UpdateExistenciasProducto($codigo,$cantidad){
    $sql="UPDATE productos 
                SET stock= stock - '".$cantidad."' 
          WHERE codigo='".$codigo."'";
    $query=$this->db->query($sql);
    return True;
  }

  public function UpdateExistenciasProductossss($codigo,$cantidad){
    $sql="UPDATE productos_detalle 
                SET cantidad= cantidad - '".$cantidad."' 
          WHERE id_producto='".$codigo."'";
    $query=$this->db->query($sql);
    return True;
  }

  public function UpdateCorrelativoDoc($codigo,$cantidad){
    $sql="UPDATE productos_detalle 
                SET cantidad= cantidad - '".$cantidad."' 
          WHERE id_producto='".$codigo."'";
    $query=$this->db->query($sql);
    return True;
  }

  //Actualizar CORRELATIVO
  public function UpdateCorrelativo($tipopedido){
    $sql="UPDATE correlativos 
                SET cantidad= cantidad + 1 
          WHERE id_tipocomprobante='".$tipopedido."'";
    $query=$this->db->query($sql);
    return True;
  }

  //OKOKOKOKOK////////////////////
  public function UpdateNumeroDoc($iddoc){
    $sql="UPDATE documentos 
                SET numero= numero + 1 
          WHERE id='".$iddoc."'";
    $query=$this->db->query($sql);
    return True;
  }

  /////////////////////////////////////////////////////
  /////////// REPORTES ///////////////////////////////
  ///////////////////////////////////////////////////


       public function getPedidosReporte($fini = '', $ffin = '', $tipo = '', $perpage=0,$start=0,$one=false,$array='array'){
        if ($fini == "" && $ffin == "" && $tipo == ""){ 

          $this->db->select('p.*,c.codigo,t.nombre as tipopedido,
                          IF(c.id_tipocliente = "2", c.razon_social, CONCAT(c.nombres," ",c.apellidos)) as cliente', FALSE);
          $this->db->from('pedidos p');
          $this->db->join('pedidos_tipo t', 't.id = p.id_tipopedido', 'inner');
          $this->db->join('clientes c', 'c.id = p.id_cliente', 'inner');       
          $this->db->limit($perpage,$start);

         }else if ($fini != "" && $ffin != "" && $tipo == ""){

             $this->db->select('p.*,c.codigo,t.nombre as tipopedido,
                          IF(c.id_tipocliente = "2", c.razon_social, CONCAT(c.nombres," ",c.apellidos)) as cliente', FALSE);
          $this->db->from('pedidos p');
          $this->db->join('pedidos_tipo t', 't.id = p.id_tipopedido', 'inner');
          $this->db->join('clientes c', 'c.id = p.id_cliente', 'inner'); 
          $this->db->where("DATE_FORMAT(p.fech_reg,'%Y-%m-%d') BETWEEN '$fini' AND '$ffin'");       
          $this->db->limit($perpage,$start);

         }else if($fini != "" && $ffin != "" && $tipo != ""){

             $this->db->select('p.*,c.codigo,t.nombre as tipopedido,
                          IF(c.id_tipocliente = "2", c.razon_social, CONCAT(c.nombres," ",c.apellidos)) as cliente', FALSE);
          $this->db->from('pedidos p');
          $this->db->join('pedidos_tipo t', 't.id = p.id_tipopedido', 'inner');
          $this->db->join('clientes c', 'c.id = p.id_cliente', 'inner'); 
          $this->db->where("p.id_tipopedido='$tipo' AND DATE_FORMAT(p.fech_reg,'%Y-%m-%d') BETWEEN '$fini' AND '$ffin'");       
          $this->db->limit($perpage,$start);

         }
     
   
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }









}