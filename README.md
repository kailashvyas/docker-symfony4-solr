![Symfony 4 & Solr listing app]

========================

# Summary

This is a web app which imports solr.json from TMDB database.
The web app shows listing from solr and filters are displayed on left hand side 


# Getting started

1. Install [Docker for Mac](https://www.docker.com/)
1. Run command make setup (Dwnloads and start docker images nginx, php, solr)
1. Visit http://127.0.0.1:83/ for symfony web app
1. Visit http://127.0.0.1:8984/ for accessing solr


# Docker Overview

* docker-compose.yml (Docker config for nginx, php, solr)
* docker/nginx/site.conf ( default nginx conf )
* docker/php/Dockerfile php 7.1, git, composer, yarn 
* docker/solr/Dockerfile solr 6 config and import solr.json
* docker/solr/solr.json (TMDB data for importation)



# Symfony Overview

* symfony dir has symfony 4 source code 
* symfony/package.json - node js libraries used in app
* symfony/webpack.config.js - web pack config
* symfony/composer.json - all symfony 4 libraries specified here 
* symfony/config - dir has config for routes, services, tests and solr query
* symfony/src/Controller - dir has controller
* symfony/src/Service - dir has services. ApiService and SearchService specified here
* symfony/src/Twig - Twig extension. AppExtension has query_builder function
* symfony/src/tests - All unit tests are specified here
* symfony/src/templates - All twig templates including layout
* symfony/assets/scss - All css specified here
* symfony/assets/js - All js specified here
* symfony/public - public dir contains index file and compiled css and js in build dir


# Solr Overview

* Visit http://127.0.0.1:8984/ for accessing solr admin
* In admin load tmdb core and browse TMDB data
* you can delete docs or fire solr query
* In web app solr query fired is defined in symfony/config/services.yaml under search_definition


# Makefile Overview

* Run command make composer (Installs all symfony libraries specified in composer.json)
* Run command make assets (Builds all the assets as per config in webpack and yarn config)
* Run command make tests (Runs phpunit tests)



