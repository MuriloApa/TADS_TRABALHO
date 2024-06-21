# Use uma imagem base do Debian
FROM debian:latest

# Atualize e instale Apache, PHP e pacotes necessários para o PDO MySQL
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    vim

# Copie os arquivos do seu site para o diretório do Apache
COPY ./app /var/www/html

COPY ./config-template/php.ini /etc/php/8.2/apache2/php.ini 

# Exponha a porta 80
EXPOSE 80

# Inicie o Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]
