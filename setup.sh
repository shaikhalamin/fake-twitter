#!/bin/bash

echo "Stoping all container ..."
docker-compose down --remove-orphans

echo "Docker compose env copying ..."
cp .env.example .env

echo "Backend env copying ..."
cp backend/.env.example backend/.env

# echo "Frontend env copying ..."
# cp frontend/.env.example frontend/.env

echo "New docker-compose build started ..."
echo "Please wait for a while to build and configure ...."
docker-compose up --build -d

echo "Backend config clearing ..."
docker exec -it backend-container php artisan config:clear
echo "Backend cache clearing ..."
docker exec -it backend-container php artisan cache:clear
echo "Backend config cache ..."
docker exec -it backend-container php artisan config:cache

echo "Please visit http://localhost:7890 to visit the app"
