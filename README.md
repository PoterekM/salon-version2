# _Hair Salon_

#### _Database Basics: Week 3 Independent Project, July 14, 2017_

#### By **Michelle Poterek**

## Description

_This project allows a hair salon to add hair stylists, view all stylists, as well as add and view clients for each stylist by clicking the stylist's name._

## Setup/Installation Requirements

_**If you already have MAMP downloaded and installed:**_

````
**open Terminal and navigate to desktop by typing `cd desktop`**


* $ `git clone https://github.com/PoterekM/salon-version2.git`
* $ `cd salon-version2`
* $ `composer install`


**In MAMP**
* Select the Start Servers
* Go to preferences>web server and click on the folder icon next to 'document root'
* Click on 'web' folder of project and hit 'select'
* Hit ok at the bottom of the preferences window


CREATING THE DATABASE

**In your browser (recommended way)**
* Navigate to `http://localhost:8888/phpmyadmin/`
* Upload `hair_salon.sql.zip` (located within the repository)
* If the tests are of interest to you, upload `hair_salon_test.squl.zip` as well.
* when running the tests use the command $ ./vendor/bin/phpunit tests


**OR TO GET THE DATABASE FROM TERMINAL**
> /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
> CREATE DATABASE hair_salon;
> USE hair_salon;
> CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR(255), stylist_id INT);
> CREATE TABLE (id serial PRIMARY KEY, stylist VARCHAR(255);
````

_**If you need to download and Install MAMP:**_
````
* If you do not have Composer here is a link to their website https://getcomposer.org/download/
* If you do not have MAMP please download from their website https://www.mamp.info/en/downloads/



* Launch your newly-installed MAMP program.
* When MAMP launches you will be greeted by a small window with several options. Click Preferences.
* In the Preferences window, select the Ports tab.
* Set the Apache Port to 8888.
* Set the MySQL Port to 8889.
* Click OK to save your new port configurations.

````

## Technologies Used

* PHP
* Composer
* Twig
* Silex
* CSS
* Bootstrap
* SQL
* Apache
* MAMP

### Acknowledgements
_Thanks to Epicodus for providing some of the MAMP installation instructions at learnhowtoprogram.com_

## Support and contact details
_Please feel free to contact me directly via e-mail at poterekm@gmail.com if you have any questions, comments, ideas, or feedback. Also, I invite you to feel empowered to make any changes to this repository by forking it and making changes accordingly._

## Known Bugs
* The program resubmits the last name entered and does not allow apostrophes.

### License

*This project is under the MIT License*

Copyright (c) 2017 **Michelle Poterek**
