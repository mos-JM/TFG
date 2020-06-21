<!DOCTYPE html>
<html>
<body>

<?php
$file = fopen("caminando.csv","r");
while(! feof($file))
  {
  print_r(fgetcsv($file));
  }
fclose($file);
?>

</body>
</html>