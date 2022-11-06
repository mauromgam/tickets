## Setup
This application was set up using Valet and a pre-installed version of MySQL. 
To get it up and running, please follow the steps below: 
```bash
# Move to the directory you just cloned
cd ticket-processor

# Then run:
composer install

npm install # make sure you're using node v18
npm run dev

# Create a link to run the application, e.g. ticket-processor.test
# If it doesn't work straight away, please add the created link uri to your hosts file
valet link

# If you'd like to confirm what link has been create, you can run the command below
valet links
```
If you used the above, you should be able to access http://ticket-processor.test/

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
* Register User
* Login page
* Home page 
  * Lists all tickets created by the logged-in user (not paginated)

#### Commands
```bash
# Creates 1 ticket with dummy data for each execution
php artisan cron:generate-ticket

# Processes 5 tickets each execution
php artisan cron:process-tickets
```

#### Run Scheduled Jobs
To run Laravel Schedule locally, run the command below:
```bash
php artisan schedule:work
```
To run Laravel Schedule on a server, add the line below to the crontab:
```bash
# Make sure you set your project path correctly
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

#### Run tests
```bash
# Make sure you have `npm run dev` running
php artisan test --coverage
```
