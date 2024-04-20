<?php
    include("database.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Entre na sua conta do hovet</h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" required>
        </div>
        <br>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <input type="submit" name="submit" value="Entrar">
        <p>Não possui conta?</p>
        <a href="index.php">Criar conta</a>
    </form>
</body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $password = $_POST["password"];
    if(empty($email)){
        echo "Digite um email";
    }elseif (empty($password)) {
        echo "Digite uma senha";
    }else{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($db_conection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_assoc($resultado);
            $senhaHash = $linha["password"]; 
            
            if (password_verify($password, $senhaHash)) {
                $_SESSION["name"] = $linha["name"];
                $_SESSION["email"] = $linha["email"];
                header("Location: teste.php");
                exit();
            } else {
                
                echo "Credenciais invalidos";
                exit();
            }
        } else {
            echo "Credenciais invalidos";
            exit();
        }
        }
  }  
  mysqli_close($db_conection);

?>