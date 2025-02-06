<?php 
require_once('includes/conexion.php');

class modelo{

	public $CNX1;
	public $CNX2;

	public function __construct(){
		$this->CNX1=conexion::mysql2();
		//$this->CNX2=conexion::sql();
	}

	
    public function validarUsuario($documento, $clave){
		$sql="SELECT documento,nombre FROM users WHERE documento='".$documento."' AND clave = '".$clave."'";
		$sql=$this->CNX1->prepare($sql);
		$sql->execute();
		$row=$sql->fetch();
		if ($sql->rowCount()==0) {
			$response=array(0);
		}else{
			$response = array(
				1,
				$row["documento"],
				$row["nombre"],
			);
		}
		//var_dump($response);
		return $response;
	}

		
    public function listarPacientes(){
        $sql="SELECT * FROM paciente";
        $sql=$this->CNX1->prepare($sql);
        $sql->execute();
        $row=$sql->fetchAll();
        if($sql->rowCount()==0)
        {
            $response=array("vacio");
        }
        else
        {
            $response=$row;
        }
        return $response;
    }

	public function tipoDocumento($id){
		$sql="SELECT nombre from tipos_documento where id='".$id."'";
		$sql=$this->CNX1->prepare($sql);
		$sql->execute();
		$row=$sql->fetch();
		if ($sql->rowCount()==0) {
			$response="Nulo";
		}else{
			$response=$row['nombre'];
		}
		//var_dump($response);
		return $response;
	}
	
	public function tipoGenero($id){
		$sql="SELECT nombre from genero where id='".$id."'";
		$sql=$this->CNX1->prepare($sql);
		$sql->execute();
		$row=$sql->fetch();
		if ($sql->rowCount()==0) {
			$response="Nulo";
		}else{
			$response=$row['nombre'];
		}
		//var_dump($response);
		return $response;
	}

	public function buscarDepartamento($id){
		$sql="SELECT nombre from departamentos where id='".$id."'";
		$sql=$this->CNX1->prepare($sql);
		$sql->execute();
		$row=$sql->fetch();
		if ($sql->rowCount()==0) {
			$response="Nulo";
		}else{
			$response=$row['nombre'];
		}
		//var_dump($response);
		return $response;
	}

	public function buscarMunicipio($id){
		$sql="SELECT nombre from municipios where id='".$id."'";
		$sql=$this->CNX1->prepare($sql);
		$sql->execute();
		$row=$sql->fetch();
		if ($sql->rowCount()==0) {
			$response="Nulo";
		}else{
			$response=$row['nombre'];
		}
		//var_dump($response);
		return $response;
	}

	public function listaTipoDocumento()
	{
		$sql = "SELECT id,nombre from tipos_documento";
		$sql = $this->CNX1->prepare($sql);
		$sql->execute();
		$row = $sql->fetchall();
		if ($sql->rowCount() == 0) {
			$response = array("vacio");
		} else {
			$response = $row;
		}
		return $response;
	}

	public function listaGenero()
	{
		$sql = "SELECT id,nombre from genero";
		$sql = $this->CNX1->prepare($sql);
		$sql->execute();
		$row = $sql->fetchall();
		if ($sql->rowCount() == 0) {
			$response = array("vacio");
		} else {
			$response = $row;
		}
		return $response;
	}

	public function ListaDepartamento()
	{
		$sql = "SELECT id,nombre from departamentos";
		$sql = $this->CNX1->prepare($sql);
		$sql->execute();
		$row = $sql->fetchall();
		if ($sql->rowCount() == 0) {
			$response = array("vacio");
		} else {
			$response = $row;
		}
		return $response;
	}

