# 🏢 Sistema de Portaria Serra da Liberdade

**Versão:** 5.2  
**Data:** 11 de Janeiro de 2026  
**Status:** ✅ Em Produção  
**Repositório:** https://github.com/andreprogramadorbh-ai/serrafatorado

---

## 📋 Sobre o Sistema

Sistema ERP completo para gestão de portaria, moradores, veículos, visitantes e controle de acesso para o condomínio Serra da Liberdade.

### Principais Funcionalidades

- 🔐 **Sistema de Login** com autenticação segura e sessão de 2 horas
- 👥 **Gestão de Moradores** - Cadastro, edição, busca e filtros avançados
- 🚗 **Gestão de Veículos** - Controle de veículos dos moradores
- 👋 **Gestão de Visitantes** - Registro e controle de acesso de visitantes
- 📊 **Dashboard** - Visualização de dados e gráficos em tempo real
- 💧 **Controle de Água** - Monitoramento de consumo de água
- 📝 **Protocolo** - Sistema de protocolos e solicitações
- 👤 **Gestão de Usuários** - Controle de usuários do sistema
- 📋 **Logs do Sistema** - Registro de todas as ações realizadas
- 🔧 **Configurações** - SMTP, templates de email, e mais

---

## 🏗️ Arquitetura do Sistema

### Estrutura de Diretórios

```
/new/
├── frontend/           # Interface HTML/CSS/JS
│   ├── login.html
│   ├── dashboard.html
│   ├── moradores.html
│   ├── veiculos.html
│   ├── visitantes.html
│   └── ... (outros módulos)
├── api/               # APIs PHP (backend)
│   ├── config.php
│   ├── api_moradores.php
│   ├── api_veiculos.php
│   ├── api_visitantes.php
│   ├── validar_login.php
│   ├── verificar_sessao_completa.php
│   └── ... (outras APIs)
├── js/                # Scripts JavaScript compartilhados
│   └── sessao_manager.js
├── css/               # Estilos CSS compartilhados
├── .htaccess          # Configuração de segurança Apache
├── teste_moradores.html    # Ferramenta de debug
└── README.md          # Este arquivo
```

### Tecnologias Utilizadas

- **Backend:** PHP 7.4+ com MySQLi
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Banco de Dados:** MySQL 5.7+
- **Servidor Web:** Apache 2.4+ com mod_rewrite
- **Autenticação:** Session-based com timeout de 2 horas
- **Segurança:** .htaccess para bloqueio de acesso direto a PHP

---

## 🔒 Segurança

### Separação Frontend/Backend

O sistema foi reorganizado para separar completamente o frontend (HTML) do backend (PHP/API):

- **Frontend (`/frontend/`):** Contém apenas arquivos HTML, CSS e JavaScript
- **Backend (`/api/`):** Contém todas as APIs PHP que acessam o banco de dados

### Regras de Segurança (.htaccess)

```apache
# Bloquear acesso direto a arquivos PHP fora da pasta api/
RewriteCond %{REQUEST_URI} \.php$ [NC]
RewriteCond %{REQUEST_URI} !^/new/api/ [NC]
RewriteRule .* - [F,L]
```

**Resultado:**
- ✅ Permitido: `/new/api/api_moradores.php`
- ❌ Bloqueado: `/new/frontend/moradores.php`
- ❌ Bloqueado: `/new/config.php`

### Autenticação e Sessão

- **Timeout:** 2 horas de inatividade
- **Verificação Automática:** `sessao_manager.js` verifica sessão a cada 5 minutos
- **Renovação:** Sessão é renovada automaticamente em ações do usuário
- **Redirecionamento:** Usuário não autenticado é redirecionado para login

---

## 🚀 Instalação

### Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Apache 2.4+ com mod_rewrite habilitado
- Extensões PHP: mysqli, json, session

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/andreprogramadorbh-ai/serrafatorado.git
   ```

2. **Configure o banco de dados:**
   - Crie um banco de dados MySQL
   - Importe o schema SQL (se disponível)
   - Atualize as credenciais em `/api/config.php`

3. **Configure o .htaccess:**
   - Ajuste o caminho base se necessário (atualmente `/new/`)
   - Verifique se mod_rewrite está habilitado

4. **Configure permissões:**
   ```bash
   chmod 644 *.php
   chmod 755 api/
   chmod 755 frontend/
   ```

5. **Acesse o sistema:**
   ```
   https://seu-dominio.com/new/frontend/login.html
   ```

---

## 🧪 Ferramentas de Debug

### teste_moradores.html

Ferramenta completa para diagnóstico de problemas na API de moradores.

**URL:** `https://seu-dominio.com/new/teste_moradores.html`

**Funcionalidades:**
- ✅ Teste de listagem de moradores
- ✅ Teste de busca com filtros
- ✅ Teste de carregamento de unidades
- ✅ Teste direto das APIs (abre em nova aba)
- ✅ Verificação de diferentes caminhos de API
- ✅ Botão "Testar Tudo" para executar todos os testes

