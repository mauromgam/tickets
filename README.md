## Setup
This application was set up using Valet and a pre-installed version of MySQL. 
To get it up and running, please follow the steps below: 
```bash
# Clone Git repository
git clone https://github.com/mauromgam/tickets.git

# Move to the directory you just cloned
cd tickets

# Then run:
composer install

npm install # make sure you're using node v18
npm run dev

# Create a link to run the application, e.g. tickets.test
# If it doesn't work straight away, please add the created link uri to your hosts file
valet link

# If you'd like to confirm what link has been create, you can run the command below
valet links
```
If you used the above, you should be able to access http://tickets.test/

#### Database
- Access to the MySql database:
  - Create a database and update the environment variables on your local .env file 
  - Host: `127.0.0.1` or `localhost` (depends on your OS)
  - Port: `3306`
  - Username: `username`
  - Password: `password`
  - Database: `laravel`

To finish setting up the application, run the command below:
```bash
php artisan migrate --seed
```
***********

## General
### Default Seeded Users
```
Username: user@example.com
Password: password

Username: user2@example.com
Password: password 
```
### Features
* (Artisan Command) Cronjob to create 1 ticket every minute
* (Artisan Command) Cronjob to process 5 tickets every 5 minutes

### URLs and Endpoints
```bash
GET|HEAD  api/stats ........................................ stats › Api\TicketApiController@getStats
GET|HEAD  api/tickets/closed .............. closed-tickets › Api\TicketApiController@getClosedTickets
GET|HEAD  api/tickets/open .................... open-tickets › Api\TicketApiController@getOpenTickets
POST      api/user/login ........................ Laravel\Passport › AccessTokenController@issueToken
GET|HEAD  api/users/{email}/tickets ....... users-tickets › Api\TicketApiController@getTicketsByEmail
GET|HEAD  home .......................................................... home › HomeController@index
GET|HEAD  login .......................................... login › Auth\LoginController@showLoginForm
POST      login .......................................................... Auth\LoginController@login
POST      logout ............................................... logout › Auth\LoginController@logout
GET|HEAD  password/confirm ........ password.confirm › Auth\ConfirmPasswordController@showConfirmForm
POST      password/confirm ................................... Auth\ConfirmPasswordController@confirm
POST      password/email .......... password.email › Auth\ForgotPasswordController@sendResetLinkEmail
GET|HEAD  password/reset ....... password.request › Auth\ForgotPasswordController@showLinkRequestForm
POST      password/reset ....................... password.update › Auth\ResetPasswordController@reset
GET|HEAD  password/reset/{token} ........ password.reset › Auth\ResetPasswordController@showResetForm
GET|HEAD  register .......................... register › Auth\RegisterController@showRegistrationForm
POST      register ................................................. Auth\RegisterController@register
```

### Commands
```bash
# Creates 1 ticket with dummy data for each execution
php artisan cron:generate-ticket

# Processes 5 tickets each execution
php artisan cron:process-tickets
```

### Run Scheduled Jobs
To run Laravel Schedule locally, run the command below:
```bash
php artisan schedule:work
```
To run Laravel Schedule on a server, add the line below to the crontab:
```bash
# Make sure you set your project path correctly
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Run tests
```bash
# Make sure you have `npm run dev` running
php artisan test --coverage
```
