<?php
// Incluir arquivos de conexão e funções
require_once '../service/conexao.php';
require_once '../model/funcoes.php';
 
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// Obter instância de conexão
$conexao = (new usePDO())->getInstance();
 
// Buscar todos os e-mails
$emails = buscarEmails();
 
// Debug: var_dump of $emails
//echo "<pre>";
//echo "<b>\$emails:</b>\n";
//var_dump($emails);
//echo "</pre>";
 
// Inicializar variável de email selecionado
$emailSelecionado = null;
 
// Verificar se um email foi selecionado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $emailSelecionado = buscarEmailPorId($id);
 
    // Debug: var_dump of $emailSelecionado
    //echo "<pre>";
    //echo "<b>\$emailSelecionado:</b>\n";
    //var_dump($emailSelecionado);
    //echo "</pre>";
}
 
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // The form has been submitted
    header("Location: codigo.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de Email</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
            overflow-x: hidden;
        }
 
        .email-container {
            height: calc(100vh - 56px);
        }
 
        .email-list {
            height: 100%;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
 
        .email-detail {
            height: 100%;
            overflow-y: auto;
        }
 
        .email-item {
            cursor: pointer;
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
        }
 
        .email-item:hover {
            background-color: #f1f3f5;
        }
 
        .email-item.active {
            background-color: #0d6efd;
            color: white;
        }
 
        .email-item.active .text-muted {
            color: rgba(255, 255, 255, 0.75) !important;
        }
 
        .email-item.unread {
            font-weight: bold;
        }
 
        .unread-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #0d6efd;
            margin-right: 8px;
        }
 
        .empty-state {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #6c757d;
        }
 
        @media (max-width: 767.98px) {
            .email-container {
                height: auto;
            }
 
            .email-list, .email-detail {
                height: auto;
                max-height: 100vh;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white p-3">
        <h1 class="h4 m-0">Email Dashboard</h1>
    </header>
 
    <!-- Main Content -->
    <div class="container-fluid p-0">
        <div class="row g-0 email-container">
            <!-- Email List -->
            <div class="col-md-4 col-lg-3 email-list">
                <?php if (empty($emails)): ?>
                    <div class="text-center p-4 text-muted">
                        <p>Nenhum email encontrado</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($emails as $email): ?>
                        <?php
                        // Debug: var_dump of $email
                        //echo "<pre>";
                        //echo "<b>\$email:</b>\n";
                        //var_dump($email);
                        //echo "</pre>";
                        ?>
                        <a href="<?php echo htmlspecialchars("?id={$email['id']}"); ?>" class="text-decoration-none">
                            <div class="email-item <?php echo ($emailSelecionado && $emailSelecionado['id'] == $email['id']) ? 'active' : ''; ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="d-flex align-items-center mb-1">
                                            <span><?php echo htmlspecialchars($email['username'] ?? 'Usuário'); ?></span>
                                        </div>
                                        <div class="text-muted small">
                                            Recuperação de senha!
                                        </div>
                                    </div>
                                    <!-- The created_at field does not exist -->
                                    <!-- <small class="text-muted">
                                        <?php //echo formatarData($email['created_at'] ?? date('Y-m-d')); ?>
                                    </small> -->
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
 
            <!-- Email Detail -->
            <div class="col-md-8 col-lg-9 email-detail">
                <?php if ($emailSelecionado): ?>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h4">Atualização de Acesso à Conta</h2>
                            <!-- The created_at field does not exist -->
                            <!-- <span class="text-muted"><?php //echo formatarData($emailSelecionado['created_at'] ?? date('Y-m-d')); ?></span> -->
                        </div>
 
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>De:</strong> <?php echo htmlspecialchars($emailSelecionado['username'] ?? 'Desconhecido'); ?>
                                    </div>
                                    <div>
                                        <span class="badge bg-secondary">Código: <?php echo htmlspecialchars($emailSelecionado['code'] ?? '---'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo nl2br(htmlspecialchars(
"Informamos que o acesso à sua conta foi atualizado com sucesso.
 
Seu novo código de acesso é:
 
🔐 Código de Acesso: {$emailSelecionado['code']}
 
Por motivos de segurança, recomendamos que você mantenha este código em local seguro. Em caso de dúvidas ou dificuldades, nossa equipe está pronta para ajudar.
 
Com cordialidade,
Equipe de Atendimento"
                                )); ?></p>
                            </div>
                        </div>
 
                        <div class="card">
                            <div class="card-header bg-light">
                                <h3 class="h5 mb-0">Detalhes do Usuário</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Usuário:</strong> <?php echo htmlspecialchars($emailSelecionado['username'] ?? '---'); ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <strong>Código:</strong> <?php echo htmlspecialchars($emailSelecionado['code'] ?? '---'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-envelope fs-1"></i>
                        <p>Selecione um email para ver seu conteúdo</p>
                    </div>
                <?php endif; ?>
            </div>
             <!-- Form to redirect to codigo.php -->
            <form action="index.php" method="post">
                <button class="btn-cadastro" type="submit">Continuar</button>
            </form>
        </div>
    </div>
 
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>