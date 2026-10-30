# Φ Noesis — Plataforma de Filosofia

> Um espaço para reflexão, debate e acesso ao pensamento filosófico em português.

A filosofia é pouco acessível no Brasil — o conteúdo de qualidade está disperso em livros caros, canais desconexos ou em inglês. Noesis busca reunir produção autoral e curadoria de materiais filosóficos em um só lugar, criando uma comunidade acessível para estudantes, autodidatas e entusiastas.

---

## Sobre o Projeto

Noesis é uma plataforma web onde usuários podem publicar reflexões e textos filosóficos, além de descobrir e compartilhar materiais de estudo — sejam digitais (PDFs, links) ou indicações de onde encontrar e comprar materiais físicos.

### Perfis de acesso

| Perfil        | Descrição                                                 |
| ------------- | --------------------------------------------------------- |
| **Visitante** | Navega e lê posts e materiais sem necessidade de cadastro |
| **Usuário**   | Publica posts, compartilha materiais e gerencia sua conta |
| **Admin**     | Modera conteúdo, gerencia usuários e categorias           |

---

## Stack

| Camada          | Tecnologia                                    |
| --------------- | --------------------------------------------- |
| Backend         | PHP                                           |
| Banco de dados  | PostgreSQL ou MySQL (Será decidido em breve.) |
| Frontend        | HTML, CSS, JavaScript                         |
| Containerização | Docker                                        |
| Versionamento   | Git                                           |

---

## Estrutura do Projeto

Em breve...

---

## Como Rodar

## Como executar o projeto

### 1. Pré-requisitos

Instale os seguintes programas:

- [Git](https://git-scm.com/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [mkcert](https://github.com/FiloSottile/mkcert/releases)

Mantenha o Docker Desktop aberto durante a execução.

### 2. Configurar o ambiente

Crie o arquivo `.env` a partir do exemplo:

```powershell
Copy-Item .env.example .env
```

Abra o `.env` e configure as variáveis necessárias, incluindo as credenciais do banco de dados e das APIs utilizadas.

**Importante:** mantenha `DB_NAME=noesis`.

### 3. Configurar HTTPS local

Instale a autoridade certificadora local:

```powershell
mkcert -install
```

Crie a pasta para os certificados:

```powershell
mkdir docker/ssl
```

Gere os certificados:

```powershell
mkcert -cert-file docker/ssl/cert.pem -key-file docker/ssl/key.pem localhost 127.0.0.1 ::1
```

Os arquivos `cert.pem` e `key.pem` serão gerados em `docker/ssl/`.

### 4 . Iniciar o projeto

Execute:

```powershell
docker compose up --build -d
```

O Docker realizará a configuração e inicialização dos serviços.

### 6. Acessar a aplicação

Após a inicialização, acesse:

| Serviço        | Endereço              |
| -------------- | --------------------- |
| Noesis (HTTPS) | https://localhost     |
| Noesis (HTTP)  | http://localhost:8080 |
| phpMyAdmin     | http://localhost:8081 |
| Mailpit        | http://localhost:8025 |

### Observação

- Diversas funcionalidades dependem de credenciais válidas no `.env`.

## Banco de Dados

Em breve...

---

## Changelog

### v0.0 — atual

- Definição do tema e proposta do projeto
- Esqueleto de páginas e fluxo de navegação

---

_Projeto acadêmico desenvolvido ao longo do ano de 2026._
