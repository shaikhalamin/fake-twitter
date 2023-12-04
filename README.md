
## Twitter clone build with Laravel,Vue.js 2, MongoDB and Docker-compose

## Basic Features
    ```bash
        
        1. User can sign up and sign in
        2. JWT Authentication with access token and refresh token
        3. User can update profile info and update avatar icon
        4. User can post tweet and like tweet
        5. User can post follow and unfollow other user
        6. User can search other user by username or email
    ```
## Project Run Instruction

```bash

Step 1: git clone https://github.com/shaikhalamin/fake-twitter.git

Step 2: cd fake-twitter

Step 3: sudo chmod +x setup.sh [Not needed if you can run docker and docker-compose without sudo then just run sh setup.sh ]

Step 4: ./setup.sh

```
## N:B: please be patient it will take a while to setup docker env and project 

After all the setup done you can browse http://localhost:7890 to see the result
Laravel backend will be running on http://localhost:9000


## N:B:  If docker is not setup, then run the two backend and frontend manually by visiting the backend and frontend folder 
     
## Backend Manual Setup: (php8.1 and php-mongodb driver is must required)
```bash
    1. For Backend manual setup cd into backend directory and just cp .env.example .env and change the .env value accordingly
    2. composer dump-autoload
    3. composer install
    4. php artisan key:generate
    5. php artisan config:clear
    6. php artisan cache:clear
    7. php artisan migrate:fresh
    4. php artisan serve --port=9000

    Frontend Manual Setup: Node.js is required
    1. cd into frontend directory and just cp .env.example .env and change the .env value accordingly
    2. npm install --legacy-peer-deps
    3. npm run lint
    4. npm run serve


```
## Postman collection also added in this project root directory named [fake-twitter.postman_collection.json] , just import it

## Vue.js frontend will be running on http://localhost:7890 

```bash

To Open the frontend link please click the link http://localhost:7890 to see the result

```
## Project Screencast link added below for see the details
## https://www.loom.com/share/07765cabae4248cda4f2e2d71b3a5e7a?t=678&sid=7b3355ae-7a47-4dce-939a-44767b182177

## Project feature display

<img src="https://raw.githubusercontent.com/shaikhalamin/fake-twitter/master/home_page.png" width="30%"></img> <img src="https://raw.githubusercontent.com/shaikhalamin/fake-twitter/master/profile_page.png" width="30%"></img> <img src="https://raw.githubusercontent.com/shaikhalamin/fake-twitter/master/time_line.png" width="30%"></img>

