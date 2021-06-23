<?php
class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  public function login_userss($username,$password)
  {
    
    $this->db->where('login',$username);
    $this->db->where('senha',$password);
    $this->db->where('situacao',1);
    $this->db->limit(1);

    $query = $this->db->get('usuarios');
    
    if($query->num_rows() == 1)
    {
      return $query->row();
    }else{
      $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
      redirect(base_url().'login','refresh');
    }
  }

   public function login_user($username, $password) {
        
        $this->db->select('u.*, p.permisos');
        $this->db->from('wsoft_usuarios u');  
       // $this->db->join('wsoft_empleados e', 'e.id= u.id_empleado', 'inner');		
  		  $this->db->join('wsoft_permisos p', 'p.id= u.id_permiso', 'inner');
        $this->db->where('u.login', $username);
        $this->db->where('u.password', $password);
        //$this->db->where('u.estado', 1);
        $this->db->limit(1);       
        
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); 
      //return $query->row(); 
        } else {
            return false; 
      //$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
      //redirect(base_url().'login','refresh');
        }
    }


    public function changePassword($passw,$oldPassw,$id){

        $this->db->where('usuario_id', $id);
        $this->db->limit(1);
        $usuario = $this->db->get('crm_usuario')->row();

        if($usuario->contrasena != $oldPassw){
            return false;
        }
        else{
      $this->db->set('contrasena',$passw);
            $this->db->where('usuario_id',$id);
            return $this->db->update('crm_usuario');    
        }

        
    }
	
	public function forgot_password($email){        
        $this->db->select('u.id, u.login, u.password, u.nombres,u.apellidos,u.email');
        $this->db->from('wsoft_usuarios u');
 		$this->db->where('u.email', $email); 		
        $this->db->limit(1);          
        $query = $this->db->get();
        if($query->num_rows() == 1) {
           return $query->result();               
        } else {
            return false;  
        }
    }
   
    public function getVerifyCode($codigo){        
        $this->db->select('id');
        $this->db->from('wsoft_usuarios');        
        $this->db->where('forgot_pass_identity', $codigo);    
        $this->db->limit(1);          
        $query = $this->db->get();
        if($query->num_rows() == 1) {
           return $query->result();               
        } else {
            return false;  
        }
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