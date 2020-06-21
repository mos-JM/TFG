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
	SELECT * FROM actividad 
	WHERE id LIKE '%".$search."%'
	OR fecha LIKE '%".$search."%'
	OR caminar LIKE '%".$search."%' 
	OR pie LIKE '%".$search."%' 
	OR sentado LIKE '%".$search."%' 
    OR ibaa LIKE '%".$search."%'
    OR actividad LIKE '%".$search."%'
	ORDER BY fecha desc";
}
else
{
	$query = "
	SELECT * FROM actividad ORDER BY fecha desc";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '<div class="card mb-3">
            <div class="card-header"> 
            <i class="fas fa-table"></i>
            Resultados</div>
            <div class="card-body">
                <div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Caminar</th>
							<th>De pie</th>
                            <th>Sentado</th>
                            <th>Resultado (IBAA)</th>
                            <th>Resultado Actividad</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{  
        
       
        $output .= '
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["fecha"].'</td>
				<td>'.$row["caminar"].'</td>
				<td>'.$row["pie"].'</td>
                <td>'.$row["sentado"].'</td>
                <td>'.$row["ibaa"].'</td>
                <td>'.$row["actividad"].'</td>
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
