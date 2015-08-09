# Katsitu.Com

Katsitu.Com is a public listing website for Malaysian community residing in United Kingdom. 

## Installation

1. Clone this repository

        git clone https://github.com/faizshukri/katsitu.git
        cd katsitu

2. Copy `.env.example` to `.env`. Setup a database and update the variables in file `.env` accordingly.

3. Install composer dependencies
        
        composer update

4. Install npm dependencies

        npm install

5. Install assets

        bower install

6. Build the assets
        
    ```bash
    # For development
    gulp

    # For production
    gulp --production
    ```

7. Run migration and seed.

        php artisan migrate
        php artisan db:seed

    For `local`/`development` environment, the seed will populate cities only for Sheffield and Manchester. Some test users will also be created. You may use this account to login.
    - Email: `faiz@example.com`
    - Password: `password`

8. Run the website with a webserver. If you want to use PHP's build in web server, you may use laravel's artisan command for it
    
        php artisan serve

    and access the website using url `http://localhost:8000`