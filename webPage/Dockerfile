FROM php:7.2-apache
WORKDIR /opt

RUN apt-get update -y && \
apt-get upgrade -y && \
apt-get --allow-unauthenticated install -y apache2 && \
apt-get --allow-unauthenticated install -y apache2-utils


RUN docker-php-ext-install mysqli


COPY . /opt

# Places the website files in the correct folder, and copies in my php.ini file so
# that php can upload files. You can edit the max upload size and stuff. It should be noted that
# php.ini file goes in a different spot on the container than it does in VMs. The ENTRYPOINT
# and the foreground thing may not be necessary. Haven't tested that out.

RUN cp ./index.php ./addItems.php /var/www/html/


ENTRYPOINT ["apache2ctl"]
CMD ["-DFOREGROUND"]
