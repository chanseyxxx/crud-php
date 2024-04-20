<?php
session_start();
include("database.php");

echo "Olá " . $_SESSION["name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="teste.php" method="post">
        <input type="submit" name="update" value="atualizar">
    </form>
    <form action="teste.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>
    <form action="teste.php" method="post">
        <input type="submit" name="delete" value="Excluir conta">
    </form>
</body>
</html>
<?php
    if (isset($_POST["logout"])) {
        session_destroy();
        header("location: entrar.php");
    }
    
    if (isset($_POST["delete"])) {
        $email = $_SESSION["email"];
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = mysqli_prepare($db_conection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        header("location: entrar.php");
    }
?>