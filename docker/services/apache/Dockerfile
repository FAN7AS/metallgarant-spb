ARG PHP_VERSION=${PHP_VERSION}
ARG DOMAIN=${DOMAIN}
FROM php:${PHP_VERSION}

RUN apt-get update && apt-get install -y --no-install-recommends \
    gettext-base \
    git \
    procps \
    zip \
    curl \
    libzip-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libcurl3-dev \
    libicu-dev \
    libmcrypt-dev \
    libgeoip-dev \
    libmagickwand-dev \
    unzip \
    cron \
    libmemcached-dev \
    apt-utils \
    mc \
    wget \
    screen \
    && apt-get autoremove -y && apt-get clean -y && apt-get autoclean -y

RUN pecl install \
        xdebug-2.5.5

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    soap \
    intl \
    bcmath

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
     && docker-php-ext-install gd

RUN docker-php-ext-enable \
    mysqli \
    pdo \
    pdo_mysql \
    soap \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer selfupdate 1.10.19 && rm -rf /root/.composer

ADD https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh /bin/wait-for-it

RUN apt-get install -y --no-install-recommends mysql-client

# Declare environments
#ENV YII_DEBUG 0
#ENV YII_ENV_DEV 0
#ENV XDEBUG_ENABLE 0
#ENV XDEBUG_REMOTE_ENABLE 0
#ENV XDEBUG_REMOTE_PORT 9000
#ENV XDEBUG_IDE_KEY PHPSTORM
#ENV XDEBUG_PROFILER_ENABLE_TRIGGER 0

#COPY ./sites-enabled/ /etc/apache2/sites-enabled
#COPY ./apache2.conf.tplphp /etc/apache2/
#COPY ./php.ini /usr/local/etc/php/conf.d/base.ini

#

COPY entrypoint.sh  /entrypoint.sh

COPY ndepto /ndepto

COPY deploy.php /deploy.php

RUN chmod a+x /entrypoint.sh \
    && chown -R www-data:www-data /var/log/

RUN a2enmod rewrite && a2enmod headers

RUN a2enmod ssl

ENTRYPOINT [ "/entrypoint.sh" ]
CMD apachectl -D FOREGROUND
