# sip_test_docker
cd sip_test_docker  
docker-compose build
docker-compose up

cd ./src
composer install
npm install

cp .env.example .env
php artisan key:generate

docker-compose exec -T app php artisan migrate:install
docker-compose exec -T app php artisan migrate
docker-compose exec -T app php artisan storage:link

ready!
