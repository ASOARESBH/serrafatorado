<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

function resposta($sucesso, $mensagem, $dados = null) {
    echo json_encode(['sucesso' => $sucesso, 'mensagem' => $mensagem, 'dados' => $dados], JSON_UNESCAPED_UNICODE);
    exit;
}

$acao = $_GET['acao'] ?? $_POST['acao'] ?? '';

switch ($acao) {
    case 'listar_morador':
        $morador_id = intval($_GET['morador_id']);
        $sql = "SELECT * FROM v_pedidos_completo WHERE morador_id=$morador_id ORDER BY data_pedido DESC";
        $result = mysqli_query($conn, $sql);
        $pedidos = [];
        while ($row = mysqli_fetch_assoc($result)) $pedidos[] = $row;
        resposta(true, 'Pedidos carregados', $pedidos);
        break;
    
    case 'listar_fornecedor':
        $fornecedor_id = intval($_GET['fornecedor_id']);
        $sql = "SELECT * FROM v_pedidos_completo WHERE fornecedor_id=$fornecedor_id ORDER BY data_pedido DESC";
        $result = mysqli_query($conn, $sql);
        $pedidos = [];
        while ($row = mysqli_fetch_assoc($result)) $pedidos[] = $row;
        resposta(true, 'Pedidos carregados', $pedidos);
        break;
    
    case 'criar':
        $morador_id = intval($_POST['morador_id']);
        $fornecedor_id = intval($_POST['fornecedor_id']);
        $produto_id = intval($_POST['produto_servico_id'] ?? 0) ?: 'NULL';
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao_pedido']);
        $valor = floatval($_POST['valor_proposto'] ?? 0) ?: 'NULL';
        
        $sql = "INSERT INTO pedidos (morador_id, fornecedor_id, produto_servico_id, descricao_pedido, valor_proposto, status) 
                VALUES ($morador_id, $fornecedor_id, $produto_id, '$descricao', $valor, 'enviado')";
        
        mysqli_query($conn, $sql) ? resposta(true, 'Pedido enviado!') : resposta(false, 'Erro');
        break;
    
    case 'atualizar_status':
        $id = intval($_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $motivo = mysqli_real_escape_string($conn, $_POST['motivo_recusa'] ?? '');
        
        $sql = "UPDATE pedidos SET status='$status'";
        if ($status == 'recusado') $sql .= ", motivo_recusa='$motivo'";
        if ($status == 'aceito') $sql .= ", data_aceite=NOW()";
        if ($status == 'em_execucao') $sql .= ", data_inicio_execucao=NOW()";
        $sql .= " WHERE id=$id";
        
        mysqli_query($conn, $sql) ? resposta(true, 'Status atualizado') : resposta(false, 'Erro');
        break;
    
    default:
        resposta(false, 'Ação inválida');
}
?>