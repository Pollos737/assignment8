<html>
<head>
    <title>Loading King Library DB</title>
</head>
<body>
<?php

//Connect to MySQL and test database

$db = mysqli_connect('localhost','root','', 'kinglibrary');

if (!$db) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}


//Load BookPub database

$err_cntr = 0;

$bookpub_sql = getSQL();  //Retreive the entire SQL statement string

$mySQLArray = explode(';', $bookpub_sql);  //Break up into individual SQL statements

foreach ($mySQLArray as $element)
{
    //print "<br>$element";
    $sqlstatement = trim($element);

    if ($sqlstatement != '')
    {
        $status = doSQLStatement($db, $sqlstatement);

        if ($status == 'error')
        {
            $err_cntr++;
        }
    }
}

if ($err_cntr > 0)
{
    print "<h1>There were errors!</h1>";
    print "<br><b>Try running this program one more time by clicking Reload/Refresh</b>";
    print "<br><b>If you get errors again, then email me!</b>";
} else {
    print "<h1>bookpub was re-loaded successfully</h1>";
    print "<br><b>Run this script any time you change the database</b>";
}


function doSQLStatement($db, $a_sql_string)
{
    $result = mysqli_query($db, $a_sql_string);

    if ($result) {
        return 'ok';
    } else {
       // echo("<p style='color: red;'>MySQL No: ".mysqli_errno($result)."<br>");
        echo("MySQL Error: ".mysqli_error($result)."<br>");
        echo("SQL: ".$a_sql_string."</p");

        return 'error';
    }
}

?>

<?php
function getSQL()
{
    $filename = 'data/'.'booklist.txt';
    $numOfLines = count(file($filename));
    $fp = fopen($filename, 'r');
    for ($i = 1; $i <= $numOfLines; $i++) {
        $line = fgets($fp);
        $trimmedLine = trim($line);
        list($title, $category, $pub_date, $isbn) =
            explode('*', $trimmedLine);
    }
    $display = '';
    $bookpub_all_sql = "
    drop table IF EXISTS book;
    drop table IF EXISTS city;
    drop table IF EXISTS patron;
    drop table IF EXISTS staff;
    
    CREATE TABLE book(
      isbn VARCHAR(13) NOT NULL , 
      title VARCHAR(80) NOT NULL ,
      category VARCHAR(20) NOT NULL ,
      date_pub DATE NOT NULL ,
      PRIMARY KEY (isbn)
    );
    
    CREATE TABLE city(
      city_id INT(10) PRIMARY KEY AUTO_INCREMENT,
      city_name VARCHAR(20) NOT NULL 
    );
    
    CREATE TABLE patron(
      patron_id INT(10) PRIMARY KEY AUTO_INCREMENT,
      last_name VARCHAR(20) NOT NULL,
      first_name VARCHAR(20) NOT NULL ,
      city_name VARCHAR(20) NOT NULL ,
      email VARCHAR(40) NULL ,
      birth_year int(25) NULL 
    );
    
    CREATE TABLE staff(
      staff_id int(10) PRIMARY KEY AUTO_INCREMENT,
      image_url VARCHAR(40) NOT NULL 
    );
    
    INSERT INTO city
    VALUE('Detroit');
    
    INSERT into book
    VALUES ('1-4203-4203-x', 'Fifty Years in Buckingham Palace Kitchens', 'cooking', '1998-06-12' );
    
    INSERT into book
    VALUES ('1-2106-2106-x', 'Life Without Fear', 'psychology', '1998-10-05' );
    
    INSERT into book
    VALUES ('1-1035-1035-x', 'But Is It User Friendly?', 'computer', '1998-06-30' );
    
    INSERT into book
    VALUES ('1-3026-3026-x', 'The Psychology of Computer Cooking', 'computer', '1998-06-18' );
    
    ";
    
    
    return $bookpub_all_sql;
    }







?>
</body>
</html>