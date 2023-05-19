# Le Quai Antique

Le Quai Antique is a hypothetical school project : ECF's exam topic. 

This is the website of the Savoyard restaurant Le Quai Antique in Chambery. 
It serves traditional dishes brought up to date. 
It's Arnaud Michant's third restaurant. The Chef wants to offer an authentic gastronomic experience without pretention, creating dishes that allow the local ingredients their rightful place.


## How to use ?

See the website : [Le Quai Antique](https://le-quai-antique-restaurant.herokuapp.com/)

## Table of Contents

1. [How to use ?](#How-to-use-?)
2. [Prerequisites](#Prerequisites)
3. [Installation](#Installation)
4. [Run](#Run)
5. [Add an administrator](#Add-an-administrator)
6. [Built with](#Built-with)
7. [Deploying](#Deploying)
8. [Tests](#Tests)
9. [Author](#Author)
10. [License](#License)


## Prerequisites

- MySQL version 5.7.32
- PHP 8.1
- Composer version 2.4.1
- The Symfony CLI version 5.4.13
    
    (cf. the usual [Symfony application requirements](https://symfony.com/doc/current/setup.html#technical-requirements/ "Usual Symfony application requirements")).

## Installation

1. Download the zip or clone the project in local :   
   `git clone https://github.com/Melissa-code/quai_antique.git`


2. Move into the directory :  
   `cd /path/to/the/file/quai_antique`
   

3. Open the project with a code editor, for instance PHPStorm.


4. Copy/Paste the .env file in a new file .env.local:  
   `cp .env .env.local`


5. Change the credentials of the connection to the database in the .env.local file :  
   `DATABASE_URL=mysql://root:root@127.0.0.1:8889/quai_antique?serverVersion=5.7`


6. Install the Composer dependencies  
   `composer install`


7. Create the database named quai_antique :  
   `php bin/console doctrine:database:create`


8. Make a migration :  
   `php bin/console make:migration`


9. Send the data to the database :  
   `php bin/console doctrine:migrations:migrate`


## Run

1. Start the local web server :
   
    `symfony server:start`


2. Open your browser and navigate to http://localhost:8000/


3. To stop it : 
   
    `symfony server:stop` or press both : `ctrl + C`


### If you have a problem with the database :
- Delete the migration file in the project,
  

- Delete the database with the command :`php bin/console doctrine:database:drop --force`


- Create again the database : `php bin/console doctrine:database:create`


- Make a migration : `php bin/console make:migration`


- Load the data fixtures : `php bin/console doctrine:fixtures:load`

## Add an administrator

1. Create a new user with the Create a new account form of the application
2. Use in the terminal :
    `php bin/console doctrine:query:sql "UPDATE user SET user.roles = '[\"ROLE_ADMIN\"]' WHERE user.id = 1;"`


## Built with

### Languages & Frameworks
- Symfony (Symfony Documentation [Symfony Documentation](https://symfony.com/doc/current/index.html "Symfony Documentation")).
- PHP (PHP Documentation [PHP Documentation](https://www.php.net/manual/fr/index.php "PHP Documentation")).
- Doctrine (Doctrine ORM Documentation [Doctrine Documentation](https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/index.html "Doctrine Documentation")).
- SQL (SQL Documentation [SQL Documentation](https://sql.sh/ "SQL Documentation")).
- Twig (Twig Documentation [Twig Documentation](https://twig.symfony.com/doc/ "Twig Documentation")).
- HTML CSS (HTML CSS MDN Documentation [MDN Documentation](https://developer.mozilla.org/fr/docs/Web "HTML & CSS MDN Documentation")) & (W3School [W3School](https://www.w3schools.com/ "W3School")).
- Bootstrap (Bootstrap Documentation [Bootstrap Documentation](https://getbootstrap.com/ "Bootstrap Documentation")).
- Lightbox for Bootstrap (Ekko Lightbox [Ekko Lightbox](http://ashleydw.github.io/lightbox/ "Ekko Lightbox")).
- JavaScript (JavaScript Documentation [MDN JavaScript Documentation](https://developer.mozilla.org/fr/docs/Web/JavaScript "MDN JavaScript Documentation")).
- Axios (Axios Documentation [Axios](https://axios-http.com/docs/intro "Axios Documentation")).
- Moment.js (Moment.js Documentation [Moment.js](https://momentjs.com/ "Moment.js")).
- Git (Git Documentation [Git Documentation](https://git-scm.com/doc "Git Documentation")).

### Tools

- FontAwesome (Fontawesome [Fontawesome](https://fontawesome.com/icons "Fontawesome")) and 
CDN font-awesome (CDN font-awesome [CDN font-awesome](https://cdnjs.com/libraries/font-awesome "CDN font-awesome")).
- Noun Project (Noun Project [Noun Project](https://thenounproject.com/ "Noun Project")).
- GitHub (GitHub [GitHub](https://github.com/ "GitHub")).

### IDE 
- PHPStorm version pro


## Deploying

The production deployment of Le Quai Antique is hosted on Heroku.

### Prerequisite

1. Install Git and Initialize a Git repository
2. Create a Heroku account 
3. Install the Heroku CLI, for instance for MacOS use : `brew tap heroku/brew && brew install heroku`
  
    (cf. Heroku Documentation [Heroku Documentation](https://devcenter.heroku.com/articles/heroku-cli "Heroku Documentation")). 
   
    Verify the installation using : `heroku --version`

### Get started
1. Check if `APP_ENV=prod` in the .env file and empty the cache using : `php bin/console cache:clear`

2. Login to Heroku with the command :
   
    `heroku login`
   
3. Create a new project : 
   
    `heroku create le-quai-antique-restaurant`
   
4. Configure Symfony to run in the prod environment : 
   
    `heroku config:set APP_ENV=prod`
   
5. Remote the local project to the Heroku app : 
   
    `git add .`
   
    `git commit -m "Deploying of the project."` 
   
    `git push heroku main`
   
    (cf. Deploying Symfony 4/5/6 Apps on Heroku [Deploying Symfony 4/5/6 Apps on Heroku](https://devcenter.heroku.com/articles/deploying-symfony4 "Deploying Symfony 4/5/6 Apps on Heroku")).

    #### Create a database :
   
6. Create a new MySQL database with the Addon JawsDb :  
   
    `heroku addons:create jawsdb:kitefin`
   
    (cf. Install JawsDB MySql [JawsDB MySQL](https://elements.heroku.com/addons/jawsdb "JawsDB MySQL")).

7. Create a new environment variable named "DATABASE_URL" on the dashboard of Heroku --> settings --> Reveal Config vars : copy/paste the value of the JAWSDB_URL to add it to the key DATABASE_URL and click on the Add button.

8. Get the DATABASE_URL: 
   
    `heroku config:get DATABASE_URL`
   
9. Import the local database to the new database : 
   
    `mysql -h hostname -u username -ppassword database < quai_antique.sql`

10. Deploy again : 
    
    `git add .`
    
    `git commit -m "Create a database"`
    
    `git push heroku main`

    #### Change the .htaccess file to redirect to HTTPS after the logout :
1. Comment the lines 52 and 53 :
   
   `RewriteCond %{ENV:REDIRECT_STATUS} =""`
   
   `RewriteRule ^index\.php(?:/(.*)|$) %{ENV:BASE}/$1 [R=301,L]`

2. Add the code : 
   
   `RewriteCond %{HTTP:X-Forwarded-Proto} !https`
   
   `RewriteCond %{ENV:REDIRECT_STATUS} ^$`
   
   `RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]`
   
    #### Add or update an administrator : 

1. Create if necessary a new user with the Create a new account form of the application
2. Use in the terminal :
   
   `heroku run php bin/console doctrine:query:sql "UPDATE user SET user.roles = '[\"ROLE_ADMIN\"]' WHERE user.id = 1;"`

## Tests



## Author
Melissa-code

## License
[MIT](https://choosealicense.com/licenses/mit/)
