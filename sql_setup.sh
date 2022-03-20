mysql -e "CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!'"
mysql -e "CREATE DATABASE challenge"
mysql -e "GRANT ALL PRIVILEGES ON challenge.* TO 'sesh'@'localhost' WITH GRANT OPTION"
mysql -e "FLUSH PRIVILEGES"
mysql < /src/seed.sql