# 📝 Changelog - Sistema Serra da Liberdade

Todas as mudanças notáveis neste projeto serão documentadas neste arquivo.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/),
e este projeto adere ao [Semantic Versioning](https://semver.org/lang/pt-BR/).

---

## [5.2] - 2026-01-11

### 🐛 Corrigido
- **[CRÍTICO]** Corrigido caminho da API em `frontend/moradores.html` linha 422
  - **Antes:** `fetch('api_moradores.php')` (sem prefixo `api/`)
  - **Depois:** `fetch('api/api_moradores.php')` (com prefixo `api/`)
  - **Impacto:** Resolvia erro "Unexpected token '<'" que impedia carregamento de moradores

### ✨ Adicionado
- Criado `teste_moradores.html` - Ferramenta completa de debug para API de moradores
  - Teste de listagem de moradores
  - Teste de busca com filtros
  - Teste de carregamento de unidades
  - Teste direto das APIs
  - Verificação de caminhos de API
  - Botão "Testar Tudo de Uma Vez"
- Criado `RELATORIO_V5.2.md` - Relatório detalhado das correções
- Criado `CHECKLIST_VALIDACAO_V5.2.md` - Checklist completo de validação
- Atualizado `README.md` com documentação completa do sistema
- Criado `CHANGELOG.md` (este arquivo)

### 📚 Documentação
- Documentação completa da arquitetura do sistema
- Guia de instalação e configuração
- Documentação de segurança e .htaccess
- Histórico de versões detalhado
- Roadmap de funcionalidades futuras

### 🔗 Commits
- `fadaab9` - v5.2 - Corrigido caminho da API em moradores.html (linha 422)
- `64fbd93` - docs: Adicionar relatório e checklist de validação v5.2
- `a00936c` - docs: Atualizar README.md com documentação completa v5.2

---

## [5.1] - 2026-01-XX

### 🐛 Corrigido
- **[CRÍTICO]** Corrigido `.htaccess` que estava bloqueando acesso a `/new/api/`
  - Ajustado `RewriteCond` para permitir caminhos `/new/api/`
  - Resolvido erro 403 Forbidden nas chamadas de API
  - APIs agora retornam JSON corretamente

### 🔒 Segurança
- Mantido bloqueio de acesso direto a arquivos PHP fora da pasta `api/`
- Separação frontend/backend preservada

---

## [5.0] - 2026-01-XX

### 🐛 Corrigido
- **[CRÍTICO]** Corrigido erro "Fatal error: Cannot redeclare sanitizar()"
  - Função `sanitizar()` estava declarada em múltiplos arquivos
  - Removido de `api_smtp.php` e `api_recuperacao_senha.php`
  - Mantida apenas em `config.php`
- Corrigido `config.php` para retornar JSON em erros (não `die()`)
  - Agora usa `retornar_json()` para erros de conexão
  - Frontend recebe resposta JSON estruturada

### ✨ Adicionado
- Função `retornar_json()` padronizada em `config.php`
- Tratamento de erros consistente em todas as APIs

---

## [4.4] - 2026-01-XX

### ✨ Adicionado
- Criado `api/debug_erros.php` - Visualizador de erros PHP
- Criado `teste_login.html` - Ferramenta de debug para login

### 🔧 Melhorado
- Melhorado tratamento de erros em APIs
- Adicionado logging detalhado

---

## [4.3] - 2026-01-XX

### ✨ Adicionado
- Implementada API v2.0 com tratamento de erros robusto
- Adicionado `api_dashboard_agua.php` v2.0

---

## [4.2] - 2026-01-XX

### 🐛 Corrigido
- Corrigido `api_dashboard_agua.php` para retornar JSON válido
- Removido HTML misturado com JSON

---

## [4.1] - 2026-01-XX

### ✨ Adicionado
- Criadas ferramentas de debug iniciais
- Implementado sistema de logs

---

## [4.0] - 2026-01-XX

### 🐛 Corrigido
- **[CRÍTICO]** Corrigido sistema de login
  - `validar_login.php` agora funciona corretamente
  - Sessão é criada e mantida por 2 horas
  - Redirecionamento para dashboard funciona

### ✨ Adicionado
- Sistema de gerenciamento de sessão completo
- `sessao_manager.js` - Verificação automática de sessão a cada 5 minutos
- Renovação automática de sessão em ações do usuário

---

## [3.0] - 2026-01-XX

### 🔧 Melhorado
- Continuação da atualização de caminhos de API
- Mais 80 chamadas de API corrigidas

---

## [2.0] - 2026-01-XX

### 🔧 Melhorado
- Continuação da atualização de caminhos de API
- Mais 70 chamadas de API corrigidas

---

## [1.0] - 2026-01-XX

### 🔧 Melhorado
- **Reorganização completa da estrutura do sistema**
- Separação de frontend (HTML) e backend (PHP/API)
- Atualização de 221 chamadas de API em 60 arquivos HTML
- Caminhos atualizados de `api_file.php` para `api/api_file.php`

### 🔒 Segurança
- Implementado `.htaccess` para bloquear acesso direto a PHP
- Apenas APIs em `/api/` são acessíveis diretamente

### 📁 Estrutura
- Criada pasta `/frontend/` para arquivos HTML
- Criada pasta `/api/` para arquivos PHP
- Criada pasta `/js/` para scripts compartilhados
- Criada pasta `/css/` para estilos compartilhados

---

## Legenda de Tipos de Mudança

- ✨ **Adicionado** - Novas funcionalidades
- 🔧 **Melhorado** - Melhorias em funcionalidades existentes
- 🐛 **Corrigido** - Correções de bugs
- 🔒 **Segurança** - Correções de vulnerabilidades
- 📚 **Documentação** - Mudanças na documentação
- 🗑️ **Removido** - Funcionalidades removidas
- 💥 **Breaking Changes** - Mudanças que quebram compatibilidade

---

## Links Úteis

- **Repositório:** https://github.com/andreprogramadorbh-ai/serrafatorado
- **Documentação:** [README.md](README.md)
- **Relatório v5.2:** [RELATORIO_V5.2.md](RELATORIO_V5.2.md)
- **Checklist v5.2:** [CHECKLIST_VALIDACAO_V5.2.md](CHECKLIST_VALIDACAO_V5.2.md)

---

**Última Atualização:** 11 de Janeiro de 2026
