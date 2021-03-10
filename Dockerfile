FROM php:8.0.2-cli-buster

USER root

RUN apt-get update && apt-get install -y --no-install-recommends \
    wget \
    zip \
    unzip \

  # Cleanup APT (must be done in a single layer)
  && apt-get purge -y cmake \
  && apt-get autoremove -y \
  && apt-get autoclean -y \
  && apt-get clean -y \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /etc/php5 /etc/php/5* /usr/lib/php/20121212 /usr/lib/php/20131226

COPY ./install-composer.sh /tmp/install-composer.sh
COPY ./run.sh /run.sh

RUN chmod +x /run.sh

WORKDIR /tmp
RUN sh /tmp/install-composer.sh \
  && mv /tmp/composer.phar /usr/local/bin/composer

RUN mkdir -p /srv

WORKDIR /

ENTRYPOINT ["/run.sh"]
CMD []