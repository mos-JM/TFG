<?php
require_once __DIR__.'/includes/config.php';

    $host         = "localhost";
    
    $username     = "tfg";
    
    $password     = "tfg";

    $dbname       = "tfg";

    $connect = mysqli_connect($host, $username, $password, $dbname);
	$output = '';

	 

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM pacientes 
	WHERE id LIKE '%".$search."%'
	OR nombre LIKE '%".$search."%'
	OR apellidos LIKE '%".$search."%' 
	OR dni LIKE '%".$search."%' 
	OR fechaNacimineto LIKE '%".$search."%' 
	OR sexo LIKE '%".$search."%'
	OR idMedico LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM pacientes ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '<div class="card mb-3">
            <div class="card-header"> 
            <i class="fas fa-table"></i>
            Listado pacientes</div>
            <div class="card-body">
                <div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>DNI</th>
							<th>Fecha Nacimiento</th>
							<th>Sexo</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$miVar = $_SESSION['idMedico'];
		if ($miVar == $row["idMedico"])
		
		$output .= '
			<tr>
				<td><a href="patientHARc.php?paciente='.$row["id"].'">'.$row["nombre"].'</a></td>
				<td><a href="patientHARc.php">'.$row["apellidos"].'</a></td>
				<td><a href="patientHARc.php">'.$row["dni"].'</a></td>
				<td><a href="patientHARc.php">'.$row["fechaNacimineto"].'</a></td>
				<td><a href="patientHARc.php">'.$row["sexo"].'</a></td>
			</tr>
		';
	}
	echo $output;
	
}
else
{
	echo 'Data Not Found';
}
?>
