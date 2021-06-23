<?php
class Clientes_model extends CI_Model {



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


  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }




  public function getClientes($where='',$perpage=0,$start=0,$one=false,$array='array'){

      $this->db->select('c.*, u.CodDpto, u.CodProv, u.CodUbigeo,  
          IF(c.id_tipocliente = "1", c.nombres, c.razon_social) as cliente_nombre', FALSE);
        $this->db->from('clientes c');
        $this->db->join('ubigeos u', 'u.CodUbigeo = c.ubigeo', 'inner');

        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    //consultamos cleionte por su ID
  public function getClienteById($id){
        
        $this->db->select('c.*, u.CodDpto, u.CodProv, u.CodUbigeo, e.nombres as cont_nombre, e.apellidos as cont_apellido, e.telefono as cont_telefono, e.celular as cont_celular, e.email as cont_email, 
          IF(c.id_tipocliente = "1", c.nombres, c.razon_social) as cliente_nombre', FALSE);
        $this->db->from('clientes c');
        $this->db->join('contactos e', 'e.id_tipocontacto = c.id and e.tipo_contacto="C"', 'left');
        $this->db->join('ubigeos u', 'u.CodUbigeo = c.ubigeo', 'inner');
       // $this->db->join('estado e', 'e.id = p.id_estado', 'inner');
        $this->db->where('c.id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

      public function getClienteByIds($id){
        
        $this->db->select('c.*, u.CodDpto, u.CodProv, u.CodUbigeo, u.Nombre as distrito, 
                       IF(c.id_tipocliente = "1", c.nombres, c.razon_social) as cliente_nombre', FALSE);
        $this->db->from('clientes c');
        //$this->db->join('contactos e', 'e.id_tipocontacto = c.id and e.tipo_contacto="C"', 'inner');
        $this->db->join('ubigeos u', 'u.CodUbigeo = c.ubigeo', 'inner');
       // $this->db->join('estado e', 'e.id = p.id_estado', 'inner');
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
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

    function getById($id){
        $this->db->from('crm_usuario');
        $this->db->select('crm_usuario.*, permisos.nombre as permiso');
        $this->db->join('permisos', 'permisos.id_permiso = crm_usuario.id_permiso', 'left');
        $this->db->where('usuario_id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
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
    public function get_products_count($st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "select * from products where product_name like '%$st%'";
        $query = $this->db->query($sql);
        return $query->num_rows();
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
                       SUM(CASE WHEN baixado = 0 AND tipo = 'despesa' THEN valor END) as total_despesa_pendente 
					   FROM lancamentos";
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


     public function getMaxId($table,$field){

        $this->db->select_max($field);
        $query= $this->db->get($table);
        //SELECT MAX(age) as age FROM tbl_user   
        if ($query->num_rows() > 0){
               return $query->row();
        }
        return null;
    }

    public function busquedaCliente($filtro){
    //CONCAT_WS (  ' ', NOMBRE, APELLIDO1, APELLIDO2 )
   //$sql="SELECT CONCAT_WS(' ',p.codigo,p.nombre,d.modelo, m.nombre) AS label, 
       //  WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";
      $sql="SELECT CONCAT_WS(' ',p.nombres,p.apellidos) AS label, 
              p.codigo as codigocliente, CONCAT_WS(' ',p.nombres,p.apellidos) as nombre, p.direccion, p.id as idcliente
           FROM clientes AS p            
           WHERE p.codigo LIKE '%".$filtro."%'";

      $query=$this->db->query($sql);
      return $query->result();
    }

    public function busquedaClienteNumDoc($filtro){
    //CONCAT_WS (  ' ', NOMBRE, APELLIDO1, APELLIDO2 )
   //$sql="SELECT CONCAT_WS(' ',p.codigo,p.nombre,d.modelo, m.nombre) AS label, 
       //  WHERE (p.nombre LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";

      $sql="SELECT IF(c.id_tipocliente='1', CONCAT_WS(' ',c.nombres,c.apellidos), c.razon_social) AS label, 
              c.codigo as codigocliente, IF(c.id_tipocliente='1', CONCAT_WS(' ',c.nombres,c.apellidos), c.razon_social) as nombre, 
              c.direccion, c.id as idcliente, c.num_documento
           FROM clientes AS c           
           WHERE c.num_documento LIKE '%".$filtro."%'";

      $query=$this->db->query($sql);
      return $query->result();
    }


}