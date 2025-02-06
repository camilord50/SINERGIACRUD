<?php 
require_once('modelo.php');

class controller{

	public $MODEL;

	public function __construct(){
		$this->MODEL=new modelo();
	}

	
	public function validarUsuario()
	{
		session_start(); // Iniciar la sesión

        //var_dump($_REQUEST);
		$datos = $this->MODEL->validarUsuario(
			$_POST['documento'],
			$_POST['clave']
		);
        //var_dump($datos);
		if ($datos[0] == 1) {
			$_SESSION['documento'] = $datos[1];
			$_SESSION['nombre'] = $datos[2];
			echo json_encode(array(
				1,
				$datos[1],
				$datos[2]
			));
		} else {
			echo json_encode(array(0));
		}
	}

	public function listarPacientes()
    {
     $datos=$this->MODEL->listarPacientes();
     if($datos[0]=="vacio"){
         echo '0 resultados para la busqueda';
         die();
     }
     include 'tables/table1.php';
    }

	
	public function tipoDocumento($id){
		$datos=$this->MODEL->tipoDocumento($id);
		echo $datos;
	}

	public function tipoGenero($id){
		$datos=$this->MODEL->tipoGenero($id);
		echo $datos;
	}

	
	public function buscarDepartamento($id){
		$datos=$this->MODEL->buscarDepartamento($id);
		echo $datos;
	}

	
	public function buscarMunicipio($id){
		$datos=$this->MODEL->buscarMunicipio($id);
		echo $datos;
	}

	public function listaTipoDocumento()
	{
		$datos = $this->MODEL->listaTipoDocumento();
		foreach ($datos as $row) :
			echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
		endforeach;
	}

	public function listaGenero()
	{
		$datos = $this->MODEL->listaGenero();
		foreach ($datos as $row) :
			echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
		endforeach;
	}

	public function ListaDepartamento()
	{
		$datos = $this->MODEL->ListaDepartamento();
		foreach ($datos as $row) :
			echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
		endforeach;
	}


	public function cargaListaMunicipio()
	{
		$datos = $this->MODEL->cargaListaMunicipio($_POST['departamentoPaciente']);
		echo json_encode($datos);
	}

	public function RegistrarPaciente()
	{
		$datos = $this->MODEL->RegistrarPaciente(
			$_POST['tipoDocumento'],
			$_POST['numeroDocumento'],
			$_POST['primerNombre'], 
			$_POST['segundoNombre'], 
			$_POST['primerApellido'], 
			$_POST['segundoApellido'], 
			$_POST['generoPaciente'], 
			$_POST['departamentoPaciente'], 
			$_POST['municipioPaciente']
		);

		if ($datos[0] == 1) {
			echo json_encode(array(1));
		} else {
			echo json_encode(array(0));
		}
	}

	public function validarTipDocumento()
	{
		$datos = $this->MODEL->validarTipDocumento($_POST['tipoDoc'],$_POST['numeroDocumento']);

		if ($datos[0] == 0) {
			echo json_encode(["existe" => false]);
		} else {
			echo json_encode([
				"existe" => true,
				"tipo_documento" => $datos[1],
				"numero_documento" => $datos[2]
			]);
		}
	}

	public function eliminarRegistroPaciente()
	{
		$datos = $this->MODEL->eliminarRegistroPaciente($_POST['id']);
		if ($datos[0] == 1) {
				echo json_encode(array(1));
		} else {
			echo json_encode(array(0));
		}
	}


	public function ActualizarRegistroPaciente()
	{
		//var_dump($_POST);
		$datos = $this->MODEL->ActualizarRegistroPaciente(
			$_POST['id'], 
			$_POST['tipoDocumentoEdit'],
			$_POST['numeroDocumentoEdit'],
			$_POST['primerNombreEdit'], 
			$_POST['segundoNombreEdit'], 
			$_POST['primerApellidoEdit'], 
			$_POST['segundoApellidoEdit'],
			$_POST['generoPacienteEdit'],
			$_POST['departamentoPacienteEdit'],
			$_POST['municipioPacienteEdit']
		);
		if ($datos[0] == 1) {
			echo json_encode(array(1));
		} else {
			echo json_encode(array(0, $datos[1]));
		}
	}
	


	
	public function TraerDatosRegistro()
	{
		$datos = $this->MODEL->TraerDatosRegistro($_POST['id']);
		if ($datos[0] == 0) {
			echo json_encode(array(0));
		} else {
			echo json_encode(array(
				1,
				$datos[1],
				$datos[2],
				$datos[3],
				$datos[4],
				$datos[5],
				$datos[6],
				$datos[7],
				$datos[8],
				$datos[9]
			));
		}
	}

}
if (isset($_POST['funcion'])) {
	call_user_func(array(new controller, $_POST['funcion']));
}
?>