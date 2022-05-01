release: php artisan cache:clear
release: chmod -R 755 storage
release: chmod -R 755 vendor
release: chmod -R 644 bootstrap/caches
web: vendor/bin/heroku-php-apache2 public/ 
