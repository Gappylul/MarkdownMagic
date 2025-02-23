FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install dependencies
RUN apk add --no-cache \
    nodejs \
    npm \
    git \
    zip \
    unzip

# Configure nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Install composer dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Install npm dependencies and build assets
RUN npm install && npm run build

# Set correct permissions
RUN chown -R nginx:nginx /var/www/html

# Create script to run migrations and start server
RUN echo '#!/bin/sh\n\
php artisan migrate --force\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
/start.sh' > /start-container.sh \
&& chmod u+x /start-container.sh

EXPOSE 80

CMD ["/start-container.sh"] 