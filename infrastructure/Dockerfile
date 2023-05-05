FROM wyveo/nginx-php-fpm:latest

RUN apt-get update

RUN apt-get install -o Dpkg::Options::="--force-confold" -y php8.1-xml php8.1-sqlite3 php8.1-imagick php8.1-curl

RUN apt-get install -y curl wget

RUN su

RUN apt-get install -y sudo

RUN \
  curl -L https://download.newrelic.com/php_agent/release/newrelic-php5-10.9.0.324-linux.tar.gz | tar -C /tmp -zx && \
  export NR_INSTALL_USE_CP_NOT_LN=1 && \
  export NR_INSTALL_SILENT=1 && \
  /tmp/newrelic-php5-*/newrelic-install install && \
  rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

# COPY ../ /usr/share/nginx/html/

COPY ./nginx-config.conf /etc/nginx/conf.d/default.conf

COPY ./new-relic.ini /tmp/newrelic-config.ini

RUN sed -i \
      -e 's/"REPLACE_WITH_REAL_KEY"/"ed6ac4fde1e3c069036b5bb9f3a116bb5befNRAL"/' \
      -e 's/newrelic.appname = "PHP Application"/newrelic.appname = "DicesService"/' \
      -e 's/"AGENT_PROCESS_HOST_NAME"/"DicesService-PHPAgent"/' \
      -e 's/;newrelic.daemon.app_connect_timeout =.*/newrelic.daemon.app_connect_timeout=15s/' \
      -e 's/;newrelic.daemon.start_timeout =.*/newrelic.daemon.start_timeout=5s/' \
      /tmp/newrelic-config.ini

RUN  rm $(php -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini && cp /tmp/newrelic-config.ini $(php -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini
RUN  rm /etc/php/8.1/fpm/conf.d/newrelic.ini && cp /tmp/newrelic-config.ini /etc/php/8.1/fpm/conf.d/newrelic.ini

VOLUME [ "/usr/share/nginx/html" ]

EXPOSE 80
