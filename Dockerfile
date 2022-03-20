FROM mysql:latest

ADD seed.sql /src/seed.sql
ADD sql_setup.sh /docker-entrypoint-initdb.d

FROM php:7.4-apache
RUN apt-get update \
  && apt-get install -y apt-transport-https lsb-release ca-certificates wget \
  && wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
  && sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
  && apt-get update \
  && DEBIAN_FRONTEND=noninteractive apt-get install -y php7.0-mysql
COPY docker_files/ /var/www/html
WORKDIR /var/www/html

RUN htpasswd -b -c /etc/apache2/.htpasswd sesh SESHWebHackingPassword123

RUN service apache2 restart

EXPOSE 80