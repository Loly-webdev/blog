# Project

# Framework Installation

you can check requirements on :
 - http://project/requirements.php

## Clone git project

## Install composer

## Add vhost

- On Apache:  
.htaccess file is versioned on project

- On Nginx:  
[vhost example](https://github.com/Loly-webdev/Ressources/blob/master/vhost_nginx.md)

## Install yaml

- On Windows (WAMP) :
  - [Download yaml dll](https://pecl.php.net/package/yaml)
  - Put "php_yaml.dll" file on "C:\wamp\bin\php\<phpVersionFolder>\ext" folder
  - Edit  "C:\wamp\bin\php\<phpVersionFolder>\php.ini" file 
  - Add a new line "extension=yaml" under "Dynamic Extensions" section
  - Edit  "C:\wamp\bin\apache\<apacheVersionFolder>\bin\php.ini" file 
  - Add a new line "extension=yaml" at the end of file
  - Restart WAMP

- On linux (LAMP):
    - https://zoomadmin.com/HowToInstall/UbuntuPackage/php-yaml

## Configure .env file
 
## Load database file

## For Argon2iD to have PHP 7.4

## Please change data to env.yml

## Please charge database 
with le file : 'blog.sql' in 'config/bdd/blog.sql'
