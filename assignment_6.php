<!DOCTYPE html>
<html>
<head>
    <title>Assignment 4</title>
    <link rel= "stylesheet" type="text/css" href="css/KingLib_6.css" />


</head>
<body>
<?php
//connecting to server
    include "assignment_6_common_functions.php";
    
    $db = connectToServer();
    $sqlstatement = simpleSelect('')
    $results = mysqli_query($db, $sqlstatement);

    $output = '';

    if (!$results) {
        $output .= "<p style='color: red;'>MySQL No: " . mysqli_errno($db) . "<br>";
        $output .= "MySQL Error: " . mysqli_error($db) . "<br>";
        $output .= "<br>SQL: " . $sqlstatement . "<br>";
    }
?>

    <div id="header">
        <a href="assignment_6_register.php">
            <img src= "images/KingLibLogo.jpg"
                 alt = "King Library Header Logo"
                 height= "84"  width="800" id= "header_image"/>
        </a>
    </div>
    <div id="featuredtitle">
        <h4 class="header_text">Featured Title!</h4>
        <img src="images/book_children_of_men.jpg">
    </div>
    <div id="stafflist">
        <h4 class="header_text">Our Staff</h4>
        <table>
            <tr>
                <td>
                    <img src="images/staff_lee.jpg ">
                </td>
                <td>
                    <img src="images/staff_shirley.jpg ">
                </td>
                <td>
                    <img src="images/staff_tom.jpg">
                </td>
            </tr>
        </table>
    </div>
    <div id="logon">

        <a href="assignment_6_register.php">
            Click to Register
        </a>

    </div>

    <div id="findtitle">
        <h4 class="header_text">Enter KeyWord to Search for Titles:</h4>
        <form method="post" action="assignment_6_booklist.php">
            <input type="text" name="book_search">
            <p>(leave blank to list all titles)</p>
            <button type="submit">Find Titles</button>
        </form>
    </div>
    <div id = "server">
        <?php
        
        getServer();
        ?>
    </div>
</body>
</html>