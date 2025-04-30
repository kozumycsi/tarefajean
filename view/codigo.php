<?php
require_once '../service/conexao.php';
require_once '../model/funcoes.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

$mensagem = ""; // Initialize message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];

    // Verify if the code exists in the database
    $conn = new usePDO();
    $instance = $conn->getInstance();

    $sql = "SELECT userID FROM code WHERE code = ?";
    try {
        $stmt = $instance->prepare($sql);
        $stmt->execute([$codigo]);

        if ($stmt && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userID = $row['userID'];

            // Store the userID and code in the session
            $_SESSION['userID'] = $userID;
            $_SESSION['codigo'] = $codigo;

            // Redirect to the password reset page
            header("Location: trocadesenha.php");
            exit();
        } else {
            $mensagem = "Código inválido.";
        }
    } catch (PDOException $e) {
        error_log("Error in codigo.php: " . $e->getMessage());
        $mensagem = "Ocorreu um erro ao verificar o código.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        body {
            background-color: #ffeef8;
        }
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #formContent {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f2a6c0; 
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #ff6f91;
            outline: none;
        }
        input[type="submit"] {
            background-color: #ff6f91; 
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #ff4a7c; 
        }
        input[type="submit"], .btn-cadastro {
            background-color: #ff6f91; 
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin: 10px 0;
        }
        input[type="submit"]:hover, .btn-cadastro:hover {
            background-color: #ff4a7c; 
        }
        .underlineHover {
            text-decoration: none;
            color: #ff6f91;
        }
        .underlineHover:hover {
            text-decoration: underline;
        }
    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <h2>Confirmar Código</h2>
            <form method="post" action="codigo.php">
                <input type="text" id="codigo" class="fadeIn second" name="codigo" placeholder="Digite o Código" required>
                <input type="submit" class="btn-cadastro" value="Confirmar">
            </form>
            <?php if ($mensagem): ?>
                <p style="color: red;"><?php echo $mensagem; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>