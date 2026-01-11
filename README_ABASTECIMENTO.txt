=====================================================
MÓDULO DE CONTROLE DE ABASTECIMENTO
Sistema Serra da Liberdade
=====================================================

RESUMO:
-------
Módulo completo para gerenciar o abastecimento dos veículos
do condomínio, incluindo cadastro de veículos, lançamentos,
sistema de crédito/débito e relatórios detalhados.

ARQUIVOS INCLUÍDOS:
-------------------
1. abastecimento.html ............. Interface principal (53KB)
2. api_abastecimento.php .......... API backend (15KB)
3. sql_abastecimento.sql .......... Script do banco (5KB)
4. DOCUMENTACAO_ABASTECIMENTO.md .. Documentação completa (11KB)
5. INSTALACAO_ABASTECIMENTO.txt ... Instruções de instalação
6. manutencao.html ................ Atualizado com link do módulo

INSTALAÇÃO RÁPIDA:
------------------
1. Execute sql_abastecimento.sql no banco de dados
2. Copie os arquivos para o servidor
3. Acesse: Manutenção > Abastecimento
4. Cadastre um veículo e faça uma recarga inicial

FUNCIONALIDADES:
----------------
✓ Cadastro de Veículos (bloqueio de edição após cadastro)
✓ Validação de Placa (formato antigo ABC-1234 e Mercosul ABC1D23)
✓ Lançamento de Abastecimento (com validação de KM)
✓ Sistema de Recarga (crédito/débito)
✓ Display de Saldo (verde/amarelo/vermelho)
✓ Relatórios com Filtros (veículo, período, combustível)
✓ Cálculo Automático de Consumo (km/L)
✓ Log de Auditoria (registra usuário logado)
✓ Interface Responsiva (mobile-friendly)

ESTRUTURA DO BANCO:
-------------------
- abastecimento_veiculos ....... Cadastro de veículos
- abastecimento_lancamentos .... Registros de abastecimento
- abastecimento_recargas ....... Histórico de recargas
- abastecimento_saldo .......... Saldo atual do sistema

REGRAS IMPORTANTES:
-------------------
• Veículos não podem ser editados após cadastro
• KM deve ser sempre crescente
• Saldo pode ficar negativo (com alerta)
• Placas são únicas no sistema
• Sistema registra usuário logado automaticamente

DOCUMENTAÇÃO COMPLETA:
----------------------
Consulte DOCUMENTACAO_ABASTECIMENTO.md para detalhes
completos sobre funcionalidades, fluxos e manutenção.

SUPORTE:
--------
Para dúvidas, consulte a documentação ou entre em
contato com o suporte técnico.

Desenvolvido para: Serra da Liberdade
Data: Novembro 2025
Versão: 1.0
=====================================================
