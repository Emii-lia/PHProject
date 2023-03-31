# Church Financial Management

## Descriptions

This is an university project to help our groups to improve and evaluate our skills. 
It consists of managing incomes and outcomes of churches that are registered in the database.
This website includes differents functionalities such as:

* Creating and listing Churches 
* Creating, listing and adding incomes and outcomes of a selected church
* Limiting the outcomes so that the financial statement of the church won't go under Ar 10,000
* Making a quick search by reason of incomes and outcomes
* Making a quick search by name of churches
* A statistical review of the financial statement of the church(numerical statistics and graphical statistics: plot)
* A table of cash movement between two selected dates and also the possibility to generate this table as a PDF file

This is a PHP project so we obviously use PHP to develop this website along with Tailwindcss to offer a better interface and a little bit of JavaScript for event handling

## Installation and requirements (Avalaible for group members only)

In order to use this website you obviously have to clone the repository [here](https://github.com/Emii-lia/PHProject)

Or type the following command on your terminal

``` bash
    git clone https://github.com/Emii-lia/PHProject.git

```

You can't use this project if you are not a member of the group because our database is still on local but we manage to store it on a cloud server soon

After cloning the repository you need to install the node package for tailwindcss

``` bash
    cd PHProject
    npm install

```

Make sure you have the last version of *node* and *npm* installed before running this command

After that, you need to create a php file on *src/backend/* folder named *var.php* and add the following script

``` php

<?php
$servername = "localhost";
$username = "YOUR_USERNAME";
$password = "YOUR_PASSWORD";
$database = "eglise_db";
?>

```
Replace YOUR_USERNAME with your username on mysql and YOUR_PASSWORD with your password

Then, in order to launch the website you need to host it on a local server such as xampp, wampp, apache2 or just run the following command if you have php installed on your system

``` bash
    php -S localhost:8800
```
## About us
PHP Project
We are a group of IT students on L2 GB G1:

* RAMIARAMANANA Sompitriniaina To Desire 2405
* ANDRIANARIVONY Zo Michael 2382
* VONIARIMALALA Fiaro Miangaly 2381
