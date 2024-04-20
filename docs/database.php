<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "mydb";
    $db_conection;

    try {
        $db_conection = mysqli_connect($db_server ,$db_user,$db_password,$db_name );
    }catch(mysqli_sql_exception){
        echo "Não conseguiu conectar o banco de dados";
    }
?>