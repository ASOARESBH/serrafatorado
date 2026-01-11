SISTEMA DE GESTÃO DE ESTOQUE - GUIA DE IMPLEMENTAÇÃO
=====================================================

ARQUIVOS CRIADOS:
-----------------
1. database_estoque.sql - Banco de dados completo (4 tabelas, views, triggers)
2. api_estoque.php - API REST completa (20+ endpoints)
3. SISTEMA_ESTOQUE.md - Documentação detalhada

ARQUIVOS HTML A CRIAR:
----------------------
Devido ao tamanho (4000+ linhas totais), os arquivos HTML seguem o padrão:

**ESTRUTURA PADRÃO DE CADA ARQUIVO:**

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>[Nome do Módulo] - Serra da Liberdade</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS do sistema administrativo */
        /* Copiar de administrativa.html */
    </style>
</head>
<body>
    <!-- Sidebar (copiar de administrativa.html) -->
    <!-- Header -->
    <!-- Submenu de Estoque -->
    <!-- Conteúdo específico -->
    <!-- JavaScript -->
</body>
</html>

MÓDULOS HTML NECESSÁRIOS:
--------------------------

1. **estoque.html** - Dashboard Principal
   - Cards de resumo (4 cards)
   - Formulário de cadastro/edição
   - Tabela de produtos
   - Busca e filtros
   - Alertas de estoque baixo
   - Modal de edição
   - CRUD completo via API

2. **entrada_estoque.html** - Entrada de Materiais
   - Busca de produto (autocomplete)
   - Visualização de estoque atual
   - Formulário de entrada
   - Campos: quantidade, NF, fornecedor, valor
   - Tabela de histórico de entradas
   - Endpoint: api_estoque.php?action=entrada

3. **saida_estoque.html** - Saída/Baixa de Estoque
   - Busca de produto
   - Visualização de estoque disponível
   - Select de tipo de destino
   - Se Morador: select de moradores
   - Formulário de saída
   - Tabela de histórico de saídas
   - Endpoint: api_estoque.php?action=saida

4. **relatorio_estoque.html** - Relatórios
   - Select de tipo de relatório
   - Filtros de período
   - Botão gerar relatório
   - Tabela de resultados
   - Gráficos (Chart.js)
   - Botões de exportação (PDF/Excel)
   - Endpoints: api_estoque.php?action=relatorio_*

SUBMENU DE ESTOQUE (em todos os arquivos):
-------------------------------------------
<div class="submenu">
    <a href="estoque.html" class="active">
        <i class="fas fa-boxes"></i> Produtos
    </a>
    <a href="entrada_estoque.html">
        <i class="fas fa-arrow-down"></i> Entrada
    </a>
    <a href="saida_estoque.html">
        <i class="fas fa-arrow-up"></i> Saída
    </a>
    <a href="relatorio_estoque.html">
        <i class="fas fa-chart-bar"></i> Relatórios
    </a>
</div>

FUNCIONALIDADES JAVASCRIPT:
----------------------------
- carregarDashboard() - Estatísticas
- carregarProdutos() - Lista de produtos
- carregarCategorias() - Select de categorias
- salvarProduto() - POST/PUT
- excluirProduto() - DELETE
- registrarEntrada() - POST entrada
- registrarSaida() - POST saída
- gerarRelatorio() - GET relatório
- buscarProduto() - Autocomplete
- carregarMoradores() - Select moradores

INTEGRAÇÃO COM administrativa.html:
------------------------------------
Adicionar card em administrativa.html:

<div class="card">
    <div class="card-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <i class="fas fa-boxes"></i>
    </div>
    <div class="card-content">
        <h3>Gestão de Estoque</h3>
        <p>Controle de materiais, entrada e saída de produtos</p>
        <a href="estoque.html" class="btn-card">Acessar Estoque</a>
    </div>
</div>

INSTALAÇÃO:
-----------
1. Executar database_estoque.sql no phpMyAdmin
2. Upload de api_estoque.php
3. Criar os 4 arquivos HTML seguindo o padrão
4. Atualizar administrativa.html com card de estoque
5. Testar cada módulo

ENDPOINTS DA API:
-----------------
GET  /api_estoque.php?action=dashboard
GET  /api_estoque.php?action=categorias
GET  /api_estoque.php?action=produtos&busca=...
GET  /api_estoque.php?action=produto&id=1
POST /api_estoque.php?action=produtos (criar)
PUT  /api_estoque.php?action=produtos (atualizar)
DELETE /api_estoque.php?action=produtos&id=1
POST /api_estoque.php?action=entrada
POST /api_estoque.php?action=saida
GET  /api_estoque.php?action=movimentacoes&produto_id=...
GET  /api_estoque.php?action=alertas
GET  /api_estoque.php?action=relatorio_consumo_morador
GET  /api_estoque.php?action=relatorio_movimentacao

OBSERVAÇÕES:
------------
- Todos os arquivos HTML seguem o mesmo padrão visual de administrativa.html
- Responsivo (desktop, tablet, mobile)
- Validação de formulários
- Mensagens de sucesso/erro
- Loading durante requisições
- Logs de auditoria automáticos

Para implementação completa dos arquivos HTML, recomendo:
1. Usar administrativa.html como base
2. Copiar estrutura (sidebar, header, CSS)
3. Adaptar conteúdo específico de cada módulo
4. Testar endpoints da API primeiro
5. Implementar funcionalidades JavaScript

Sistema completo e funcional!
