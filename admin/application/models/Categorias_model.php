<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model {

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

    public function getCategorias($table,$fields,$where='',$one=false,$array='array'){
       /* $query = "SELECT m.id, m.titulo,m.estado, m.orden,
              COUNT(IF(s.estado = '1',1,NULL)) as publicados,
                  COUNT(IF(s.estado = '0',1,NULL)) as despublicados
              FROM wsoft_menus as m
                LEFT JOIN wsoft_submenus AS s ON m.id=s.relacion
              WHERE m.relacion=$menutype
            GROUP BY m.id,m.titulo,m.estado
            ORDER BY m.orden ASC";    */

        /*
        $this->db->select('c.*, COUNT(IF(a.estado = "1",1,NULL)) as publicados, COUNT(IF(a.estado = "0",1,NULL)) as despublicados');
        $this->db->from('wsoft_productos_categorias c');
        $this->db->join('wsoft_productos a', 'a.id_categoria = c.id', 'left');
		*/
		
		$this->db->select('c.*');
        $this->db->from('wsoft_categorias c');
        
        if($where){
            $this->db->where($where);
        }
         $this->db->group_by('c.id');
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }



    public function getSubcategorias($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select('s.*, c.nombre as categoria');
        //$this->db->select('s.*, COUNT(IF(s.estado = "1",1,NULL)) as publicados, COUNT(IF(s.estado = "0",1,NULL)) as despublicados');
        $this->db->from('subcategorias s');
        $this->db->join('categorias c', 'c.id=s.id_categoria', 'inner');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
       
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

   /* function getById($id){
        $this->db->from('crm_usuario');
        $this->db->select('crm_usuario.*, permisos.nombre as permiso');
        $this->db->join('permisos', 'permisos.id_permiso = crm_usuario.id_permiso', 'left');
        $this->db->where('usuario_id',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }*/

     function getById($table,$id){
        $this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get($table)->row();
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

         //buscando servi??os
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
}