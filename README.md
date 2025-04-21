# 🔍 SQL Performance Analyzer

**Projeto em desenvolvimento** para análise e otimização de queries SQL, com foco em segurança e performance.

## 🚀 Objetivo

Ferramenta para desenvolvedores que precisam:
- Identificar gargalos de performance em queries SQL
- Detectar vulnerabilidades de SQL Injection
- Sugerir otimizações baseadas em `EXPLAIN ANALYZE`

## 🛠️ Tecnologias

- **PHP 8.2+** (PDO, MySQLi)
- **MySQL 8.0** (EXPLAIN ANALYZE)
- **Docker** (ambiente isolado)

## 🚀 Endpoints

### 1. `/api/analyze`

> Analisa uma query SQL do tipo `SELECT` e retorna sugestões de otimização (caso existam).

- **Método:** `POST`
- **Content-Type:** `application/json`

#### 📥 Exemplo de Requisição:

```bash
curl -X POST http://localhost/api/analyze \
     -H "Content-Type: application/json" \
     -d '{"query": "SELECT * FROM users WHERE id = 1"}'
```
### 2. `/api/checker`

> Verifica se uma query SQL possui padrões de SQL Injection ou comandos maliciosos.

- **Método:** `POST`
- **Content-Type:** `application/json`

#### 📥 Exemplo de Requisição:

```bash
curl -X POST http://localhost/api/checker \
     -H "Content-Type: application/json" \
     -d '{"query": "SELECT * FROM users WHERE username = '\''admin'\'' OR '\''1'\''='\''1'\'' --"}'
```
