FROM wyveo/nginx-php-fpm:php74
WORKDIR /usr/share/nginx
COPY ./default.conf /etc/nginx/conf.d/
