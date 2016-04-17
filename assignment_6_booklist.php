<!DOCTYPE html>
<html>
<head>
    <title>Assignment 4</title>
    <link rel= "stylesheet" type="text/css" href="css/KingLib_6.css" />
</head>
<body>
<header>
    <div id="header">
        <a href="assignment_6.php">
            <img src= "images/KingLibLogo.jpg"
                 alt = "King Library Header Logo"
                 height= "84"  width="800" id= "header_image"/>
        </a>
    </div>
</header>
<main>
    <?php
        include "assignment_6_common_functions.php";
        $display = '';
        //getting user input
        if(isset($_POST['book_search'])){
            $keyword = $_POST['book_search'];
        } else{
            $keyword = '';
        }

        if(empty($keyword)){
            $display = '<h4>Current Title</h4>';
        } else{
            $display = '<h4>Current Titles that match '.$keyword.'</h4>';
        }

        $db = connectToServer();

        if(empty($keyword)){
            //this runs if there is no keyword
            $sqlstatement = "SELECT * ";
            $sqlstatement .= "from book ";
            $results = mysqli_query($db, $sqlstatement);

            if(!$results){
                $display .= "<p style='color: red;'>MySQL No: " . mysqli_errno($db) . "<br>";
                $display .= "MySQL Error: " . mysqli_error($db) . "<br>";
                $display .= "<br>SQL: " . $sqlstatement . "<br>";
            } else{
                //print out the rows
                $numOfLines = mysqli_num_rows($results);
                for($i = 1; $i - 1 < $numOfLines; $i++){
                    $row = mysqli_fetch_array($results);
                    $isbn = $row['isbn'];
                    $title = $row['title'];
                    $category = $row['category'];
                    $pub_date = $row['date_pub'];

                    $display .= $i.'. '.$title.'<br>';
                    $display .= 'Category: '.$category.'<br>';
                    $display .= 'Date Published: '.$pub_date.'<br>';
                    $display .= 'ISBN: '.$isbn.'<br><br>';
                }
            }
        } else {
            //this else runs if there's a keyword
            $sqlstatement = "SELECT * ";
            $sqlstatement .= "from book ";
            $sqlstatement .= "WHERE title LIKE ('%$keyword%') ";
            $results = mysqli_query($db, $sqlstatement);

            if(!$results){
                $display .= "<p style='color: red;'>MySQL No: " . mysqli_errno($db) . "<br>";
                $display .= "MySQL Error: " . mysqli_error($db) . "<br>";
                $display .= "<br>SQL: " . $sqlstatement . "<br>";
            } else {
                //this prints out the rows
                $numOfLines = mysqli_num_rows($results);
                for ($i = 1; $i <= $numOfLines; $i++) {

                    $row = mysqli_fetch_array($results);
                    $isbn = $row['isbn'];
                    $title = $row['title'];
                    $category = $row['category'];
                    $pub_date = $row['date_pub'];

                    $display .= $i.'. '.$title.'<br>';
                    $display .= 'Category: '.$category.'<br>';
                    $display .= 'Date Published: '.$pub_date.'<br>';
                    $display .= 'ISBN: '.$isbn.'<br><br>';
                }
            }
        }

        print $display;

    ?>
</main>
<div id = "server">
    <?php
        getServer();
    ?>
</div>
</body>
</html>