FROM composer

# https://stackoverflow.com/questions/54226604/how-to-add-php-redis-for-a-dockerfile-of-laravel-to-kubernetes
RUN set -eux && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl \
        libtool \
        libxml2-dev \
    && apk add --no-cache \
        sqlite \
    && apk del -f .build-deps 
