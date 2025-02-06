<?php

session_start(); // Iniciar sesión

// Verificar si el usuario NO ha iniciado sesión
if (!isset($_SESSION['documento'])) {
    header("Location: login.php");
    exit();
}


require_once('/xampp/htdocs/matrizcrud/controller.php');
$control= new controller();
?>

<style>
	table.tablainfo {
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		border: 1px solid black;
		padding: 8px;
		text-align: center;
	}

	tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	tr.muy-alto {
		background-color: red;
	}

	tr.alto {
		background-color: pink;
	}

	tr.medio {
		background-color: yellow;
	}

	tr.bajo {
		background-color: lightgreen;
	}

	tr.muy-bajo {
		background-color: #ccffcc;
	}

		table.tabla3 {
            border-collapse: collapse;
            width: 100%;
        }

        th.tabla3{
            border: 1px solid rgb(0, 0, 0);
            padding: 8px;
            text-align: center;
            background-color: rgba(80, 197, 41, 0.816);
        }
        td.tabla3{
          border: 1px solid rgb(0, 0, 0);
          padding: 8px;
          text-align: center;
          background-color: rgba(127, 152, 121, 0.796);
        }
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.js'></script>
<link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.css'>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MATRIZ</title>
</head>

<div class="container">
	<section class="row">
		<section class="col-md-2"></section>

		<section class="col-md-8" style="text-align: center;">
			<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
			
		</section>

		<section class="col-md-2"></section>
	</section>
</div>

<br>
<hr>
<div class="container">
	<section class="row">

		<section class="col-md-2"></section>

		<section class="col-md-4" style="text-align: center;">
			<button onclick="AbrirModalRegPaciente()" class="btn btn-success" style="max-width:100%"><span class="fa fa-plus"></span> Registrar Paciente</button>
		</section>

		<section class="col-md-4" style="text-align: center;">
			<button onclick="logoutUsuario()" class="btn btn-danger" style="max-width:50%">Cerrar sesión</button>
		</section>

		<section class="col-md-2"></section>

	</section>
</div>
<hr>
<br>


<body>
	<br>
	<div class="container">

		<section class="row">

			<!-- TABLA DE PACIENTES -->

			<section class="col-md-12">
				<div id="tabla"></div>
			</section>

		</section>
	</div>
	<hr>
</body>


