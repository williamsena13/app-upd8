# Cadastro de Cliente - App Upd8

Este é um projeto de Cadastro de Cliente desenvolvido por [williamsena13](https://github.com/williamsena13), utilizando as tecnologias PHP Laravel e MySQL. A aplicação permite a criação, leitura, atualização e exclusão de registros de clientes por meio de uma API REST. O projeto também inclui a construção do front-end utilizando Vue.js.

## Tecnologias Utilizadas

- PHP Laravel
- MySQL
- Vue.js

## Instalação

Siga os passos abaixo para configurar e executar o projeto em seu ambiente local:

1. Clone este repositório para o seu sistema local:

```bash
git clone https://github.com/williamsena13/app-upd8.git
```

2. Navegue até o diretório do projeto:

```bash
cd app-upd8
```

3. Instale as dependências do Composer:

```bash
composer install
```

4. Crie um arquivo de configuração `.env` baseado no arquivo `.env.example` e configure as informações de banco de dados:

```bash
cp .env.example .env
```

5. Gere uma nova chave de aplicação:

```bash
php artisan key:generate
```

6. Execute as migrações para criar as tabelas do banco de dados:

```bash
php artisan migrate
```

7. Execute os seeders para popular o banco de dados com dados de exemplo:

```bash
php artisan db:seed
```

## Construção do Front-End com Vue.js

Para construir o front-end utilizando Vue.js, siga as instruções abaixo:

1. Navegue até o diretório do front-end:

```bash
cd resources/js
```

2. Instale as dependências do npm:

```bash
npm install
```

3. Edite os componentes Vue conforme necessário em `resources/js/components`.

4. Compile os assets do Vue.js:

```bash
npm run dev
```

## Protótipo Sugerido

Neste projeto, é sugerido seguir o seguinte protótipo:

1. Tela de Listagem de Clientes
   - Exibe uma lista de todos os clientes cadastrados.
   - Permite visualizar detalhes de cada cliente e editar/excluir.

2. Tela de Cadastro de Cliente
   - Permite adicionar um novo cliente ao sistema.

3. Tela de Edição de Cliente
   - Permite editar as informações de um cliente existente.

## Como Enviar

Após concluir o desenvolvimento, siga estas orientações:

1. Gere um arquivo `.rar` ou `.zip` com todo o código fonte do projeto.
2. Inclua um arquivo `env.example` que contenha as configurações de ambiente, mas sem informações sensíveis.
3. Envie o arquivo para o email [seuemail@example.com](mailto:seuemail@example.com) ou hospede-o em um repositório público (por exemplo, GitHub) e compartilhe o link conosco.

## Licença

Este projeto está sob licença proprietária. Para mais informações, consulte o arquivo [LICENSE](LICENSE).