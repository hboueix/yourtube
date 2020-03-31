FROM php:7.4-apache

RUN apt-get -qq update --fix-missing 
RUN apt-get -qq -y upgrade

# Install useful tools
RUN apt-get -qq -y install apt-utils vim wget dialog

# Install important librairies
RUN apt-get -qq -y install --fix-missing apt-utils build-essential git curl libcurl3-dev zip libzip-dev libonig-dev

# Get composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install sendmail
RUN apt-get -qq -y install sendmail

# Install xdebug
#RUN pecl install xdebug-2.5.0
#RUN docker-php-ext-enable xdebug

# Set php.ini
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Other PHP7 Extensions

RUN apt-get -y install libmcrypt-dev
#RUN docker-php-ext-install mcrypt      Doesn't exist

RUN apt-get -y install --fix-missing libsqlite3-dev libsqlite3-0 mariadb-client
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli

RUN docker-php-ext-install curl
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install json

RUN apt-get -y install zlib1g-dev
RUN docker-php-ext-install zip

RUN apt-get -y install libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN docker-php-ext-install mbstring

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
#RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
#RUN docker-php-ext-install -j$(nproc) gd

# Enable apache modules & set server name directive globally
RUN a2enmod rewrite headers
RUN echo "ServerName 172.18.0.4" >> /etc/apache2/apache2.conf

# Copy the init script in /tmp
COPY ./init.sh /tmp/
RUN chmod +x /tmp/init.sh

# Execute init script
CMD ["/tmp/init.sh"]