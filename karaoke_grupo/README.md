# Karaokê & Bar

Sistema web para gerenciar reservas de salas, produtos e vendas do Karaokê & Bar.

Tem os CRUDs de Salas, Reservas, Playlists, Produtos, Compras e Usuários.

## O que precisa ter instalado
- PHP 8.3 ou mais novo
- Composer
- MySQL ou MariaDB

## Quando baixar o projeto, o que fazer?
Abrir o terminal dentro da pasta do projeto e rodar os comandos:

**1. Instalar as dependências do projeto**
`composer install`

**2. Copiar o .env.example e renomear para .env**
`cp .env.example .env`

**3. Gerar a key do projeto**
`php artisan key:generate`

**4. Criar o banco `db_karaoke`, as tabelas e inserir os registros**
`php artisan migrate --seed`

Se o terminal perguntar se quer criar o banco, responder `yes`.

Se o seu MySQL tiver senha, colocar ela em `DB_PASSWORD` no arquivo .env.

**5. Criar o link da pasta de imagens**
`php artisan storage:link`

**6. Iniciar o sistema**
`php artisan serve`

**7. Acessar o sistema**
`http://localhost:8000/`

## Banco de dados
O script do banco com os registros de exemplo está em `database/sql/db_karaoke.sql`. Ele serve para importar o banco sem usar o passo 4.
