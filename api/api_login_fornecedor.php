<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

function resposta($sucesso, $mensagem, $dados = null) {
    echo json_encode(['sucesso' => $sucesso, 'mensagem' => $mensagem, 'dados' => $dados], JSON_UNESCAPED_UNICODE);
    exit;
}

$acao = $_POST['acao'] ?? '';

if ($acao == 'login') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = md5($_POST['senha']);
    
    $sql = "SELECT * FROM fornecedores WHERE email='$email' AND senha='$senha' AND ativo=1";
    $result = mysqli_query($conn, $sql);
    
    if ($fornecedor = mysqli_fetch_assoc($result)) {
        $_SESSION['fornecedor_id'] = $fornecedor['id'];
        $_SESSION['fornecedor_nome'] = $fornecedor['nome_estabelecimento'];
        $_SESSION['fornecedor_email'] = $fornecedor['email'];
        
        mysqli_query($conn, "UPDATE fornecedores SET ultimo_acesso=NOW() WHERE id={$fornecedor['id']}");
        
        resposta(true, 'Login realizado!', $fornecedor);
    } else {
        resposta(false, 'E-mail ou senha incorretos');
    }
} elseif ($acao == 'logout') {
    session_destroy();
    resposta(true, 'Logout realizado');
} else {
    resposta(false, 'Ação inválida');
}
?>