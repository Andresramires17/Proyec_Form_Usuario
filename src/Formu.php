<?php

$nom = $_POST['nom']; //nombre
$password = $_POST['password']; //contraseña
$email = $_POST['email']; //correo electronico
$gen = $_POST['gen']; //genero
$mater = $_POST['mater']; //materia
$tel = $_POST['tel']; //telefono

//isset() función que verifica si la variable está vacia o no, configurada o no.
//empty() función que verifica si la variable está vacia o no, no arroja mensaje 

if (!empty($nom)||!empty($password)||!empty($email)||!empty($gen)||!empty($mater)||!empty($tel)){
    
    $hosts = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'estudiante';
}

?>