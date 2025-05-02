# Technical Exam - Tabulate

## Run Locally

Clone the project

```bash
  git clone https://github.com/SuperEjay/transactions-app.git
```

Go to the project directory

```bash
  cd transactions-app
```

Install dependencies & Setup the Project

```bash
  composer install
```

```Generate ENV, Key, Migration and Seeder (if applicable)
   sudo cp .env.example .env
   php artisan key:generate
   php artisan migrate:fresh --seed
```

```
    To run email open the mail.txt email and paste credentials to .env
```

Start the server

```bash
   composer run dev
```
