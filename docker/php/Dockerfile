FROM php:7.2-fpm

RUN apt-get update \
	&& apt-get install -y git \
	&& apt-get install -y zlib1g-dev \
	&& docker-php-ext-install zip

RUN pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-enable redis xdebug

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

# npm & node
RUN apt-get --yes update \
    && apt-get install --yes --force-yes apt-transport-https lsb-release ca-certificates curl gnupg2 \
	&& curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
	&& echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
	&& curl -sL https://deb.nodesource.com/setup_9.x | bash - \
    && apt-get update -qq -y \
    && apt-get --yes --force-yes install build-essential \
	&& apt-get install -y git libuv1 nodejs yarn

WORKDIR /symfony/