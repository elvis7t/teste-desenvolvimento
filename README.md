# Teste Desenvolvimento

----------

## Introdução 

1. Criar um banco de dados com as seguintes tabelas:
a. TbEmpresa
i. IdEmpresa (PK)
ii. NomeEmpresa
iii. DocumentoEmpresa
iv. DataCriacao
b. TbUsuario
i. IdUsuario (PK)
ii. IdEmpresa (FK TbEmpresa)
iii. NomeUsuario
iv. Senha
v. DocumentoUsuario
vi. DataCriacao

2. Desenvolva um aplicativo web em qualquer linguagem (preferência .NET), que tenha
as seguintes funcionalidades:
a. Login.
b. CRUD completo para tabela TbEmpresa.
c. CRUD completo para tabela TbUsuario.
3. Enviar um arquivo ZIP com o projeto e um documento explicando como executar o
projeto.

# Resposta do Teste

# Acessar a aplicação Proposta

* Clonar o repositorio https://github.com/elvis7t/teste-desenvolvimento.git
* Na pasta raiz executar 
> docker-composer up -d

* Agurade 30 segundos para o banco carregar 
* Acessar a aplicação em:
http://127.0.0.1:85/view/login.php
- Login: admin@koode.io 
- Senha: Mudar@123

* Acessar o Banco de Dados
- http://localhost:8080/
- Servidor: mysql
- Utilizador: db_user
- Senha: db_user_pass

