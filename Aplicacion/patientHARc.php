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

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

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

    <a class="navbar-brand mr-1" href="index.php">Estadisticas paciente</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <?php 
      require("includes/comun/navBarSearch.php");
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
            <a href="#">Resultados HAR</a>
          </li>
          <li class="breadcrumb-item active">Estadisticas paciente</li>
        </ol>

        <script>
                var currentPacient = 16
                function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            var paciente = getParameterByName('paciente');
            if (paciente == currentPacient){
                $(document).ready(function(){

                    load_data();

                    function load_data(query)
                    {
                      $.ajax({
                        url:"fetchCaminar.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data)
                        {
                        
                          $('#caminar').html(data);
                        }
                      });
                    }

                    });

                     $(document).ready(function(){

                    load_data();

                    function load_data(query)
                    {
                      $.ajax({
                        url:"fetchCaminar.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data)
                        {
                          console.log("IBAA ", data)
                          var activityHAR
                          if (data <= 25)
                            activityHAR = "Actividad Nula"
                          else if( data >= 26 && data <= 50)
                            activityHAR = "Actividad Baja"
                          else if ( data >= 51 && data <= 75 )
                            activityHAR = "Actividad Moderada"
                          else
                            activityHAR = "Actividad Alta"

            
                          $('#caminaribaa').html(activityHAR);
                        }
                      });
                    }

                    });

                    $(document).ready(function(){

                        load_data();

                        function load_data(query)
                        {
                          $.ajax({
                            url:"fetchPie.php",
                            method:"POST",
                            data:{query:query},
                            success:function(data)
                            {
                            
                              $('#pie').html(data);
                            }
                          });
                        }

                        });
                        $(document).ready(function(){

                            load_data();

                            function load_data(query)
                            {
                              $.ajax({
                                url:"fetchSentado.php",
                                method:"POST",
                                data:{query:query},
                                success:function(data)
                                {
                                
                                  $('#sentado').html(data);
                                }
                              });
                            }

                            });
            }
            
                

            
        </script>
        

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-101">
              <div class="card-body">
                <div class="card-body-icon">
                  
                </div>
                <div class="mr-5"><div id="pie"></div> % De pie</div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-101">
              <div class="card-body">
                <div class="card-body-icon">
                  
                </div>
                <div class="mr-5"><div id="sentado"></div> % Sentado</div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
          
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-101">
              <div class="card-body">
                <div class="card-body-icon">
               
                </div>
                <div class="mr-5"><div id="caminar"></div> % Caminando</div>
              </div>
              <!--<a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">Ver detalles</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>-->
            </div>
          </div>
        </div>

        <div class="card text-black bg-light o-hidden h-101">
              <div class="card-body">
                <div class="card-body-icon">
                  
                </div>
                <div class="mr-5">La actividad realiza por el paciente es: <div id="caminaribaa"></div></div>
              </div>
              
            </div>


        <div class="wrapper">
            <div class = "container" > 
              <br />
              
                
              <br />
              <div id="data"></div>
            </div>
        </div>
        <div class="wrapper">
            <div class = "container" > 
                <div id="curve_chart" style="width: 900px; height: 500px"></div>
            </div>
        </div>
        <script>
        console.log("aqio", paciente)
       if (paciente == currentPacient){
        $(document).ready(function(){

            load_data();

            function load_data(query)
            {
              $.ajax({
                url:"fetchActiv.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                  
                  $('#data').html(data);
                }
              });
            }

            });
       }
       else {
          $('#data').html("Sin datos registrados")
       }
       
       
        </script>
        <script type="text/javascript">

          
       
            if (paciente == currentPacient){
              $(document).ready(function(){

                  load_data();

                  function load_data(query)
                  {
                    $.ajax({
                      url:"fetchActivCharts.php",
                      method:"POST",
                      data:{query:query},
                      success:function(data)
                      {
                        var arrChart = JSON.parse(data)
                        console.log("charts", arrChart)
                        $('#charts').html(data);
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        var dataHAR=[];
                        var header = ['Fecha', 'Caminar', 'Sentado'];
                        dataHAR.push(header);

                        for(var i = arrChart.length - 1; i >= 0; i-- ){
                            var temp = []
                             
                            temp.push(arrChart[i].fecha)
                            temp.push(parseInt(arrChart[i].caminar,10))
                            temp.push(parseInt(arrChart[i].sentado,10) )

                            dataHAR.push(temp)
                        }

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(dataHAR);

                            var options = {
                              title: 'Evolucion de actividad',
                              curveType: 'function',
                              legend: { position: 'bottom' },
                              hAxis: {
                                title: 'Fecha',
                                slantedText: true
                              },
                              vAxis: {
                                title: 'Cantidad de activdad (%)'
                              }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                          }
                      }
                    });
                  }

                  });
            }
            else {
                $('#charts').html("Sin datos registrados")
            }
    
        </script>
        <!--
        <div class="wrapper">
            <div class = "container" > 
                  <div id="records"></div> 
                  <script type="text/javascript">
                    var myvar='<?php echo $_SESSION['idMedico'];?>';
                  </script>
                  <script type="text/javascript" src="js/aplicacion/resultadosHAR.js"></script>
            </div> 
        </div> 
        -->

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
