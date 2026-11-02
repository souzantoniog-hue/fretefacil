# FreteFácil — Gerenciador Logístico

Sistema web para gerenciar fretes: cadastro de produtos, endereços e transportadores, geração de fretes com vários produtos e relatório diário para download.

Projeto da Atividade Prática Orientada (APO) da disciplina **Fundamentos de Programação para Internet**.

- **Aluno:** Antonio  Souza Gomes
- **RA:** 09066822
- **Curso:** Sistemas de Informação — UNIPAR EAD
- **Polo:** Cascavel-PR

## Funcionalidades

- CRUD de **produtos** (nome, descrição, peso e medidas)
- CRUD de **endereços** (origem e destino)
- CRUD de **transportadores**
- **Gerar frete**: 1 transportador, origem, destino e vários produtos
- **Campos dinâmicos em JavaScript** para adicionar e remover produtos do frete
- **Lista de fretes** com valores e datas no formato brasileiro
- **Relatório dos fretes de um dia**, com download em CSV (abre no Excel)
- Proteção ao excluir registros que já estão em um frete

## Tecnologias

- HTML, CSS e JavaScript
- Bootstrap 5
- PHP 8 (com PDO)
- MySQL
- XAMPP
- Git e GitHub

## Estrutura de pastas

```
fretefacil/
├── assets/js/        → JavaScript dos campos dinâmicos
├── config/           → conexão com o banco
├── database/         → script SQL de criação do banco
├── includes/         → cabeçalho e rodapé
├── produtos/         → CRUD de produtos
├── endereco/         → CRUD de endereços
├── transportadores/  → CRUD de transportadores
├── fretes/           → geração e lista de fretes
├── relatorios/       → relatório do dia e download
└── index.php         → tela inicial
```

## Como rodar o projeto

1. Instale o **XAMPP** e inicie o **Apache** e o **MySQL**.
2. Copie a pasta `fretefacil` para `C:\xampp\htdocs\`.
3. Abra o **phpMyAdmin** (http://localhost/phpmyadmin), vá na aba **SQL** e execute o arquivo `database/banco.sql`.
4. Acesse no navegador: **http://localhost/fretefacil**

## Banco de dados

| Tabela | O que guarda |
|---|---|
| `produto` | os produtos |
| `endereco` | os endereços de origem e destino |
| `transportador` | quem faz o transporte |
| `frete` | o frete (transportador, origem, destino, data, valor, status) |
| `frete_item` | os produtos de cada frete (1 frete → vários produtos) |