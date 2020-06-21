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
    $row = mysqli_fetch_array($result);
    echo $row["pie"];
		

	
}
else
{
	echo 'Data Not Found';
}
?>
