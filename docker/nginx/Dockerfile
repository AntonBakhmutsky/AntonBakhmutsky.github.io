FROM nginx:alpine

RUN apk update \
    && apk upgrade \
    && apk --update add logrotate \
    && apk add --no-cache openssl \
    && apk add --no-cache bash

RUN apk add --no-cache curl

RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

COPY nginx.conf /etc/nginx/
COPY app.template /etc/nginx/conf.d/
COPY include /etc/nginx/include

ARG SERVER_NAME=localhost
ARG PHP_HOST=php

ENV SERVER_NAME ${SERVER_NAME}
ENV PHP_HOST ${PHP_HOST}

RUN envsubst '\$SERVER_NAME' < /etc/nginx/conf.d/app.template > /etc/nginx/conf.d/default.conf
RUN envsubst '\$PHP_HOST' < /etc/nginx/conf.d/app.template > /etc/nginx/conf.d/default.conf

ADD ./startup.sh /opt/startup.sh
RUN sed -i 's/\r//g' /opt/startup.sh
CMD ["/bin/bash", "/opt/startup.sh"]

EXPOSE 80 443
