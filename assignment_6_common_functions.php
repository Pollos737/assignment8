<?php
/**
 * Created by PhpStorm.
 * User: wilme
 * Date: 3/5/2016
 * Time: 4:10 PM
 */

function getServer(){

    $server = $_SERVER['SERVER_NAME'];
    $positionFound = strpos($server, 'profperry');

    if ($positionFound === false)
    {
        $server = 'localhost';
    } else {
        $server = 'Practice Area';
    }

    return $server;
}

function doValidtion($firstName, $lastName, $userEmail, $city,$birthYear){

    $currentYear = date('Y');

    $errorFound ="n"; //If this variable is set to y, the program will exit
    $displayErrors = '';
    //This next code will make sure the fields were filled out
    if(empty($firstName))
    {
        $errorFound = "y";
        $displayErrors .="<p>Error: Please Enter First Name</p>";
    }
    if(empty($lastName))
    {
        $errorFound = "y";
        $displayErrors .= "<p>Error: Please Enter Last Name</p>";
    }
    if(empty($userEmail))
    {
        $displayErrors .= "<p>Error: Please Enter an Email</p>";
        $errorFound = "y";
    }
    if($city == "empty")
    {
        $displayErrors .= "<p>Error: Please Select A City</p>";
        $errorFound = "y";
    }
    if(empty($birthYear))
    {
        $displayErrors .= "<p>Error: Please Enter a Birth Year";
        $errorFound = "y";
    } elseif(!(is_numeric($birthYear)) || $birthYear < 1900 || $birthYear > $currentYear )
    {
        $displayErrors .= "<p>Error: Please enter a valid 4 digit number for birth year</p>";
        $errorFound = "y";
    }

    if($errorFound == "y")
    {
        print $displayErrors;
        print "<p>Go BACK and make the corrections above</p>";
        print "</body></html>";
        return exit;
    }

    return $displayErrors;

}

function connectToServer()
{
    $server = getServer();
    if ($server == "Practice Area")
    {
        require('../../DBtest_pptest.php');

        $host =  'localhost';
        $userid =  'p11';
        $password = '7dosql7';
        $dbname = 'testdb';

        $db = mysqli_perry_pconnect($host, $userid, $password, $dbname);

        if (!$db)
        {
            print "<h1>Unable to Connect to MySQLi</h1>";
            exit;
        }

    } else {
        //this runs if I'm running on my local server
        $db = mysqli_connect('localhost','root','', 'kinglibrary');

        if (!$db)
        {
            print "<h1>Unable to Connect to MySQL</h1>";
        }
    }
    
    return $db;
}

function simpleSelect($field, $table, $order)
{
    $sqlstatement = "SELECT ".$field." ";
    $sqlstatement .= "FROM ".$table." ";
    $sqlstatement .= "ORDER BY ".$order." ";
    
    return $sqlstatement;
}

function simpleInsert($db, $table, $value1, $value2, $value3, $value4, $value5)
{

    $statement 	= "INSERT INTO $table (`patron_id`, `last_name`, `first_name`, `city_name`, `email`, `birth_year`) ";
    $statement .= "values (NULL, ";
    $statement .= "'".$value1."', '".$value2."', '".$value3."','".$value4."','".$value5."' ";
    $statement .= ") ";

    $result = mysqli_query($db, $statement);

    if ($result)
    {
        return $value1;
    } else {

        if (!$results) {
            $output .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
            $output .= "MySQL Error: ".mysqli_error($db)."<br>";
            $output .= "<br>SQL: ".$sqlstatement."<br>";
        }

        return $output;
    }


}