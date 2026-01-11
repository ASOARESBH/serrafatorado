<?php
// =====================================================
// API DE FORNECEDORES
// =====================================================

require_once 'config.php';

$acao = $_GET['acao'] ?? $_POST['acao'] ?? '';
$metodo = $_SERVER['REQUEST_METHOD'];

// ========== LISTAR FORNECEDORES ==========
if ($acao === 'listar' && $metodo === 'GET') {
    $conexao = conectar_banco();
    
    $sql = "SELECT * FROM v_fornecedores_completo WHERE ativo=1 ORDER BY nome_estabelecimento";
    $result = $conexao->query($sql);
    
    if (!$result) {
        retornar_json(false, 'Erro ao listar fornecedores: ' . $conexao->error);
    }
    
    $fornecedores = [];
    while ($row = $result->fetch_assoc()) {
        $fornecedores[] = $row;
    }
    
    fechar_conexao($conexao);
    retornar_json(true, 'Fornecedores carregados', $fornecedores);
}

// ========== CADASTRAR FORNECEDOR ==========
if ($acao === 'cadastrar' && $metodo === 'POST') {
    $conexao = conectar_banco();
    
    // Obter dados do formulário
    $cpf_cnpj = trim($_POST['cpf_cnpj'] ?? '');
    $nome = trim($_POST['nome_estabelecimento'] ?? '');
    $ramo = intval($_POST['ramo_atividade_id'] ?? 0);
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $nome_responsavel = trim($_POST['nome_responsavel'] ?? '');
    
    // Validações
    if (empty($cpf_cnpj)) {
        fechar_conexao($conexao);
        retornar_json(false, 'CPF/CNPJ é obrigatório');
    }
    
    if (empty($nome)) {
        fechar_conexao($conexao);
        retornar_json(false, 'Nome do estabelecimento é obrigatório');
    }
    
    if ($ramo <= 0) {
        fechar_conexao($conexao);
        retornar_json(false, 'Ramo de atividade é obrigatório');
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        fechar_conexao($conexao);
        retornar_json(false, 'E-mail válido é obrigatório');
    }
    
    if (strlen($senha) < 6) {
        fechar_conexao($conexao);
        retornar_json(false, 'Senha deve ter no mínimo 6 caracteres');
    }
    
    // Verificar se CPF/CNPJ já existe
    $sql_check = "SELECT id FROM fornecedores WHERE cpf_cnpj = ?";
    $stmt_check = $conexao->prepare($sql_check);
    
    if (!$stmt_check) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar consulta: ' . $conexao->error);
    }
    
    $stmt_check->bind_param("s", $cpf_cnpj);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        $stmt_check->close();
        fechar_conexao($conexao);
        retornar_json(false, 'CPF/CNPJ já cadastrado no sistema');
    }
    
    $stmt_check->close();
    
    // Verificar se e-mail já existe
    $sql_check_email = "SELECT id FROM fornecedores WHERE email = ?";
    $stmt_check_email = $conexao->prepare($sql_check_email);
    
    if (!$stmt_check_email) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar consulta: ' . $conexao->error);
    }
    
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_check_email = $stmt_check_email->get_result();
    
    if ($result_check_email->num_rows > 0) {
        $stmt_check_email->close();
        fechar_conexao($conexao);
        retornar_json(false, 'E-mail já cadastrado no sistema');
    }
    
    $stmt_check_email->close();
    
    // Hash da senha com bcrypt
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    // Inserir fornecedor com prepared statement
    $sql_insert = "INSERT INTO fornecedores 
                   (cpf_cnpj, nome_estabelecimento, nome_responsavel, ramo_atividade_id, email, senha, telefone, endereco, ativo, aprovado, data_cadastro) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, 0, NOW())";
    
    $stmt_insert = $conexao->prepare($sql_insert);
    
    if (!$stmt_insert) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar insert: ' . $conexao->error);
    }
    
    // Bind parameters: s=string, i=integer
    $stmt_insert->bind_param(
        "sssisss",
        $cpf_cnpj,
        $nome,
        $nome_responsavel,
        $ramo,
        $email,
        $senha_hash,
        $telefone,
        $endereco
    );
    
    if ($stmt_insert->execute()) {
        $novo_id = $stmt_insert->insert_id;
        $stmt_insert->close();
        fechar_conexao($conexao);
        
        // Registrar log
        registrar_log('FORNECEDOR_CADASTRO', 'Novo fornecedor cadastrado: ' . $nome . ' (' . $email . ')');
        
        retornar_json(true, 'Cadastro realizado com sucesso! Aguarde aprovação do administrador.', ['id' => $novo_id]);
    } else {
        $erro = $stmt_insert->error;
        $stmt_insert->close();
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao cadastrar: ' . $erro);
    }
}

