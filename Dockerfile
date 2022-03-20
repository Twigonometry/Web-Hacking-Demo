FROM mysql:latest

ADD seed.sql /src/seed.sql
ADD sql_setup.sh /docker-entrypoint-initdb.d

FROM php:7.4-apache
COPY docker_files/ /var/www/html
WORKDIR /var/www/html

RUN htpasswd -b -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123

COPY apache2.conf /etc/apache2/apache2.conf

RUN service apache2 restart

EXPOSE 80