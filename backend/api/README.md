# To start the system, just follow these steps:

1 - docker-compose up -d

# You need to access the container (docker ps - command to get the id <ID_CONTAINER>):

2 - docker exec -it <ID_CONTAINER> bash
3 - composer install
4 - php artisan key:generate
5 - php artisan migrate (Create tables)
6 - php artisan db:seed --class=CategorySeeder (Populate Category)
7 - php artisan db:seed --class=UserSeed (Populate User)
8 - php artisan db:seed --class=TicketStatusSeeder (Populate TicketStatus)


# Endpoints (file json from insominia inside the folder storage/insomnia):

1 -  http://localhost/api/login  (We need to get to get the token using endpoint login. The configuration has been done in insomnia file through Headers -> Authorization)
METHOD: GET 
BODY:

{
	"email": "edu@gmail.com",
	"password": "edu123"
}

2 - http://localhost/api/logout (System logout)

3 - http://localhost/api/register-user (Create new User)
METHOD: POST
BODY:

{
	"email": "ddd@gmail.com",
	"password": "edu12345",
	"password_confirmation":"edu12345",
	"name": "edu12345"
}

4 - http://localhost/api/get-tickets (Get all tickets)
METHOD: GET

5 - http://localhost/api/send-ticket (Create new Ticket)
METHOD: POST
BODY:
{
	"title":"dasdasdsa",
	"description":"dasddasd",
	"user_id":1,
	"category_id":1,
	"ticket_status_id": 1
}
6 - http://localhost/api/update-ticket/{ticket_id}
METHOD: POST - In this case we have to use method post becouse we can upload files
BODY:
{
	"title":"dasdasdsa",
	"description":"dasddasd",
	"user_id":1,
	"category_id":1,
	"ticket_status_id": 1
}
7 - These endpoints change the status from the ticket:
http://localhost/api/accept-ticket/{ticket_id}
http://localhost/api/cancel-ticket/{ticket_id}
http://localhost/api/close-ticket/{ticket_id}
METHOD: PUT
8 - http://localhost/api/file-download/{ticket_id} - Get file from one ticket
METHOD: GET
9 - http://localhost/api/save-commentary/ - Save new commentary
METHOD: POST
BODY:
{
	"description":"111",
	"user_id":1,
	"ticket_id": 36
}
10 - http://localhost/api/get-commentaries/{ticket_id} - Get all comentaries from the ticket
METHOD: GET

11 - http://localhost/api/get-categories - Get all categories to be inserted in to the ticket
METHOD: GET
