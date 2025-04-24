
###  KUALA

## Requirements

- PHP >= 8.2

## LIVE Demo Credentials



### Admin Panel: 
[Admin Link](https://kualatask.sentinel365.net/admin)

1. Email: admin@admin.com

2. Password: test1234

### Customer Portal: 
[Customer Link](https://kualatask.sentinel365.net/customer)

1. Email: chewec03@gmail.com

2. Password: test1234




## Installation

### Clone the repository

```bash
1. git clone https://github.com/chandachewe10/Kuala.git
2. composer install
3. copy .env.example .env and set DB Credentials
4. php artisan key:generate
5. php artisan migrate 
```

## Create Admin & Test Locally
```bash
php artisan make:filament-user
```

```bash
Start your Application 
```
```bash
1. php artisan serve
2. go to '/customer' to create a customer
```

```bash
Set up email notifications using: MAILTRAP for testing
Copy the mail credentials to .env
```


## License
MIT

