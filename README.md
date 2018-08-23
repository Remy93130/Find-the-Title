# Find the Title

![alt text](https://raw.githubusercontent.com/Remy93130/Find-the-Title/master/public/images/favicon.png "Find the Title logo")


Find the Title is web application, he offers to his users a game whose goal is to quickly answer the question display on the game screen.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

PHP 7 is mandatory !
To install the project you need have composer to install external libraries used
When composer is ready, install libraries
```
composer install
```

### Installing

When all libraries was import to the project, you must import the database.
The database dump and some data are in the folder _migration_
the database contains few questions to start the website **after users should add more by themself**
For configure the database create a file _config.json_ on the App folder, use the example file to make it.
When users added more questions, you can up the number of question per tournament in the file _TournamentManager.php_ with the constant QUESTION_NUMBER at line 55.

to access to the admin panel, you must go on _index_admin.php_ in the same folder than admin.php
To see administration tools, you must be loggin with your account 
:warning: **Your account must have the id #1 !**


## Deployment

To deploy the website on a live system please use the following composer command
```
composer install --no-dev --optimize-autoloader
```
And don't forget to disable debug option in the _index.php_ file

## Built With

* [Bootstrap](https://getbootstrap.com/) - The web framework used for responsive design
* [JQuery](https://jquery.com/) - For the game
* [Composer](https://getcomposer.org/) - Dependency Management
* [Font Awesome](https://fontawesome.com/) - For icons

## Authors

* **Rémy Baberet** - *Initial work* - [Github account](https://github.com/Remy93130)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* TD A from DUT Informatique première année promotion 2017-2018