// ========== ATUALIZAR FORNECEDOR ==========
if ($acao === 'atualizar' && $metodo === 'POST') {
    $conexao = conectar_banco();
    
    $id = intval($_POST['id'] ?? 0);
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if ($id <= 0) {
        fechar_conexao($conexao);
        retornar_json(false, 'ID inválido');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        fechar_conexao($conexao);
        retornar_json(false, 'E-mail inválido');
    }
    
    $sql_update = "UPDATE fornecedores SET telefone=?, endereco=?, email=?, data_atualizacao=NOW() WHERE id=?";
    $stmt_update = $conexao->prepare($sql_update);
    
    if (!$stmt_update) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar update: ' . $conexao->error);
    }
    
    $stmt_update->bind_param("sssi", $telefone, $endereco, $email, $id);
    
    if ($stmt_update->execute()) {
        $stmt_update->close();
        fechar_conexao($conexao);
        retornar_json(true, 'Fornecedor atualizado com sucesso');
    } else {
        $erro = $stmt_update->error;
        $stmt_update->close();
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao atualizar: ' . $erro);
    }
}

// ========== BUSCAR FORNECEDOR ==========
if ($acao === 'buscar' && $metodo === 'GET') {
    $conexao = conectar_banco();
    
    $id = intval($_GET['id'] ?? 0);
    
    if ($id <= 0) {
        fechar_conexao($conexao);
        retornar_json(false, 'ID inválido');
    }
    
    $sql_buscar = "SELECT * FROM v_fornecedores_completo WHERE id=?";
    $stmt_buscar = $conexao->prepare($sql_buscar);
    
    if (!$stmt_buscar) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar consulta: ' . $conexao->error);
    }
    
    $stmt_buscar->bind_param("i", $id);
    $stmt_buscar->execute();
    $result_buscar = $stmt_buscar->get_result();
    
    if ($result_buscar->num_rows > 0) {
        $fornecedor = $result_buscar->fetch_assoc();
        $stmt_buscar->close();
        fechar_conexao($conexao);
        retornar_json(true, 'Fornecedor encontrado', $fornecedor);
    } else {
        $stmt_buscar->close();
        fechar_conexao($conexao);
        retornar_json(false, 'Fornecedor não encontrado');
    }
}

// ========== DELETAR FORNECEDOR ==========
if ($acao === 'deletar' && $metodo === 'POST') {
    $conexao = conectar_banco();
    
    $id = intval($_POST['id'] ?? 0);
    
    if ($id <= 0) {
        fechar_conexao($conexao);
        retornar_json(false, 'ID inválido');
    }
    
    $sql_delete = "UPDATE fornecedores SET ativo=0, data_atualizacao=NOW() WHERE id=?";
    $stmt_delete = $conexao->prepare($sql_delete);
    
    if (!$stmt_delete) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar delete: ' . $conexao->error);
    }
    
    $stmt_delete->bind_param("i", $id);
    
    if ($stmt_delete->execute()) {
        $stmt_delete->close();
        fechar_conexao($conexao);
        retornar_json(true, 'Fornecedor deletado com sucesso');
    } else {
        $erro = $stmt_delete->error;
        $stmt_delete->close();
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao deletar: ' . $erro);
    }
}

// ========== APROVAR FORNECEDOR ==========
if ($acao === 'aprovar' && $metodo === 'POST') {
    $conexao = conectar_banco();
    
    $id = intval($_POST['id'] ?? 0);
    
    if ($id <= 0) {
        fechar_conexao($conexao);
        retornar_json(false, 'ID inválido');
    }
    
    $sql_aprovar = "UPDATE fornecedores SET aprovado=1, data_atualizacao=NOW() WHERE id=?";
    $stmt_aprovar = $conexao->prepare($sql_aprovar);
    
    if (!$stmt_aprovar) {
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao preparar aprovação: ' . $conexao->error);
    }
    
    $stmt_aprovar->bind_param("i", $id);
    
    if ($stmt_aprovar->execute()) {
        $stmt_aprovar->close();
        fechar_conexao($conexao);
        retornar_json(true, 'Fornecedor aprovado com sucesso');
    } else {
        $erro = $stmt_aprovar->error;
        $stmt_aprovar->close();
        fechar_conexao($conexao);
        retornar_json(false, 'Erro ao aprovar: ' . $erro);
    }
}

// ========== AÇÃO INVÁLIDA ==========
fechar_conexao($conexao ?? null);
retornar_json(false, 'Ação inválida ou método não permitido');
?>
