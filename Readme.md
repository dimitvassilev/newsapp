#Description

This is a demo app for a news articles site where every registered user
can add articles, view a list of their articles, upload multiple photos 
and delete their own articles.
Every user (registered or guest) can view the list of latest articles and
download a pdf version.
Rss feed with the latest articles is updated on article creation and deletion.



#Technologies

The application is built upon a fresh installation of Laravel 5.8 and expected to be served via  WAMP/LAMP stack (Apache (2.4.27)/MySql (5.7.19)). 
A single 3rd party library is added for the generation of pdfs - https://github.com/mpdf/mpdf
Models are defined as the framework's ORM Eloquent models.



#Installataion

1. Unpack archive.
2. Open a console window on the project root and run
```
composer install
```
3. Start Apache and MySql servers (I used WAMP v. 3.1.0)
4. Create a MySql db named 'tg' * with settings as defined in the config/database.php file, 
`'connections' => [...'mysql' =>[...]]` array entries.

5. Give access to it to a user with *:
   - username: news
   - password: news_publ1sh1nG

* Or edit these entries in the .env file:
 DB_DATABASE=tg

 DB_USERNAME=news

 DB_PASSWORD=news_publ1sh1nG


6. Run
```
php artisan migrate
```
to build the database schema (defined in the migration files at database/migrations)

7. run 
```
php artisan storage:link 
```
to make a symbolic link between storage/app/public and public/storage
(see [filesystem](https://laravel.com/docs/5.8/filesystem#the-public-disk))

8. run
```
php artisan db:seed
```
to populate the database with some users and articles.

9. run
```
php artisan generate:feed
```
to generate the rss.xml as the automated generation was skipped by the seeding.

10. run 
```
php artisan serve 
```
to start a developer server and then open the address it reports to view the application.









