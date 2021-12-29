# URL Shortener

This is simple application of creating short urls. the script using hashids library which help to create unique keys and can help to decode they keys. since can decode the keys, so the keys will not be saved in DB. just saving the original url and we use record id to generate the key then once we decode we can get that record id.

we are using repository pattern and following SOLID and isolating the layers and depending on abstractions. then inject these interfaces where needed as what you can see in UrlShortenerController

# Technologies
    - php (lumen micro framework).

# How to run locally
    - Clone the repo
    - set your env file
        * cd src
        * cp .env.example .env
    - Build the containers 
        * cd the application folder
        * docker-compose build
        * docker-compose up -d
        * docker-compose run composer update
    - Run Database migration
        * go inside the php container
        docker exec -it url_shortener_php sh
        php artisan migrate
    - Run the tests
         docker exec -it url_shortener_php sh
        ./vendor/bin/phpunit tests --colors

# Improvements
    - need to create small job to clean db if url not clicked in 7 days and add click counts to the table