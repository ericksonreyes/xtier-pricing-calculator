FROM php:5.6.40

RUN sed -i s/deb.debian.org/archive.debian.org/g /etc/apt/sources.list

RUN sed -i s/security.debian.org/archive.debian.org/g /etc/apt/sources.list

RUN sed -i s/stretch-updates/stretch/g /etc/apt/sources.list

RUN apt-get update && apt-get install -y curl git wget zip && apt-get clean

WORKDIR /tmp

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

RUN php composer-setup.php

RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY . .

ENTRYPOINT [ "composer" ]
