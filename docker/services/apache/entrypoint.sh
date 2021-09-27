#!/bin/bash
chmod a+x /bin/wait-for-it
#echo "---------------> Wait redis"
#wait-for-it -t 0 redis:6379

echo "---------------> Wait mysql"
wait-for-it -t 0 mysql:3306

set -e

cd /var/www/html/

# template prepare

chmod a+x /deploy.php

/deploy.php

chmod -R a+w /templates/
chmod -R a+w /certs/

#
#cp -r /templates/ /templates.copy/
#
#r="$RANDOM"
#for f in $(find /templates.copy/ -regex '.*\.tpl\.?php' 2> /dev/null); do
#    sed -e "s/<?/<<<$r\&\&\&/g" -e "s/?>/\&\&\&$r>>>/g" -e 's/<%/<?/g' -e 's/%>/?>/g' < $f | php | sed -e "s/<<<$r\&\&\&/<?/g" -e "s/\&\&\&$r>>>/?>/g" > "${f%\.tplphp}"
#    rm -f $f
#done

#cp -r /templates.copy/sites-enabled/ /etc/apache2/
#cp /templates.copy/apache2.conf /etc/apache2/
#cp /templates.copy/php.ini /usr/local/etc/php/conf.d/base.ini


if [ "$XDEBUG_ENABLE" = 1 ]; then
    echo "---------------> start xdebug"
    mkdir -p /var/log/xdebug/
    mkdir -p /var/log/xdebug/profiler
    touch /var/log/xdebug/remote_log.log
    cp /templates/.parsed/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
    docker-php-ext-enable xdebug
    chown -R www-data:www-data /var/log/xdebug
    echo "---------------> end xdebug"
fi

mkdir /var/www/html/cache || true
chmod -R a+rw /var/www/html/cache || true

mkdir /var/www/html/log || true
chmod -R a+rw /var/www/html/log || true

exec "$@"
