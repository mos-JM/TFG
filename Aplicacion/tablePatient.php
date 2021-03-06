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
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
  

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/decorate.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Listado pacientes</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <?php 
      require("includes/comun/navBarSearch.php"); 
    ?>

    <?php 
      require("includes/comun/navBar.php"); 
    ?>
  
  </nav>

  <div id="wrapper">

    <?php 
      require("includes/comun/sideBar.php"); 
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Path -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Pacientes</a>
          </li>
          <li class="breadcrumb-item active">Listado</li>
        </ol>

        <div class="wrapper">
            <div class = "container" > 
                  <div id="records"></div> 
                  <script type="text/javascript">
                    var myvar='<?php echo $_SESSION['idMedico'];?>';
                  </script>
                  <script type="text/javascript" src="js/aplicacion/testtable.js"></script>
            </div> 
        </div> 
         
      </div>
      <!-- /.container-fluid -->

      <!-- Pie de pagina -->
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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

 

  
</body>

</html>
