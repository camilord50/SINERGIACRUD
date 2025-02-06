

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login CRUD</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.js'></script>
        <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.css'>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <?php
    require_once('/xampp/htdocs/matrizcrud/controller.php');
    $control= new controller();
    
    session_start();

    if (isset($_SESSION['documento'])) {
        header("Location: index.php");
        exit();
    }

    ?>

    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card shadow-lg" style="width: 25rem;">
        <div class="card-header text-center">
            <h3>Iniciar Sesión</h3>
        </div>
        <div class="card-body">
            <form id="loginForm">
                <div class="input-group mb-3"> 
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                    <div class="form-floating">
                        <input class="form-control" id="documento" name="documento" type="number" required />
                        <label for="documento">Documento usuario</label>
                    </div>
                </div>

                <div class="input-group mb-3"> 
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <div class="form-floating">
                        <input class="form-control" id="clave" name="clave" type="password" required />
                        <label for="clave">Contraseña</label>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-success" id="boton_login" onclick="loginUsuario()">Ingresar</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="register.php">No tienes una cuenta? Regístrate!</a></div>
        </div>
    </div>

        <script type="text/javascript">

            function loginUsuario(){
                let formulario = new FormData();

                let contr1 = $("#documento").val();
                let contr2 = $("#clave").val();

                if (contr1 == "" || contr2 == "") {
                    Swal.fire(
                            'Diligencie todos los campos antes de continuar',
                            '',
                            'warning'
                        );
                }else{
                    validarUsuario();
                }    
            }

            async function validarUsuario(){
                $("#boton_login").prop("disabled", true);
                let formulario = new FormData();
                
                let documento = $("#documento").val()
                let clave = $("#clave").val()

                formulario.append("documento", documento);
                formulario.append("clave", clave);

                formulario.append("funcion", "validarUsuario");

                let req2 = await fetch("/matrizcrud/controller.php", {
                    body: formulario,
                    method: "POST"
                });
                let res2 = await req2.json();
                //console.log(res2);
                if (res2[0] == 1) {
                    ContinuarRegistro(res2[1],res2[2]);
                } else {
                    Swal.fire(
                        'El documneto y contraseña ingresado no corresponde a ninguna cuenta o son incorrectos, por favor verificar credenciales',
                        '',
                        'error'
                    );
                }
            }

            function ContinuarRegistro(documento,nombre) {
                Swal.fire({
                    title: 'Usuario Validado',
                    text: `Bienvenido usuario: ${nombre}`,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Continuar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/matrizcrud/index.php';
                    }
                })
            }

        </script>

    </body>
</html>
