# Para subir o sistema basta seguir os seguintes passos:

1 - docker-compose up -d

# Acessar o container do laravel (docker ps - comando para pegar o <ID_CONTAINER>):

2 - docker exec -it <ID_CONTAINER> bash
3 - composer install (Quando for a primeira vez que estiver criando o projeto)
4 - php artisan key:generate
5 - php artisan migrate (criação das tabelas no banco)
6 - php artisan db:seed --class=CategorySeeder (Criar as categorias)
7 - php artisan db:seed --class=UserSeed (Criar o usuário)
8 - php artisan db:seed --class=TicketStatusSeeder (Criar os status dos tickets)


# Endpoints da aplicação (arquivo json exportado do insominia na pasta storage/insomnia:

1 -  http://localhost/api/login  (para acessar qualquer endpoint precisamos fazer o login e pegar o bearer gerado, as configurações já estão feitas no header Authorization dos endpoints)
METHOD: GET 
BODY:

{
	"email": "edu@gmail.com",
	"password": "edu123"
}

2 - http://localhost/api/logout (Sair do sistema)

3 - http://localhost/api/register-user (criar novos usuários)
METHOD: POST
BODY:

{
	"email": "ddd@gmail.com",
	"password": "edu12345",
	"password_confirmation":"edu12345",
	"name": "edu12345"
}

4 - http://localhost/api/send-document (inserir um novo documento)
METHOD: POST
BODY: storage/data/2023-03-28.json (Dentro do projeto)

5 - http://localhost/api/get-documents (lista todos os documento inseridos)
METHOD: GET
