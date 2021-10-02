<?php

$nombre = $_POST['nombre']; //nombre
$password = $_POST['password']; //contraseña
$email = $_POST['email']; //correo electronico
$genero = $_POST['genero']; //genero
$materia = $_POST['materia']; //materia
$telefono = $_POST['telefono']; //telefono

//isset() función que verifica si la variable está vacia o no, configurada o no.
//empty() función que verifica si la variable está vacia o no, no arroja mensaje 

if (!empty($nom)||!empty($password)||!empty($email)||!empty($gen)||!empty($mater)||!empty($tel)){
    //conexión a base de datos
    $hosts = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'estudiante';
    $conn = new mysqli($hosts, $dbuser, $dbpassword, $dbname);

    //si encuentra un error, ejecuta
    if (mysqli_connect_error()) {
        //descripción del error encontrado en la ultima conexión, de los datos enviados
        die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    //si no lo encuentra
    else {
        //Sentencias Preparadas 
        //la consulta se realiza una vez y la sentencia se ejecuta varias veces
        //mejora la seguridad y el tiempo de ejecución de la sentencia
        //dato identificador del usuario para recuperación
        $SELECT = "SELECT telefono from usuario where telefono = ? limit 1";
        $INSERT = "INSERT INTO usuario (nombre,password,genero,email,materia,telefono) values (?,?,?,?,?,?)";

        //identificador
        //donde funcionará la consulta preparada = en la conexión
        //para traer objetos ->
        //prepare: da inicio a la sentencia preparada
        $stmt = $conn->prepare($SELECT);
        // el parametro para la sentencia preparada 
        $stmt -> bind_param("i",$telefono); //i de integer, s de string, d de double, blod con b
        // execute, ejecuta la sentencia en la base de datos 
        $stmt ->execute();
        //para ver los resultados 
        $stmt ->bind_result($telefono);//lo que quiero como  resultado
        // store_result, transfiere el conjunto de resultados de la última consulta
        $stmt -> store_result();
        //regresa el número de filas del resultado de la sentencia
        $rmun =$stmt->num_rows();
        if ($rmun == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            //para varios parametros
            $stmt ->bind_param("sssssi",$nombre,$password,$genero,$email,$materia,$telefono);
            $stmt ->execute();
            echo "Registro completado";
        }//si encuentra un telefono parecido
        else {
            echo "alguien registro ese número";
        }
        $stmt ->close();
        $conn ->close();

    }
}
else {
    echo "Todos los datos son OBLIGATORIOS";
    die();
}

?>