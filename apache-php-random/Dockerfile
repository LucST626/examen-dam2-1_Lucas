# Usa una imagen base de Apache con soporte para PHP
FROM php:8.1-apache

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia los archivos PHP al directorio de trabajo
COPY info.php /var/www/html/info.php
COPY random.php /var/www/html/random.php

# Ajusta los permisos para que Apache pueda acceder a los archivos
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Activa módulos de Apache necesarios para PHP
RUN docker-php-ext-install mysqli

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Arranca el servidor Apache al iniciar el contenedor
CMD ["apache2-foreground"]
