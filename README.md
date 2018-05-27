# Customer Browser

### Description

This is a very simple php app consuming an API.

### Compromises/Shortcuts => ToDos

Topics I thought about but I didn't do because of lack of time:

* Use Models for Orders and Customers (so dont rely on the api object and structure - especially important for templating or also unknown changes of the api response)
* suggest to remove "amount of orders" to Customer Details page to increase usability and/or add caching to speed up api calls and/or persist data (on regular basis, or with a TTL)
* handle api erros
* handle error when customer does not exist on details page ( would be easier if the php app contains models for the objects)
* increase amount of comments / add annotations
* test cases
* fix visual apperiance :-)

### Instructions
This php project requires PHP >= 7.1 as well as the composer

Once installed, you should install the dependencies by running
```
composer install
```

To serve the application, run
```
php -S localhost:8000 -t public
```

To run the test suite, run
```
./vendor/bin/phpunit
```
