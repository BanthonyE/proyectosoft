<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="<?php base_url() ?>assets/css/sb-admin-2.min.css">


   <!-- sweet alert-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> 
  function crearalerta(mensaje){
        Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: mensaje,
                      showConfirmButton: false,
                      timer: 1500
                  });
  }


</script>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex">
              <div class="col-lg-6 d-none d-lg-block ">
              <img src="<?php  base_url() ?>assets/img/conta3.jpg" class="bg-personal" />  
              </div>
              <div class="col-lg-5 ml-auto">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">BIENVENIDO</h1>
                  </div>
                  <!-- FORMULARIO DE LOGIN-->
                    <form class="user" action="ingresar1" method="POST">
                        <!--SE REQUIERE DE UNA VARIABLE DE TIPO MAIL-->
                        <div class="form-group">
                          <input type="text" class="form-control form-control-user" name="usuario" id="usuario" aria-describedby="emailHelp" placeholder="Ingrese su usuario..." required>
                        </div>
                        <!--SE REQUIERE DEL PASSWORD CORRESPONDIENTE-->
                        <div class="form-group">
                          <input type="text" class="form-control form-control-user" name="password" id="password" placeholder="Contraseña" required>
                        </div>
                        <!--BOTON DE INGRESO QUE TE DIRIGE A LA FUNCION INGRESAR DEL CONTROLADOR LOGIN-->
                        <input type="submit" value="ingresar" class="btn btn-primary btn-user btn-block">		
                        
                        <!--BOTON DE VOLVER QUE TE DIRIFE A LA FUNCION VOLVER DEL CONTROLADOR LOGIN-->
                        <a href="volver" class="btn btn-secondary btn-user btn-block">
                          Volver
                        </a>
                        <hr>
                    </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="https://wa.link/xcqgql">Contactar Contador</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <?php 
      if(isset($mensaje)){
       
        echo '<script type="text/javascript">', 
                    'crearalerta("USUARIO O CLAVE INCORRECTA");', 
                    '</script>' 
                ;   
      }
    
    ?>

  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>
