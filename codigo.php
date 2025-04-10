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
            <form>
                <input type="text" id="codigo" class="fadeIn second" name="codigo" placeholder="Digite o Código" required>
                <input type="submit" class="fadeIn third" value="Confirmar" onclick="window.location.href='nova-senha.html'">
            </form>
            <div id="formFooter">
                <a class="underlineHover" href="index.php">Voltar ao Login</a>
            </div>
        </div>
    </div>
</body>
</html>