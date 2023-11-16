#!/bin/bash

echo "Docker compose env copying ..."
cp .env.example .env

echo "Backend env copying ..."
cp backend/.env.example backend/.env

echo "Stoping all container ..."
docker-compose down --remove-orphans

# echo "Frontend env copying ..."
cp frontend/.env.example frontend/.env

echo "New docker-compose build started ..."
echo "Please wait for a while to build with no cache ...."
docker-compose build --no-cache
echo "Run container with detach mode ...."
docker-compose up -d
echo "Generating new backend app key"
docker exec -it backend-container php artisan key:generate
echo "Backend config clearing ..."
docker exec -it backend-container php artisan config:clear
echo "Backend cache clearing ..."
docker exec -it backend-container php artisan cache:clear
# echo "Backend config cache ..."
# docker exec -it backend-container php artisan config:cache
echo "Migrating backend schema...."
docker exec -it backend-container php artisan migrate:fresh
echo "Running lint on frontend container"
docker exec -it frontend-container npm run lint

echo "Please visit http://localhost:7890 to visit the app"
