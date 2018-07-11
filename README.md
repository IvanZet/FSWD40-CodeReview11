# Car rental web-site
## Description
This is a website done in Code Factory Vienna web development school for learning purposes. I did the work based on assignment text on my own. The goal of this project is to practice tracking user sessions, managing logins and logouts, presenting data from a mySQL database and updating web-page content via AJAX. The main project files are in the folder "simple". The folder "bootstrap" contains an incomplete draft based on Bootstrap.
## Screenshot
![Screenshot](car-rental-screenshot.png)
## Technologies used
* Back-end is done in PHP 7.2.6
* Front-end is implemented in plain HTML and short CSS
* Data are stored in a mySQL database. 
* AJAX via XMLHttpRequest in JavaScript and PHP is used to update content on the page Location of cars
## Installation
1. Upload all files from the folder “simple” to your Apache server
2. Create an empty database called “cr11_ivan_zykov_php_car_rental”
3. Import file cr11_ivan_zykov_php_car_rental.sql from the repo root directory into the database
4. Edit file simple/db_connect_cr11.php. Change values of the following variables as required to connect to the database: DBHOST, DBUSER, DBPASS, DBNAME
## Details
#### Page Sign in
A registered user can sign in. Only after log in the content of the web-site is available. On top of the page there is a link to sign up. The following credentials can be used to log in as administrator: admin@gmail.com and password 123456. Administrators can see additional page Report. After a user inputs credentials, he is redirected to the page Locations of cars.
#### Page Sign up
A new user can fill in the form and register. Data is written into the mySQL database
#### Page Offices
All the offices are shown in a table
#### Page Cars
The page shows all the cars in the database
#### Page Location of cars
The page displays all the cars available for booking and in which office they are located. Filtering of offices is available via AJAX XMLHttpRequest using filter.js and filterOffice.php.
#### Page Report
Here one can see, how many cars are available for booking per each office.
#### Log out
A user can log out
## Features to be implemented
* Improve database security (injections)
* Improve user management security
* add the rest of CRUD operations
