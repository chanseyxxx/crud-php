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
    <h1>Bem-vindo ao hovet</h1>
    <h2>Crie sua conta</h2>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="name" name="name" required>
  </div>
  <br>
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
  <input type="submit" name="submit" value="Cadastre-se">
  <p>Já possui conta?</p>
    <a href="entrar.php">Entrar na conta</a>
</form>
</body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  
        if(empty($name)){
            echo "Digite um nome";
        }elseif(empty($email)){
            echo "Digite um email";
        } elseif (empty($password)) {
            echo "Digite uma senha";
        } else {
            try {
                $sql = "INSERT INTO users (name, email, password) VALUES (?, ? , ?)";
                $stmt = mysqli_prepare($db_conection, $sql);

                if ($stmt) {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $name , $email, $password_hash);
                    if (mysqli_stmt_execute($stmt)) {
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: teste.php");
                    exit();
                    
                    } else {
                        echo "Erro ao cadastrar";
                    }
                } else {
                    echo "Erro na preparação da consulta SQL";
                }
            } catch (mysqli_sql_exception $e) {
                echo "O email já está cadastrado";
            }
        }
    }
    mysqli_close($db_conection);


?>