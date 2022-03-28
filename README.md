# cc_time_capsule
test repo for swoole / octane

requirements
- mysql / mariadb
- mongodb
- swoole


installation:
- composer install
- edit .env file
- php artisan key:generate
- php artisan migrate:fresh --seed

endpoints:
- POST /log
- GET /log-random
- GET /log/{id}
- GET /categories
- GET /categories/{id}
- GET /test-hash


start swoole/octane:

php artisan octane:start --server=swoole --host=127.0.0.1 --port=8000
