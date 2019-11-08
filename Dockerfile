FROM composer

# https://stackoverflow.com/questions/54226604/how-to-add-php-redis-for-a-dockerfile-of-laravel-to-kubernetes
RUN set -eux && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl \
        libtool \
        libxml2-dev \
        libzip-dev \
    && apk add --no-cache \
        sqlite \
        mysql-client \
        tzdata \
    && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && echo "Asia/Tokyo" > /etc/timezone \
    && docker-php-ext-install \
        mbstring \
        pdo \
        pdo_mysql \
        mysqli \
        tokenizer \
        bcmath \
        opcache \
        xml \
        zip \
    && apk del -f .build-deps
