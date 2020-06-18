FROM php:7.2-apache
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo_mysql
RUN mkdir /app
RUN mkdir /app/src
COPY ./src/ /app/src
RUN cp -r /app/src/www/* /var/www/html/.
