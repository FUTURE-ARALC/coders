FROM hyperf/hyperf:8.3-alpine-v3.19-swoole-v5
LABEL maintainer="Hyperf Developers <group@hyperf.io>" version="1.0" license="MIT" app.name="Hyperf"

ARG timezone
ARG user
ARG uid

ENV TIMEZONE=${timezone:-"America/Sao_Paulo"} \
    APP_ENV=prod \
    SCAN_CACHEABLE=(true)

# RUN apk update && apk add --no-cache zip unzip curl openssh-client wget git
RUN apk add --upgrade php83-phpdbg php83-mbstring php83-xml



RUN set -ex \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php* \
    # - config PHP
    && { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # ---------- clear works ----------
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

    
RUN addgroup -g $uid $user && \
    adduser -D -u $uid -G $user -s /bin/bash $user && \
    id $user


# Corrigido: usar ${user} para expandir a variável corretamente
RUN mkdir -p /home/${user}/.composer && \
    chown -R ${user}:${user} /home/${user}



WORKDIR /var/www
COPY . /var/www

RUN composer install --no-dev -o && php bin/hyperf.php

EXPOSE 9501

# CMD ["/bin/sh", "-c" , "php bin/hyperf.php start"]

# ENTRYPOINT ["php", "/var/www/bin/hyperf.php", "start"]
