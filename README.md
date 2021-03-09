# Symfony Workflow tutorial

The following is an example application which uses the Symfony Workflow component to implement a basic statemachine.

![statemachine](./diagrams/statemachine.png)

![gif](./diagrams/workflow.gif)

## Run the app

1. `git@github.com:makomweb/workflow-tutorial.git`
2. `composer install`
3. `php bin/console doctrine:database:create`
4. `php bin/console doctrine:schema:create`
5. `symfony server:start -d`

Visit `http://localhost:8000/create` to initialize.

The following sections are just side notes.

---

## Make entity and controller

- `composer require symfony/maker-bundle --dev`
- `php bin/console make:entity`
- Product with name as string
- `php bin/console make:controller`
- ProductController

## Setup database

- `php bin/console doctrine:database:create`
- `php bin/console doctrine:schema:create`

## Print the Workflow

- `symfony console workflow:dump product | dot -Tpng -o workflow.png`

![workflow](./workflow.png)

## Add view

- `composer require twig` generates the template sub folder and the base template

### Prepare the Product entity for the state machine

- add 'status' property to the Product entity `php bin/console make:entity`
- create a migration `php bin/console make:migration`
- run the migration `php bin/console doctrine:migrations:migrate`

## Sample data / load fixtures

- `composer require --dev orm-fixtures`
- `php bin/console doctrine:fixtures:load`