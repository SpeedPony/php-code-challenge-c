# PHP Code Challenge

### Installation

 Run a composer install to download all dependencies
```
  composer install
```
Add the application information to the .env file
* The application secret
* The apistack API key
* The openweathermap API key

You can alternatively add them as server variable instead of adding them in the .env

Here an example with apache
```
    SetEnv APP_SECRET xxx
    SetEnv APISTACK_KEY xxx
    SetEnv OPENWEATHERMAP_KEY xxx
```

Clear the cache
```
  php bin/console cache:clear --env=prod
```

Make sure your vhost is configured, here an example
```
# Virtual Hosts
#
<VirtualHost *:80>
  ServerName localhost
  ServerAlias localhost
  DocumentRoot "${INSTALL_DIR}/www/php-code-challenge-c/public"
  
  # Optional if configured in the .env file
  SetEnv APP_SECRET xxx
  SetEnv APISTACK_KEY xxx
  SetEnv OPENWEATHERMAP_KEY xxx
  
  <Directory "${INSTALL_DIR}/www/php-code-challenge-c/public">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
```

You can now test that the application is working:
* http://localhost/geolocation/8.8.8.8
* http://localhost/weather/8.8.8.8