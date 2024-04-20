<?php
    include("database.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <h1>Mude seus dados aqui</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" required>
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
        <input type="submit" name="submit" value="Atualizar">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (empty($name)) {
        echo "Digite um nome";
    } elseif (empty($email)) {
        echo "Digite um email";
    } elseif (empty($password)) {
        echo "Digite uma senha";
    } else {
        $sql = "UPDATE users SET nome = ?, senha = ?, email = ? WHERE email = ?";
        $stmt = mysqli_prepare($db_connection, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $password, $email, $_SESSION["email"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db_connection);
        header("location: teste.php");
        exit;
    }
}
?>
