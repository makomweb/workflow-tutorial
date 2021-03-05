# Symfony Workflow tutorial

https://codereviewvideos.com/course/symfony-workflow-component-tutorial/video/a-simple-state-machine-example

## Steps

## make entity and controller

- `composer require symfony/maker-bundle --dev`
- `php bin/console make:entity`
- Product with name as string
- `php bin/console make:controller`
- ProductController

## setup database

- `php bin/console doctrine:database:create`
- `php bin/console doctrine:schema:create`