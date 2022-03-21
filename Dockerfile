FROM ubuntu:20.04
RUN apt-get update \
  && DEBIAN_FRONTEND=noninteractive apt-get install -y php-mysql

FROM mysql:latest

ADD seed.sql /src/seed.sql
ADD sql_setup.sh /docker-entrypoint-initdb.d

FROM php:7.4-apache
COPY docker_files/ /var/www/html
WORKDIR /var/www/html

RUN htpasswd -b -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123

RUN service apache2 restart

EXPOSE 80
