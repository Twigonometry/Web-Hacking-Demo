FROM ubuntu:20.04
RUN apt-get update&& \
 apt-get -y install mysql-server php-mysql
RUN systemctl start mysql.service

FROM php:7.4-apache
COPY docker_files/ /var/www/html
WORKDIR /var/www/html

RUN mysql -e "CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!'"
RUN mysql -e "CREATE DATABASE challenge"
RUN mysql -e "GRANT ALL PRIVILEGES ON challenge.* TO 'sesh'@'localhost' WITH GRANT OPTION"
RUN mysql -e "FLUSH PRIVILEGES"
RUN mysql < seed.sql

RUN htpasswd -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123?

COPY apache2.conf /etc/apache2/apache2.conf

RUN service apache2 restart