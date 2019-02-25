# SolarCenturyTest
Test for Solar Century

Instructions:
This test has been developed with PHP 7.2 and MySql 5.6
The command below could change depending of machine and set up.

**Steps:**

* php composer install
set up database on .env
like: DATABASE_URL=mysql://solarc:solarc@127.0.0.1:3306/solar_century

* php bin/console doctrine:database:create
* php bin/console doctrine:schema:create

I created some fixtures so you can check some endpoints

* php bin/console doctrine:fixtures:load

I used minimum css and JS for this test but I used standard set up encore.
https://symfony.com/doc/4.0/frontend/encore/installation.html

Modify phpunit.xml.dist for unit tests.

Code standards: I followed https://cs.symfony.com/

Extra Documentation for API: Nelmio https://github.com/nelmio/NelmioApiDocBundle