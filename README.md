# Adv-Web-Final-Project

## Reddit/HackerNews/StackOverflow clone

## Stack

- Maria DB
- Php 7.0
- JavaScript, CSS, HTML
***********************
## Recipe to add a module
1. add a file to the `models` folder that queries the database
2. add a file to the `presenters` folder that users the sql queries defined in the model then require the view underneath that will access to the data returned by the query, be sure to add the `_presenter` suffix as this is used in `routes.php` to load a presenter in to the routes config.
3. add a corresponding `view` folder named afther the presenter. This holds pages that reflect a method in the `presenter`. We then use the variable defined in that method to render the data in the corresponding view. eg the user folder has index.php and show.php as those relate to the two methods in `user_presenter`:
```
<?php
  class UserPresenter {
    public function index() {
      // we store all the users in a variable
      $users = User::all();
      require_once('views/user/index.php');
    }

    public function show() {
      // we expect a url of form ?presenter=users&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      // we use the given id to get the right post
      $user = User::find($_GET['id']);
      require_once('views/user/show.php');
    }
  }
?>
```
4. add a case block to the `routes.php` file. The model is also included here. Finally add the thing as a key in the presenters array then add a secondary list of potential actions defined in it's presenter.

***********************
Basic Prototype Using Model View Presenter Architecture

## Basic Application Structure ( so far )

> MVP is a user interface architectural pattern engineered to facilitate automated unit testing and improve the separation of concerns in presentation logic:

The model is an interface defining the data to be displayed or otherwise acted upon in the user interface.
The view is a passive interface that displays data (the model) and routes user commands (events) to the presenter to act upon that data.
The presenter acts upon the model and the view. It retrieves data from repositories (the model), and formats it for display in the view.
*************
### Root Level index.php
url rewriting it hiding this process

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