### debug_erros.php

Visualizador de erros PHP em tempo real.

**URL:** `https://seu-dominio.com/new/api/debug_erros.php`

**Funcionalidades:**
- Exibe últimos erros PHP do error_log
- Mostra erros de SQL
- Útil para diagnóstico rápido

---

## 📊 Banco de Dados

### Tabelas Principais

- **moradores** - Cadastro de moradores (184 registros)
- **veiculos** - Veículos dos moradores
- **visitantes** - Registro de visitantes
- **usuarios** - Usuários do sistema
- **logs** - Logs de ações do sistema
- **unidades** - Unidades do condomínio
- **hidrometros** - Leituras de hidrômetros
- **protocolos** - Protocolos e solicitações

### Conexão com Banco

```php
// api/config.php
$host = 'localhost';
$usuario = 'inlaud99_erpserra';
$senha = 'sua_senha_aqui';
$banco = 'inlaud99_erpserra';
```

---

## 📝 Histórico de Versões

### v5.2 (11/01/2026) - ATUAL
- ✅ **Correção crítica:** Caminho da API em moradores.html (linha 422)
- ✅ Criado teste_moradores.html para debug
- ✅ Adicionado relatório RELATORIO_V5.2.md
- ✅ Adicionado checklist CHECKLIST_VALIDACAO_V5.2.md
- ✅ Corrigido erro "Unexpected token '<'" na listagem de moradores

### v5.1 (Data anterior)
- ✅ Correção do .htaccess para permitir /new/api/
- ✅ Ajustado RewriteCond para não bloquear APIs
- ✅ Resolvido erro 403 Forbidden nas APIs

### v5.0 (Data anterior)
- ✅ Correção da função sanitizar() duplicada
- ✅ Removido duplicação em api_smtp.php e api_recuperacao_senha.php
- ✅ config.php agora retorna JSON em erros (não die())

### v4.0-v4.4 (Data anterior)
- ✅ Correção do login e gerenciamento de sessão
- ✅ Criação de ferramentas de debug
- ✅ Implementação da API v2.0 com tratamento de erros

### v1.0-v3.0 (Data anterior)
- ✅ Correção de 221 chamadas de API em 60 arquivos HTML
- ✅ Atualização de caminhos de `api_file.php` para `api/api_file.php`
- ✅ Reorganização da estrutura frontend/backend

---

## 🐛 Problemas Conhecidos e Soluções

### ❌ Erro: "Unexpected token '<'"
**Status:** ✅ RESOLVIDO na v5.2

**Causa:** Caminho incorreto da API (sem prefixo `api/`)

**Solução:** Corrigir caminho de `api_moradores.php` para `api/api_moradores.php`

---

### ❌ Erro: 403 Forbidden ao acessar API
**Status:** ✅ RESOLVIDO na v5.1

**Causa:** .htaccess bloqueando /new/api/

**Solução:** Ajustar RewriteCond no .htaccess:
```apache
RewriteCond %{REQUEST_URI} !^/new/api/ [NC]
```

---

### ❌ Erro: Fatal error - Cannot redeclare sanitizar()
**Status:** ✅ RESOLVIDO na v5.0

**Causa:** Função sanitizar() declarada em múltiplos arquivos

**Solução:** Manter sanitizar() apenas em config.php e remover de outros arquivos

---

## 📞 Suporte e Contato

### Desenvolvedor
**Nome:** André Programador BH AI  
**GitHub:** https://github.com/andreprogramadorbh-ai

### Repositório
**URL:** https://github.com/andreprogramadorbh-ai/serrafatorado  
**Branch Principal:** main

### Documentação Adicional
- [RELATORIO_V5.2.md](RELATORIO_V5.2.md) - Relatório detalhado da versão 5.2
- [CHECKLIST_VALIDACAO_V5.2.md](CHECKLIST_VALIDACAO_V5.2.md) - Checklist completo de validação

---

## 🎯 Roadmap

### Próximas Funcionalidades
- [ ] Sistema de notificações push
- [ ] Geração de QR Code para visitantes
- [ ] Integração com reconhecimento facial
- [ ] App mobile (React Native)
- [ ] Relatórios em PDF
- [ ] Dashboard com mais gráficos
- [ ] Sistema de backup automático

### Melhorias Planejadas
- [ ] Implementar testes automatizados
- [ ] Otimizar consultas SQL
- [ ] Implementar cache de dados
- [ ] Melhorar responsividade mobile
- [ ] Adicionar dark mode
- [ ] Implementar paginação em todas as listagens

---

## 📄 Licença

Este projeto é proprietário e de uso exclusivo do condomínio Serra da Liberdade.

---

## 🙏 Agradecimentos

Desenvolvido com dedicação para melhorar a gestão e segurança do condomínio Serra da Liberdade.

---

**Última Atualização:** 11 de Janeiro de 2026  
**Versão do README:** 1.0
