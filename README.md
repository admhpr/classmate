# Adv-Web-Final-Project

## Reddit/HackerNews/StackOverflow clone

## Stack

- Maria DB
- Php 7.0
- JavaScript, CSS, HTML

---------------------------------------------------------
Basic Prototype Using Model View Presenter Architecture

## Basic Application Structure ( so far )

> MVP is a user interface architectural pattern engineered to facilitate automated unit testing and improve the separation of concerns in presentation logic:

The model is an interface defining the data to be displayed or otherwise acted upon in the user interface.
The view is a passive interface that displays data (the model) and routes user commands (events) to the presenter to act upon that data.
The presenter acts upon the model and the view. It retrieves data from repositories (the model), and formats it for display in the view.
*************
### Root Level index.php

This acts in similar way to the url rewriting we are looking at in advanced topics. We could eventually use url rewriting.

Basically it will look to see if a presenter is being requested and set it as a variable along with and action such as show all or find by id.

It will default to home if there no request set.
*************
### Includes

This folder contains all the helper and utility Classes and functions such as DB connection classes configuration etc.
*************
### Views

These are the templates for the pages and the frontend of the application.

`views/layout.php`

is a file that doesn't change regardless of what page is requested by the browser.
*************
### Model
 The Model is used to access the data that is relevant to particular thing. I.e in the case of a user what methods are needed to pull the necessary details from the table.
*************
### Presenter
The presenter gives us options on what data to display about that thing. I.e in the case of a user show, show by id etc.
*************
### htaccess
We are using module rewriting to display the data based on the urls that come in. Using a regular expression we can capture what is needed and then
*************
See [Refererence](#markdown-header-reference) for details.

## Reference
- htaccess : https://www.addedbytes.com/blog/url-rewriting-for-beginners
- MVP: http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/