FROM php:5.6.40

RUN sed -i s/deb.debian.org/archive.debian.org/g /etc/apt/sources.list

RUN sed -i s/security.debian.org/archive.debian.org/g /etc/apt/sources.list

RUN sed -i s/stretch-updates/stretch/g /etc/apt/sources.list

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY . .

ENTRYPOINT [ "php"]
