<?php
require_once __DIR__.'/includes/config.php';
if (!isset($_SESSION['login'])) {
  require("login.php");

}
else{
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <title>Charts</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Buscar paciente</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <?php 
		  require("includes/comun/navBarSearch.php"); 
		  require("includes/comun/NavBar.php"); 
	  ?>
    

  </nav>

  <div id="wrapper">

    <?php 
		  require("includes/comun/sideBar.php"); 
		  
	  ?>

    <div id="content-wrapper">

      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Buscar Pacientes</a>
          </li>
          <li class="breadcrumb-item active">Resultados</li>
        </ol>

        <div class="wrapper">
            <div class = "container" > 
              <br />
                <h2>Buscar paciente y pincha para acceder.</h2><br />
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="search_text" id="search_text" placeholder="Buscar paciente ..." class="form-control" />
                  </div>
                </div>
              <br />
              <div id="result"></div>
            </div>
          </div>
      </div>
      
      <script>
       
        $(document).ready(function(){

            load_data();

            function load_data(query)
            {
              $.ajax({
              url:"fetch.php",
              method:"POST",
              data:{query:query},
              success:function(data)
            {
              console.log("aqui " , result)
              $('#result').html(data);
            }
            });
          }
          $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != '') {
              load_data(search);
            }
            else{
              load_data();
            }
          });
        });
        </script>





              
      

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>SB Admin</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php 
		  require("includes/comun/logoutModal.php"); 
	  ?>
  <?php
		}
  ?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
 

</body>

</html>