<!-- MODAL CREAR REGISTRO PACIENTE-->
<div class="modal fade" id="ModalRegistroPaciente" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Registro Paciente</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
			</div>
			<div class="modal-body">
				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Primer Nombre:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="primerNombre" id="primerNombre" placeholder="Primer Nombre">
						</div>
					</section>

					<section class="col-md-5">
						<span>Segundo Nombre:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="segundoNombre" id="segundoNombre" placeholder="Segundo Nombre">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>

				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Primer Apellido:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="primerApellido" id="primerApellido" placeholder="Primer Apellido">
						</div>
					</section>

					<section class="col-md-5">
						<span>Segundo Apellido:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="segundoApellido" id="segundoApellido" placeholder="Segundo Apellido">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>

				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Tipo Documento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-address-card"></i></span>
							</div>
							<select class="form-control" name="tipoDocumento" id="tipoDocumento" required>
								<option value="0">Seleccione</option>
								<?php $control->listaTipoDocumento(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-5">
						<span>Numero Documento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user-edit"></i></span>
							</div>
							<input class="form-control" type="text" name="numeroDocumento" id="numeroDocumento" placeholder="Numero Documento">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>


				<section class="row">

					<section class="col-md-4">
						<span>Genero:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-restroom"></i></span>
							</div>
							<select class="form-control" name="generoPaciente" id="generoPaciente" required>
								<option value="0">Seleccione</option>
								<?php $control->listaGenero(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-4">
						<span>Departamento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
							</div>
							<select class="form-control" name="departamentoPaciente" id="departamentoPaciente" onchange="cargaListaMunicipio()" required>
								<option value="0">Seleccione</option>
								<?php $control->ListaDepartamento(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-4">
						<span>Municipio:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
							</div>
							<select class="form-control" name="municipioPaciente" id="municipioPaciente" required>
								<option value="0">Seleccione</option>
								<?php //$control->ListaEntregableAfectado(); ?>
							</select>
						</div>
					</section>

				</section>

				<hr>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="RegistrarPaciente()" id="botonRegistraPaciente"><span class="fa fa-save"></span> Registrar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times" aria-hidden="true"></span> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- TERMINA MODAL REGISTRO PACIENTE -->

<!-- MODAL EDITAR REGISTRO PACIENTE-->
<div class="modal fade" id="ModalEditarPaciente" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel">Registro Paciente</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
			</div>
			<div class="modal-body">

				<input type="text" class="form-control" name="idPacienteEdit" id="idPacienteEdit" hidden>


				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Primer Nombre:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="primerNombreEdit" id="primerNombreEdit" placeholder="Primer Nombre">
						</div>
					</section>

					<section class="col-md-5">
						<span>Segundo Nombre:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="segundoNombreEdit" id="segundoNombreEdit" placeholder="Segundo Nombre">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>

				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Primer Apellido:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="primerApellidoEdit" id="primerApellidoEdit" placeholder="Primer Apellido">
						</div>
					</section>

					<section class="col-md-5">
						<span>Segundo Apellido:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input class="form-control" type="text" name="segundoApellidoEdit" id="segundoApellidoEdit" placeholder="Segundo Apellido">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>

				<section class="row">
					<section class="col-md-1"></section>

					<section class="col-md-5">
						<span>Tipo Documento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-address-card"></i></span>
							</div>
							<select class="form-control" name="tipoDocumentoEdit" id="tipoDocumentoEdit" required>
								<option value="0">Seleccione</option>
								<?php $control->listaTipoDocumento(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-5">
						<span>Numero Documento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user-edit"></i></span>
							</div>
							<input class="form-control" type="text" name="numeroDocumentoEdit" id="numeroDocumentoEdit" placeholder="Numero Documento">
						</div>
					</section>

					<section class="col-md-1"></section>
				</section>


				<section class="row">

					<section class="col-md-4">
						<span>Genero:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-restroom"></i></span>
							</div>
							<select class="form-control" name="generoPacienteEdit" id="generoPacienteEdit" required>
								<option value="0">Seleccione</option>
								<?php $control->listaGenero(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-4">
						<span>Departamento:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
							</div>
							<select class="form-control" name="departamentoPacienteEdit" id="departamentoPacienteEdit" onchange="cargaListaMunicipioEdit()" required>
								<option value="0">Seleccione</option>
								<?php $control->ListaDepartamento(); ?>
							</select>
						</div>
					</section>

					<section class="col-md-4">
						<span>Municipio:</span>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
							</div>
							<select class="form-control" name="municipioPacienteEdit" id="municipioPacienteEdit" required>
								<option value="0">Seleccione</option>
								<?php //$control->ListaEntregableAfectado(); ?>
							</select>
						</div>
					</section>

				</section>

				<hr>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="ActualizarRegistroPaciente()" id="botonEditarPaciente"><span class="fa fa-save"></span> Actualizar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times" aria-hidden="true"></span> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- TERMINA MODAL ACTUALIZAR PACIENTE -->



<script type="text/javascript">

	listarPacientes()

	function logoutUsuario(){
		Swal.fire({
			title: 'Desea cerrar la seccion actual?',
			text: `Usuario: <?php echo htmlspecialchars($_SESSION['nombre']); ?>`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirmar'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = 'logout.php';
			}
		})
	}

	function listarPacientes() {
		let formulario = new FormData();
		formulario.append("funcion", "listarPacientes")
		$('#tabla').html('CARGANDO...');
		$.ajax({
			url: "controller.php",
			data: formulario,
			type: 'POST',
			datatype: 'HTML',
			cache: false,
			contentType: false,
			processData: false,
			async: true,
			success: function(data) {
				$('#tabla').html(data);
			},
			error: function(data) {
				$('#tabla').html('<p>Ha ocurrido un error</p>');
			}
		});
	}

	function cargaListaMunicipio() {
		let departamento = $("#departamentoPaciente").val();

		if (departamento == 0) {
			$("#municipioPaciente").html('<option value="0">Seleccione</option>');
			return;
		}

		let formulario = new FormData();
		formulario.append("funcion", "cargaListaMunicipio");
		formulario.append("departamentoPaciente", departamento);

		$.ajax({
			url: "controller.php",
			data: formulario,
			type: 'POST',
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				$("#municipioPaciente").html('<option value="0">Seleccione</option>');
				if (data.length > 0) {
					data.forEach(element => {
						$("#municipioPaciente").append(`<option value="${element.id}">${element.nombre}</option>`);
					});
				}
			},
			error: function() {
				console.log("Error al cargar municipios");
			}
		});
	}

	function cargaListaMunicipioEdit() {
		let departamento = $("#departamentoPacienteEdit").val();

		if (departamento == 0) {
			$("#municipioPaciente").html('<option value="0">Seleccione</option>');
			return;
		}

		let formulario = new FormData();
		formulario.append("funcion", "cargaListaMunicipio");
		formulario.append("departamentoPaciente", departamento);

		$.ajax({
			url: "controller.php",
			data: formulario,
			type: 'POST',
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				$("#municipioPacienteEdit").html('<option value="0">Seleccione</option>');
				if (data.length > 0) {
					data.forEach(element => {
						$("#municipioPacienteEdit").append(`<option value="${element.id}">${element.nombre}</option>`);
					});
				}
			},
			error: function() {
				console.log("Error al cargar municipios");
			}
		});
	}


	async function RegistrarPaciente(){

		var bool = await validarTipDocumento($("#tipoDocumento").val(),$("#numeroDocumento").val());

		if (bool == true) {
			Swal.fire(
				'Ya existe un paciente que corresponde a el tipo de documento y numero indicado',
				'',
				'warning'
			);
			$("#botonRegistraPaciente").prop("disabled", false);
			return
		}

		$("#botonRegistraPaciente").prop("disabled", true);

        let formulario = new FormData();

        formulario.append("funcion", "RegistrarPaciente");

		if ($("#primerNombre").val() == "") {
			Swal.fire(
					'Por favor digite un nombre de paciente para continuar',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("primerNombre", $("#primerNombre").val());
		}

        formulario.append("segundoNombre", $("#segundoNombre").val());

		if ($("#primerApellido").val() == "") {
			Swal.fire(
					'Por favor digite un apellido de paciente para continuar',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("primerApellido", $("#primerApellido").val());
		}

		formulario.append("segundoApellido", $("#segundoApellido").val());

		
        if ($("#tipoDocumento").val() == "0") {
			Swal.fire(
					'Por favor seleccione un tipo de documento valida',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("tipoDocumento", parseInt($("#tipoDocumento").val(), 10));
		}

		if ($("#numeroDocumento").val() == "") {
			Swal.fire(
					'Por favor digite un numero de documento para continuar',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("numeroDocumento", $("#numeroDocumento").val());
		}

		if ($("#generoPaciente").val() == "0") {
			Swal.fire(
					'Por favor seleccione un genero de paciente valido',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("generoPaciente", $("#generoPaciente").val());
		}

		if ($("#departamentoPaciente").val() == "0") {
			Swal.fire(
					'Por favor seleccione un departamento de paciente valido',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("departamentoPaciente", $("#departamentoPaciente").val());

		}

		if ($("#municipioPaciente").val() == "0") {
			Swal.fire(
					'Por favor seleccione un municipio de paciente valido',
					'',
					'warning'
				);
			$("#botonRegistraPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("municipioPaciente", $("#municipioPaciente").val());
		}

        let req2 = await fetch("/matrizcrud/controller.php", {
            body: formulario,
            method: "POST"
        });
        let res2 = await req2.json();
		//console.log(res2);
        if (res2[0] == 1) {
			Swal.fire(
                'Paciente Registrado Correctamente',
                '',
                'success'
            );

            listarPacientes();

            $("#primerNombre").val('')
            $("#segundoNombre").val('')
			$("#primerApellido").val('')
            $("#segundoApellido").val('')
			$("#tipoDocumento").val("0").trigger('change')
			$("#numeroDocumento").val('')
            $("#generoPaciente").val("0").trigger('change')
			$("#departamentoPaciente").val("0").trigger('change')
			$("#municipioPaciente").val("0").trigger('change')

            $("#botonRegistraPaciente").prop("disabled", false);

			$('#ModalRegistroPaciente').modal('hide');
        } else {
			Swal.fire(
                'ERROR AL GUARDAR PACIENTE',
                '',
                'error'
            );
        }
	}

	async function validarTipDocumento(tipoDoc,numeroDocumento){
		let formulario = new FormData();

        formulario.append("funcion", "validarTipDocumento");

        formulario.append("tipoDoc", tipoDoc);
		formulario.append("numeroDocumento", numeroDocumento);

        let req2 = await fetch("/matrizcrud/controller.php", {
            body: formulario,
            method: "POST"
        });
        let res2 = await req2.json();
        return res2.existe;
	};
	


	function AbrirModalRegPaciente() {
		$('#ModalRegistroPaciente').modal('show');
	}


	function confirmarEliminarPaciente(id) {
        Swal.fire({
            title: 'Eliminar?',
            text: `¿confirme eliminar Registro de paciente con id ${id}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarRegistroPaciente(id)
            }
        })
    }

    async function eliminarRegistroPaciente(id) {
        let formulario = new FormData();
        formulario.append("funcion", "eliminarRegistroPaciente");
        formulario.append("id", id);
        let req2 = await fetch("/matrizcrud/controller.php", {
            body: formulario,
            method: "POST"
        });
        let res2 = await req2.json();
        if (res2[0] == 1) {
			console.log(res2[0])
            Swal.fire(
                'Registro de paciente Eliminado Correctamente',
                '',
                'success'
            );
            listarPacientes();
        } else {
            console.log(res2);
        }
    }


	async function modalEditarPaciente(id) {
		$('#ModalEditarPaciente').modal('show');

        let formulario2 = new FormData();
        formulario2.append("id", id);
        formulario2.append("funcion", "TraerDatosRegistro");

        let req3 = await fetch("/matrizcrud/controller.php", {
            body: formulario2,
            method: "POST"
        });
        let res3 = await req3.json();
        if (res3[0] == 1) {
			
			$("#idPacienteEdit").val(id);

            $("#primerNombreEdit").val(res3[3]);
            $("#segundoNombreEdit").val(res3[4]);
            $("#primerApellidoEdit").val(res3[5]);
            $("#segundoApellidoEdit").val(res3[6]);

			$("#tipoDocumentoEdit").val(res3[1]).trigger('change');
		    $("#numeroDocumentoEdit").val(res3[2]);

			$("#generoPacienteEdit").val(res3[7]).trigger('change');
			$("#departamentoPacienteEdit").val(res3[8]).trigger('change');

		    setTimeout(() => {
            	$("#municipioPacienteEdit").val(res3[9]).trigger('change');
        	}, 500);

        } else {
            alert("error insertar");
        }
    }

	async function ActualizarRegistroPaciente() {

        let formulario = new FormData();
		
        $("#botonRegistraPaciente").prop("disabled", true);

        formulario.append("funcion", "ActualizarRegistroPaciente");

		formulario.append("id", $("#idPacienteEdit").val());

		console.log($("#idPacienteEdit").val());

		if ($("#primerNombreEdit").val() == "") {
			Swal.fire(
					'Por favor digite un nombre de paciente para continuar',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("primerNombreEdit", $("#primerNombreEdit").val());
		}

        formulario.append("segundoNombreEdit", $("#segundoNombreEdit").val());

		if ($("#primerApellidoEdit").val() == "") {
			Swal.fire(
					'Por favor digite un apellido de paciente para continuar',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("primerApellidoEdit", $("#primerApellidoEdit").val());
		}

		formulario.append("segundoApellidoEdit", $("#segundoApellidoEdit").val());

		
        if ($("#tipoDocumentoEdit").val() == "0") {
			Swal.fire(
					'Por favor seleccione un tipo de documento valida',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("tipoDocumentoEdit", parseInt($("#tipoDocumentoEdit").val(), 10));
		}

		if ($("#numeroDocumentoEdit").val() == "") {
			Swal.fire(
					'Por favor digite un numero de documento para continuar',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("numeroDocumentoEdit", $("#numeroDocumentoEdit").val());
		}

		if ($("#generoPacienteEdit").val() == "0") {
			Swal.fire(
					'Por favor seleccione un genero de paciente valido',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("generoPacienteEdit", $("#generoPacienteEdit").val());
		}

		if ($("#departamentoPacienteEdit").val() == "0") {
			Swal.fire(
					'Por favor seleccione un departamento de paciente valido',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("departamentoPacienteEdit", $("#departamentoPacienteEdit").val());

		}

		if ($("#municipioPacienteEdit").val() == "0") {
			Swal.fire(
					'Por favor seleccione un municipio de paciente valido',
					'',
					'warning'
				);
			$("#botonEditarPaciente").prop("disabled", false);
			return;
		}else{
			formulario.append("municipioPacienteEdit", $("#municipioPacienteEdit").val());
		}
		
        let req2 = await fetch("/matrizcrud/controller.php", {
            body: formulario,
            method: "POST"
        });

        let res2 = await req2.json();

        if (res2[0] == 1) {

            $('#ModalEditarPaciente').modal('hide');

			$("#botonEditarPaciente").prop("disabled", false);

			$("#idPacienteEdit").val('')
			$("#primerNombreEdit").val('')
            $("#segundoNombreEdit").val('')
			$("#primerApellidoEdit").val('')
            $("#segundoApellidoEdit").val('')
			$("#tipoDocumentoEdit").val("0").trigger('change')
			$("#numeroDocumentoEdit").val('')
            $("#generoPacienteEdit").val("0").trigger('change')
			$("#departamentoPacienteEdit").val("0").trigger('change')
			$("#municipioPacienteEdit").val("0").trigger('change')


            listarPacientes();

            Swal.fire(
                'Registro Actualizado Correctamente',
                '',
                'success'
            );
        } else {
            alert("error");
        }
    }





</script>