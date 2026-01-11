=====================================================
SISTEMA DE ACESSO PARA MORADORES
Serra da Liberdade - Controle de Acesso
=====================================================

NOVOS ARQUIVOS CRIADOS:
========================

1. login_morador.html
   - Página de login exclusiva para moradores
   - Autenticação via CPF e senha
   - Aceita CPF com ou sem formatação (pontos e traço)
   - Link para voltar ao login administrativo

2. validar_login_morador.php
   - Valida credenciais do morador no banco de dados
   - Compara CPF sem formatação (remove pontos e traço)
   - Verifica senha criptografada com password_verify()
   - Cria sessão específica para morador
   - Registra logs de acesso

3. verificar_sessao_morador.php
   - Verifica se o morador está logado
   - Controla timeout de sessão (2 horas)
   - Redireciona para login se sessão inválida

4. logout_morador.php
   - Encerra sessão do morador
   - Registra log de logout
   - Redireciona para página de login

5. acesso_morador.html
   - Página principal da área do morador
   - 3 abas: Meu Cadastro, Meus Veículos, Meus Protocolos
   - Interface responsiva e moderna
   - Integração com APIs via JavaScript

6. api_morador_dados.php
   - API para obter e atualizar dados do morador logado
   - Permite edição de: email, telefone, celular e CPF
   - Valida unicidade de CPF
   - Atualiza sessão após alterações

7. api_morador_veiculos.php
   - API CRUD completa para veículos do morador
   - Gera TAG automática (TAGM001, TAGM002, etc.)
   - Vincula veículo automaticamente à unidade do morador
   - Permite adicionar, editar e excluir veículos
   - Validação de placa única no sistema

8. api_morador_protocolos.php
   - API para listar protocolos do morador
   - Filtra protocolos por status (pendente/entregue)
   - Exibe apenas protocolos vinculados ao morador logado
   - Modo somente leitura (morador não pode alterar)

FUNCIONALIDADES IMPLEMENTADAS:
===============================

✅ Login do Morador:
   - Autenticação via CPF e senha
   - Aceita CPF com ou sem formatação
   - Validação de morador ativo
   - Sessão segura com timeout

✅ Meu Cadastro:
   - Visualização de todos os dados
   - Edição de: email, telefone, celular e CPF
   - Campos não editáveis: nome e unidade
   - Validação de CPF único
   - Máscaras automáticas nos campos

✅ Meus Veículos:
   - Listagem de veículos do morador
   - Cadastro de novos veículos (placa, modelo, cor)
   - TAG gerada automaticamente (TAGM001, TAGM002, etc.)
   - Edição de veículos existentes
   - Exclusão de veículos
   - Vinculação automática à unidade do morador
   - Validação de placa única

✅ Meus Protocolos:
   - Listagem de todos os protocolos do morador
   - Filtro por status (todos, pendentes, entregues)
   - Visualização de: descrição, código NF, data de recebimento
   - Informações de quem recebeu na portaria
   - Data de entrega (quando aplicável)
   - Modo somente leitura

INSTRUÇÕES DE INSTALAÇÃO:
==========================

1. COPIAR ARQUIVOS:
   - Copie todos os novos arquivos para o diretório raiz do sistema
   - Mantenha a estrutura de pastas existente

2. BANCO DE DADOS:
   - Não é necessário criar novas tabelas
   - O sistema utiliza as tabelas existentes:
     * moradores (já existe)
     * veiculos (já existe)
     * protocolos (já existe)
     * unidades (já existe)

3. PERMISSÕES:
   - Certifique-se de que os arquivos PHP têm permissão de execução
   - O servidor web deve ter acesso ao arquivo config.php

4. CONFIGURAÇÃO:
   - Não é necessária configuração adicional
   - O sistema usa as mesmas configurações do config.php

COMO USAR:
==========

1. ACESSO DO MORADOR:
   - Acesse: http://seudominio.com/login_morador.html
   - Digite o CPF (com ou sem formatação)
   - Digite a senha cadastrada no sistema
   - Clique em "Entrar"

2. ÁREA DO MORADOR:
   - Após login, o morador é redirecionado para acesso_morador.html
   - Pode navegar entre as 3 abas:
     * Meu Cadastro: editar dados pessoais
     * Meus Veículos: gerenciar veículos
     * Meus Protocolos: visualizar entregas

3. CADASTRO DE VEÍCULOS:
   - Na aba "Meus Veículos"
   - Preencha: placa, modelo e cor
   - Clique em "Salvar Veículo"
   - A TAG será gerada automaticamente (TAGM001, TAGM002, etc.)
   - O veículo será vinculado automaticamente à unidade do morador

4. EDIÇÃO DE DADOS:
   - Na aba "Meu Cadastro"
   - Edite os campos permitidos
   - Clique em "Salvar Alterações"

5. VISUALIZAÇÃO DE PROTOCOLOS:
   - Na aba "Meus Protocolos"
   - Use o filtro para ver apenas pendentes ou entregues
   - Visualize detalhes de cada protocolo

SEGURANÇA:
==========

✅ Sessões separadas (morador e administrador)
✅ Validação de sessão em todas as páginas
✅ Timeout de sessão (2 horas de inatividade)
✅ Senhas criptografadas com password_hash()
✅ Proteção contra SQL Injection (prepared statements)
✅ Validação de dados no servidor
✅ Logs de todas as ações do morador
✅ Morador só pode acessar seus próprios dados

OBSERVAÇÕES IMPORTANTES:
========================

1. CPF FLEXÍVEL:
   - O sistema aceita CPF com ou sem formatação
   - Exemplos válidos:
     * 123.456.789-00
     * 12345678900
   - A comparação é feita sem formatação

2. TAG AUTOMÁTICA:
   - A TAG é gerada automaticamente como TAGM001
   - O número incrementa para cada veículo do morador
   - Não é necessário informar a TAG no cadastro

3. VINCULAÇÃO AUTOMÁTICA:
   - Veículos são vinculados automaticamente à unidade do morador
   - Não é necessário selecionar morador ou unidade

4. PROTOCOLOS SOMENTE LEITURA:
   - Moradores podem apenas visualizar protocolos
   - Não podem alterar status ou dados
   - Alterações devem ser feitas pela administração

5. COMPATIBILIDADE:
   - Sistema totalmente compatível com o sistema existente
   - Não interfere nas funcionalidades administrativas
   - Usa as mesmas tabelas do banco de dados

SUPORTE:
========

Em caso de dúvidas ou problemas:
- Verifique os logs do sistema em logs_sistema
- Verifique o error_log do PHP
- Certifique-se de que config.php está configurado corretamente

=====================================================
FIM DO DOCUMENTO
=====================================================
