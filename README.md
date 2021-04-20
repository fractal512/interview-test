## Interview Test

### Installation

1. Clone this repository.
2. Run following commands:

```shell script
# cd in your project directory
composer install
composer dumpautoload -o

php artisan key:generate

php artisan config:clear
php artisan config:cache
```

3. Configure `.env` file:
```text

...

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=<db_name>
DB_USERNAME=<db_username>
DB_PASSWORD=<db_password>

...

QUEUE_CONNECTION=database

...

MAIL_MAILER=log

...

```

4. Run migrations and seedings:

```shell script

php artisan migrate
php artisan db:seed

```

5. Run queue listener:

```shell script
php artisan queue:listen
```

6. Run server:

```shell script
php artisan serve
```

### Default accounts:

By default, two accounts created for a manager and client:

Manager: login - `manager@example.com`, password - `12345678`

Client: login - `client@example.com`, password - `12345678`

Additional clients may be registered via registration form.

### Client dashboard preview

![Client Dashboard](/blob/assets/client-dashboard.png?raw=true)

### Manager dashboard preview

![Manager Dashboard](/blob/assets/manager-dashboard.png?raw=true)

