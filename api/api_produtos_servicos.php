<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

function resposta($sucesso, $mensagem, $dados = null) {
    echo json_encode(['sucesso' => $sucesso, 'mensagem' => $mensagem, 'dados' => $dados], JSON_UNESCAPED_UNICODE);
    exit;
}

$acao = $_GET['acao'] ?? $_POST['acao'] ?? '';

switch ($acao) {
    case 'listar':
        $fornecedor_id = intval($_GET['fornecedor_id'] ?? 0);
        $sql = "SELECT * FROM produtos_servicos WHERE ativo=1";
        if ($fornecedor_id > 0) $sql .= " AND fornecedor_id=$fornecedor_id";
        $sql .= " ORDER BY nome";
        
        $result = mysqli_query($conn, $sql);
        $produtos = [];
        while ($row = mysqli_fetch_assoc($result)) $produtos[] = $row;
        resposta(true, 'Produtos carregados', $produtos);
        break;
    
    case 'salvar':
        $id = intval($_POST['id'] ?? 0);
        $fornecedor_id = intval($_POST['fornecedor_id']);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao'] ?? '');
        $valor = floatval($_POST['valor'] ?? 0);
        
        if ($id > 0) {
            $sql = "UPDATE produtos_servicos SET nome='$nome', tipo='$tipo', descricao='$descricao', valor=$valor WHERE id=$id";
        } else {
            $sql = "INSERT INTO produtos_servicos (fornecedor_id, nome, tipo, descricao, valor) 
                    VALUES ($fornecedor_id, '$nome', '$tipo', '$descricao', $valor)";
        }
        
        mysqli_query($conn, $sql) ? resposta(true, 'Salvo') : resposta(false, 'Erro');
        break;
    
    case 'excluir':
        $id = intval($_POST['id']);
        $sql = "UPDATE produtos_servicos SET ativo=0 WHERE id=$id";
        mysqli_query($conn, $sql) ? resposta(true, 'Excluído') : resposta(false, 'Erro');
        break;
    
    default:
        resposta(false, 'Ação inválida');
}
?>