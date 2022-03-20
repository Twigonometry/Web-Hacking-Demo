FROM php:7.4-apache
COPY docker-files/ /var/www/html
WORKDIR /var/www/html

RUN sudo apt install mysql-server php-mysql
RUN sudo systemctl start mysql.service

RUN sudo mysql -e "CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!'"
RUN sudo mysql -e "CREATE DATABASE challenge"
RUN sudo mysql -e "GRANT ALL PRIVILEGES ON challenge.* TO 'sesh'@'localhost' WITH GRANT OPTION"
RUN sudo mysql -e "FLUSH PRIVILEGES"
RUN sudo mysql < seed.sql

RUN sudo htpasswd -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123?

COPY apache2.conf /etc/apache2/apache2.conf

RUN sudo service apache2 restart