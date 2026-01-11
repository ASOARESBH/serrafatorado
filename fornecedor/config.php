<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'inlaud99_fornecedor');
define('DB_USER', 'inlaud99_admin');
define('DB_PASS', 'Admin259087@');

// Configurações do Sistema
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
define('SITE_NAME', 'Sistema de Fornecedores - Associação Serra da Liberdade');

// Função para conectar ao banco
function getConnection() {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die('Erro de conexão: ' . $e->getMessage());
    }
}
?>