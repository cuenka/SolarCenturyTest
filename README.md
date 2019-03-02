# SolarCenturyTest
Test for Solar Century

Instructions:
This test has been developed with PHP 7.2 and MySql 5.6
The command below could change depending of machine and set up.

**Steps:**
```
php composer install
```

* set up database on .env like: 
```
DATABASE_URL=mysql://solarc:solarc@127.0.0.1:3306/solar_century
```
Also update phpunit.xml.dist with the right DB, Line 15
In order to create Database, create migration and add fixtures run:
Updated: Before I used schema, migrations offer solutions to potential future problems.
https://stackoverflow.com/questions/23339711/doctrine-schema-update-or-doctrine-migrations

```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

I used minimum css and JS for this test but I used standard set up encore.(not required)
https://symfony.com/doc/4.0/frontend/encore/installation.html


Code standards: I followed https://cs.symfony.com/

Extra Documentation for API: Nelmio https://github.com/nelmio/NelmioApiDocBundle

**More information**
I covered most basic features of Symfony, a added few things like Services, forms or some queries
on Repository that are not used or were not required but I wanted to show

My apologies, somehow I forgot to push my final commit the 24-02-2019

