# Web-Hacking-Demo
A web application hacking sandbox challenge for ShefESH. Covering insecure deserialisation, SSRF, XSS, and more

## Setup

Install mysql: `sudo apt install mysql-server php-mysql`
Start service: `sudo systemctl start mysql.service`
Configure: `sudo mysql; CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!';`
Seed: `mysql -u sesh -p < seed.sql`

## Login

`sesh_admin`:`mylongpassword123?`