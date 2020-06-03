## Laravel Blog

Repository used to study and learn about laravel 7 and its features.

Currently, using:

 - vue.js
 - Bootstrap 4!
 - FontAwesome
 - Axios
 - Docker
 
## How to build

First you need to install [Docker Compose](https://docs.docker.com/compose/install/).
 
Then, run:
```
git clone https://github.com/lemestwo/laravel-blog.git
cd laravel-blog
cp .env.example .env
docker-compose run --rm --no-deps webserver composer install
docker-compose run --rm --no-deps webserver php artisan key:generate
docker run --rm -v "%cd%":/app -w /app node:alpine npm i
docker-compose up -d
```

The application will be available at: [http://localhost:8080](http://localhost:8080)
## Contributing

Feel free to contribute as you wish.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
