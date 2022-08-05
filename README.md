# RESTful API with PHP/MySQL
Create RESTful API With PHP/MySQL.

For RESTful API with PHP/MySQL. This is a full guide for you. You can use the youtube video on <a href="https://www.youtube.com/watch?v=dlGtSoigdB0" target="_blank">this link</a>, or follow the steps bellow and use the code in this repository.

NOTE: There are 2 version of this project. The 2nd version is on ../src, ../index.php, and ..//.htaccess.

First will start with the 1st version.

# Start from here
<ol>
  <li>In project folder, create a "core" folder and a new file "initialize.php" for all our settings.</li>
  <li>In project folder, create a "includes" folder and a new file "config.php" for database connection.</li>
  <li>Add DB connection in "config.php".</li>
  <li>Set some db attributes in "config.php".</li>
  <li>Define necessery constants in "initialize.php".</li>
  <li>Create core classes in "initialize.php" (e.g. by named 'post').</li>
  <li>Create folder in root with a file in the folder by named /api/read.php to allow HTTP request here.</li>
  <li>In read.php instantiate post class and then, get the row count and prepare output in json.</li>
  <li>Create db and tables and then, insert data in tables. you can use the sql file in sql folder in this repo.</li>
  <li>Add read_single function in post.php. Then create a new file in api/read_single.php and write the code for GET method for single row.</li>
  <li>Add 'create' function in post.php. Then create a new file in api/create.php and write the code for POST, Also, you need to add some headers.</li>
  <li>You can use the structure in POST method for PUT and DELETE.</li>
  <li>Do the same things for category table.</li>
</ol>

NOTE: If you sraggling somewhere, you can get help from the codes in this repository.

# URIs

To costum URIs instead of calling the files directly, you can use <a href="https://www.youtube.com/watch?v=X51KOJKrofU" target="_blank">this video</a>.
