# 🔍 SQL Performance Analyzer

**Projeto em desenvolvimento** para análise e otimização de queries SQL, com foco em segurança e performance.

## 🚀 Objetivo

Ferramenta para desenvolvedores que precisam:
- Identificar gargalos de performance em queries SQL
- Detectar vulnerabilidades de SQL Injection
- Sugerir otimizações baseadas em `EXPLAIN ANALYZE`

## ⚡ Features

### 🔒 Segurança
- Detecção de padrões de SQL Injection
- Análise de queries suspeitas
- Sugestão de prepared statements

### ⚡ Performance
- Benchmark de tempo de execução
- Análise com `EXPLAIN ANALYZE`
- Recomendação de índices faltantes

### 📊 Visualização
- Relatório de queries problemáticas
- Comparativo antes/depois das otimizações
- Histórico de performance

## 🛠️ Tecnologias

- **PHP 8.2+** (PDO, MySQLi)
- **MySQL 8.0** (EXPLAIN ANALYZE)
- **Docker** (ambiente isolado)
