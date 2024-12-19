FROM php:8.0-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli

# Copia los archivos PHP al directorio adecuado del contenedor
COPY . /var/www/html/

# Cambia permisos para evitar problemas de acceso
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80
EXPOSE 80
