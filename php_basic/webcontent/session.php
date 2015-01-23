<?php
session_start();

$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";

$bytes = openssl_random_pseudo_bytes(10, $cstrong);
$hex   = bin2hex($bytes);

var_dump($hex);
$id = md5($hex);


$_SESSION['uuid'] = $id;
?>
<!DOCTYPE html>
<html>
<body>

<?php
print_r($_SESSION);
?>

</body>
</html>