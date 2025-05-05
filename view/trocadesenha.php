<?php
require_once '../service/conexao.php';
require_once '../model/funcoes.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 

$mensagem = ""; 
$sucesso = false;

if (!isset($_SESSION['userID']) || !isset($_SESSION['codigo'])) {
    $mensagem = "Acesso inválido. Por favor, verifique o código novamente.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    if ($senha == $confirmar_senha) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $conn = new usePDO();
        $instance = $conn->getInstance();
        $userID = $_SESSION['userID']; 
        $sql = "UPDATE usuario SET senha = ? WHERE id = ?"; 
        try {
            $stmt = $instance->prepare($sql);
            $stmt->execute([$senha_hash, $userID]);

            if ($stmt && $stmt->rowCount() > 0) {
                $mensagem = "Senha alterada com sucesso!";
                $sucesso = true;
            } else {
                $mensagem = "Não foi possível alterar a senha.";
            }
        } catch (PDOException $e) {
            error_log("Error in trocadesenha.php: " . $e->getMessage());
            $mensagem = "Ocorreu um erro ao alterar a senha.";
        }
    } else {
        $mensagem = "As senhas não coincidem.";
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f2a6c0; 
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="password"]:focus {
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
            <h2>Nova Senha</h2>
            <?php if ($mensagem): ?>
                <p style="color: <?php echo (strpos($mensagem, 'sucesso') !== false) ? 'green' : 'red'; ?>;"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <?php if (!isset($_SESSION['userID']) || !isset($_SESSION['codigo'])): ?>
                <p>Acesso inválido. Por favor, verifique o código novamente.</p>
            <?php elseif(!$sucesso): ?>
                <form method="post" action="trocadesenha.php">
                    <input type="password" id="senha" class="fadeIn second" name="senha" placeholder="Digite a Nova Senha" required>
                    <input type="password" id="confirmar_senha" class="fadeIn third" name="confirmar_senha" placeholder="Confirme a Nova Senha" required>
                    <input type="submit" class="fadeIn fourth" value="Salvar">
                </form>
            <?php endif; ?>
            <div id="formFooter">
                <a class="underlineHover" href="login.php">Voltar ao Login</a>
            </div>
        </div>
    </div>
</body>
</html>