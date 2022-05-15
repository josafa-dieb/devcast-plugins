<?php 
$dsn = "mysql:host=localhost;dbname=u895343190_dc;charset=utf8";
$user = "u895343190_smoke";
$pass = "d5HFZq1pGUtm";
$pdo = null;
try { $pdo = new pdo($dsn, $user, $pass); } catch (PDOException $e) { echo "Erro 404"; }
if(!$pdo){header('Location: ../index.php');}

?>