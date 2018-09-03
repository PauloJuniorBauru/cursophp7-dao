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

	# CARREGUE PELO ID
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