	public function cargaListaMunicipio($departamento_id)
	{
		$sql = "SELECT id, nombre FROM municipios WHERE departamento_id = :departamento_id";
		$query = $this->CNX1->prepare($sql);
		$query->bindParam(":departamento_id", $departamento_id, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
	
		return $result ?: [];
	}

	public function RegistrarPaciente($tipo_documento_id, $numero_documento, $nombre1, $nombre2, $apellido1,$apellido2,$genero_id,$departamento_id,$municipio_id)
	{
		try {
			$sql = "INSERT INTO paciente 
			(tipo_documento_id,numero_documento,nombre1,nombre2,apellido1,apellido2,genero_id,departamento_id,municipio_id) 
			Values 
			(:tipo_documento_id,:numero_documento,:nombre1,:nombre2,:apellido1,:apellido2,:genero_id,:departamento_id,:municipio_id)";
			$sql = $this->CNX1->prepare($sql);
			$sql->execute(array(
				':tipo_documento_id' => $tipo_documento_id,
				':numero_documento' => $numero_documento,
				':nombre1' => $nombre1,
				':nombre2' => $nombre2,
				':apellido1' => $apellido1,
				':apellido2' => $apellido2,
				':genero_id' => $genero_id,
				':departamento_id' => $departamento_id,
				':municipio_id' => $municipio_id,
			));
			return array(1);
		} catch (Exception $e) {
			return array(0, $e);
		}
	}

	public function validarTipDocumento($tipoDoc, $numeroDocumento) {
		$sql = "SELECT tipo_documento_id, numero_documento 
				FROM paciente 
				WHERE tipo_documento_id = :tipoDoc AND numero_documento = :numeroDocumento";
	
		$stmt = $this->CNX1->prepare($sql);

		$stmt->bindParam(':tipoDoc', $tipoDoc, PDO::PARAM_INT);
		$stmt->bindParam(':numeroDocumento', $numeroDocumento, PDO::PARAM_STR);

		$stmt->execute();
	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
		if (!$row) {
			return [0];
		} else {
			return [1, $row["tipo_documento_id"], $row["numero_documento"]];
		}
	}

	public function eliminarRegistroPaciente($id)
	{
		try {
			$sql = "DELETE FROM `paciente` WHERE `id` = '$id'";
			$sql = $this->CNX1->prepare($sql);
			$sql->execute();
			return array(1);
		} catch (Exception $e) {
			return array(0, $e);
		}
	}

	public function ActualizarRegistroPaciente($id, $tipo_documento_id, $numero_documento, $nombre1, $nombre2, $apellido1, $apellido2,$genero_id, $departamento_id, $municipio_id)
	{
		try {
			$sql = "UPDATE paciente SET 
			tipo_documento_id=:tipo_documento_id,
			numero_documento=:numero_documento,
			nombre1=:nombre1,
			nombre2=:nombre2,
			apellido1=:apellido1,
			apellido2=:apellido2,
			genero_id=:genero_id,
			departamento_id=:departamento_id,
			municipio_id=:municipio_id
			where id=:id";
			$sql = $this->CNX1->prepare($sql);
			$sql->execute(array(
				':id' => $id,
				':tipo_documento_id' => $tipo_documento_id,
				':numero_documento' => $numero_documento,
				':nombre1' => $nombre1,
				':nombre2' => $nombre2,
				':apellido1' => $apellido1,
				':apellido2' => $apellido2,
				':genero_id' => $genero_id,
				':departamento_id' => $departamento_id,
				':municipio_id' => $municipio_id,
			));
			//var_dump($sql);
			return array(1);
		} catch (Exception $e) {
			return array(0, "Error: " . $e->getMessage());
		}
	}


	public function TraerDatosRegistro($id)
	{
		$sql = "SELECT * FROM paciente where id='" . $id . "'";
		$sql = $this->CNX1->prepare($sql);
		$sql->execute();
		$row = $sql->fetch();
		if ($sql->rowCount() == 0) {
			$response = array(0);
		} else {
			$response = array(
				1,
				$row["tipo_documento_id"],
				$row["numero_documento"],
				$row["nombre1"],
				$row["nombre2"],
				$row["apellido1"],
				$row["apellido2"],
				$row["genero_id"],
				$row["departamento_id"],
				$row["municipio_id"]
			);
		}
		return $response;
	}

}
?>