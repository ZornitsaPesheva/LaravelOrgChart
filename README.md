<p align="center">
OrgChart JS with Lavarel
</p>

## Create plroject:

```
laravel new chart
```

Laravel comes with default .env file at root.
In the file you will find code like below:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Replace above all 6 lines with below 1 line - i.e Change the db_connection’s value to sqlite and delete rest of the db lines like below:

```
DB_CONNECTION=sqlite
```

Now in your database directory, create a file – *database.sqlite*
