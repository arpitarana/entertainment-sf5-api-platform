# Movies API
Application to add and get movies data through these REST APIS.
=====

Welcome to application - a fully-functional REST API with Symfony5 application.

This document contains information on how to download, install, and start
using Guestbook as a developer.

# Prerequisite to set up this project

    PHP 7.4.*
    git
    Symfony 5.4
    Composer 2.*
    Doctrine 2

1) Installing & Setup of API
-------------------

When it comes to installing and setup of this API application, you need to follow the following steps.

### Install and configure git

As Movies-API is stored on github, you need to install git in order to be able
to fetch it.

Git can be installed on various ways, depending on the environment:

* On Mac OS: download and install git from [the git website][1]

### Fetch the project

Application can be fetched using the following command:

    git clone https://github.com/arpitarana/entertainment-sf5-api-platform
    git checkout master


1) Getting started with Symfony
-------------------------------
###
    Step 1). docker-compose up -d --build
    
    Step 2). docker exec -it php74-container bash
    
    Step 3). composer install
    
    Step 3). php bin/console doctrine:database:create

    Step 4). php bin/console doctrine:migration:migrate
    
    Step 5). php bin/console doctrine:fixtures:load
    
    Step 7). Import MovieApis.postman_collection.json in postman and 
             run all endpoints. (*)

    Step 6). to run unit test follow the steps 
             vendor/bin/phpunit tests/
    
(*). MovieApis.postman_collection.json file given in project root directory
Import this file 
MovieApis.postman_collection.json

    
Enjoy!

[1]:  http://git-scm.com/
[2]:  http://getcomposer.org/
[3]:  https://help.ubuntu.com/community/FilePermissionsACLs
[4]:  http://symfony.com/doc/2.3/quick_tour/the_big_picture.html
[5]:  http://symfony.com/doc/2.3/index.html
[6]:  http://symfony.com/doc/2.3/bundles/SensioFrameworkExtraBundle/index.html
[7]:  http://symfony.com/doc/2.3/book/doctrine.html
[8]:  http://symfony.com/doc/2.3/book/templating.html
[9]:  http://symfony.com/doc/2.3/book/security.html
[10]: http://symfony.com/doc/2.3/cookbook/email.html
[11]: http://symfony.com/doc/2.3/cookbook/logging/monolog.html
[12]: http://symfony.com/doc/2.3/cookbook/assetic/asset_management.html
[13]: http://symfony.com/doc/2.3/bundles/SensioGeneratorBundle/index.html


