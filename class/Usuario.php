<?php  
class Usuario {
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	# GETTERS
	public function getIdusuario() { return $this->idusuario; }
	public function getDeslogin() { return $this->deslogin; }
	public function getDessenha() { return $this->dessenha; }
	public function getDtcadstro() { return $this->dtcadastro; }
	
	# SETTERS
	public function setIdusuario($value) {$this->idusuario = $value; }
	public function setDeslogin($value) { $this->deslogin = $value; }
	public function setDessenha($value) { $this->dessenha = $value; }
	public function setDtcadastro($value) { $this->dtcadastro = $value; }

	# CONSULTA USUÁRIO PELO ID
	public function loadById($id) {
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		if (count($result) > 0) {
			$row = $result[0];

			$this->setIdusuario($row["idusuario"]);
			$this->setDeslogin($row["deslogin"]);
			$this->setDessenha($row["dessenha"]);
			$this->setDtcadastro(new DateTime($row["dtcadastro"]));
		}
	}

	# CONSULTA TODOS OS USUÁRIOS
	public static function getList() {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	# CONSULTA QUALQUER USUÁRIO - DE ACORDO COM A REGRA "LIKE"
	public static function search($login) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(":SEARCH"=>"%$login%"));
	}

	# CONSULTA USUÁRIO ATRAVÉS DE AUTENTICAÇÃO
	public function login($login, $password) {
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", 
			array(":LOGIN"=>$login, ":PASSWORD"=>$password));

		if (count($result) > 0) {
			$row = $result[0];

			$this->setIdusuario($row["idusuario"]);
			$this->setDeslogin($row["deslogin"]);
			$this->setDessenha($row["dessenha"]);
			$this->setDtcadastro(new DateTime($row["dtcadastro"]));			
		}
		else 
			throw new Exception("Login e/ou Senha INVÁLIDOS!");			
	}

	# PARA STRING
	public function __toString() {
		return json_encode(array(
			"idusuario" => $this->getIdusuario(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadstro()->format("d/m/Y H:i:s")
		));
	}



}

?>