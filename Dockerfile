FROM php:8.2-cli
copy . /usr/src/app
workdir /usr/src/app
ENTRYPOINT [ "php", "./index.php" ]
