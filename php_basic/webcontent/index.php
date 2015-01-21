<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// to change a session variable, just overwrite it 
$_SESSION["favcolor"] = "yellow";
$_SESSION['age'] = 10;
print_r($_SESSION);
echo $_SESSION['favcolor'].'</br>';
var_dump($_SESSION);  //var_dump() function returns the data type and value
?>

</body>
</html>