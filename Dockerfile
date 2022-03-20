FROM mysql:8.0.28

COPY seed.sql .

RUN mysql -e "CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!'"
RUN mysql -e "CREATE DATABASE challenge"
RUN mysql -e "GRANT ALL PRIVILEGES ON challenge.* TO 'sesh'@'localhost' WITH GRANT OPTION"
RUN mysql -e "FLUSH PRIVILEGES"
RUN mysql < seed.sql

FROM php:7.4-apache
COPY docker_files/ /var/www/html
WORKDIR /var/www/html

RUN htpasswd -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123?

COPY apache2.conf /etc/apache2/apache2.conf

RUN service apache2 restart