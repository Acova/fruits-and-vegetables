# 🍎🥕 Fruits and Vegetables

## 🎯 Goal
We want to build a service which will take a `request.json` and:
* Process the file and create two separate collections for `Fruits` and `Vegetables`
* Each collection has methods like `add()`, `remove()`, `list()`;
* Units have to be stored as grams;
* Store the collections in a storage engine of your choice. (e.g. Database, In-memory)
* Provide an API endpoint to query the collections. As a bonus, this endpoint can accept filters to be applied to the returning collection.
* Provide another API endpoint to add new items to the collections (i.e., your storage engine).
* As a bonus you might:
  * consider giving option to decide which units are returned (kilograms/grams);
  * how to implement `search()` method collections;
  * use latest version of Symfony's to embbed your logic 

### ✔️ How can I check if my code is working?
You have two ways of moving on:
* You call the Service from PHPUnit test like it's done in dummy test (just run `bin/phpunit` from the console)

or

* You create a Controller which will be calling the service with a json payload

## 💡 Hints before you start working on it
* Keep KISS, DRY, YAGNI, SOLID principles in mind
* Timebox your work - we expect that you would spend between 3 and 4 hours.
* Your code should be tested

## Time description
* First hour: Configured devcontainer, added a PostgreSQL container to the compose and updated Symfony.
* Second hour: Configured Symfony to support the PostgreSQL database. Created the skeleton for a hexagonal architecture.
* Third hour: Created the controllers and repositories for our entities.
* Fourth hour: Added testing and improved the configuration

## Docker (optional)
If you want to use this inside a docker container, you need to use docker compose:
```bash
docker compose -f docker/docker-compose.yaml up -d
```

## Install guide:
To use this project, after cloning the source code, you need to execute theese command (from the root of the project)

(Optional) If you are using Docker, launch a shell inside the container:
```bash
docker exec -it fruits-and-vegetables-symfony /bin/sh
```

Install dependencies:
```bash
composer install
```

Create the database:
```bash
php bin/console doctrine:database:create
```

Run the migrations:
```bash
php bin/console doctrine:migrations:migrate
```

## Run the tests
From the root of the project, run the next command:
```bash
php bin/phpunit
```

## Load the data from de request.json file
From the root of the project, run the next command:
```bash
php bin/console app:load-data-from-file /app/request.json
```

A file called request_errors.json will be created with a log of all the failed entries and the detected errors.

## Calling the API
We need a web server to be able to use the endpoints of the application.
For testing, we can use the symfony server. From the project's root, we can run the next command:
```bash
symfony server:start
```
If you are running the app from inside a container, run this command like this, from a shell in the container:
```bash
symfony server:start --allow-all-ip
```
Or, like this from outside the container
```bash
docker exec -it fruits-and-vegetables-symfony /usr/bin/symfony server:start --allow-all-ip -d
```

This project has two main endpoints: `/fruit` and `/vegetable`.

Sending GET on any of theese two endpoints will return a list of fruits or vegetables respectively.

Sending GET on `/fruit/{id}` or `/vegetable/{id}`, and changing the {id} by a fruit or vegetable id will return the details of a specific fruit or vegetable.

For both GET endpoints, you can specify the param `unit` with the value `kg` to get the quantity in Kilograms. The default value will be grams.

Sending POST on `/fruit` or `/vegetable`, and including in the body a JSON like this:
```json
{
  "id": 2,
  "name": "Banana",
  "quantity": 0
}
```
will create a fruit or vegetable.

Sending DELETE on `/fruit/{id}` or `/vegetable/{id}`, and changing the {id} by a fruit or vegetable id will delete said fruit or vegetable
