FROM node:18.17.0-alpine

WORKDIR /usr/src/app

COPY package*.json package-lock.json ./
COPY babel.config.js ./

RUN npm install --legacy-peer-deps

COPY . .

EXPOSE 7890