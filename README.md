# Tadika Kemas

A Kindergarten management software

## Deployment

To deploy this project run

```bash
  1. Install php (latest version)
     [https://windows.php.net/download/  => download the thread safe]

  2. Install composer (if not installed)
     [https://getcomposer.org/download/  => download installer]

  3. Create your database called tadika-kemas
  [You can use xammp or laragon. I prefer laragon  => https://laragon.org/download/index.html]

```

```bash
    1. Generate the .env file (importand for project set up)
     cp .env.example .env
     php artisan key:generate

    2. composer install

    3. php artisan serve

```
