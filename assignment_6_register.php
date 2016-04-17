<!DOCTYPE html>
<html lang= "en">
<head>
    <title>Assignment 3 Register</title>
    <link rel= "stylesheet" type="text/css" href="css/KingLib_6.css" />
</head>

<body>
<div id="header">
    <a href="assignment_6.php">
        <img src= "images/KingLibLogo.jpg"
             alt = "King Library Header Logo"
             height= "84"  width="800" id= "header_image"/>
    </a>
</div>

<main>
    <div>
        <p id="sign_up">Please Sign Up</p>
    </div>

    <form method= "post" action= "assignment_6_add_patron.php">
        <p>
            First Name: <br />
            <input type="text" name="firstName" size="30" />
        </p>

        <p>
            Last Name: <br />
            <input type="text" name="lastName" size="30" />
        </p>

        <p>
            Email: <br />
            <input type="email" name="userEmail" size="30" />
        </p>
        <p>
            Birth Year: <br>
            <input type="text" name="birthYear" size="4" maxlength="4">
        </p>
        <p>
            City of Residence: <br/>
            <select name="city" size="1">
                <option value="empty">-</option>
                <?php
                include "assignment_6_common_functions.php";

                $db =  connectToServer();

                $sqlstatement = simpleSelect('name', 'city');
                $sqlstatement .= "ORDER BY name ";

                $results = mysqli_query($db, $sqlstatement);

                $output = '';

                if (!$results) {
                    $output .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
                    $output .= "MySQL Error: ".mysqli_error($db)."<br>";
                    $output .= "<br>SQL: ".$sqlstatement."<br>";
                } else {
                    $numRows = mysqli_num_rows($results);
                    for($i = 0; $i < $numRows; $i++){
                        $row = mysqli_fetch_array($results);
                        $cityName = $row['name'];
                        $output .= "<option value=".$cityName.">$cityName</option>";
                    }
                    echo $output;
                }
                ?>
            </select>
        </p>
        <p>
            <input type ="submit" value = "Submit Information"/>
        </p>
    </form>
    <div id="viewPatrons">
        <span>For Admin Use Only: </span><a href="assignment_6_view_patron.php">View Patrons</a>
    </div>
</main>
<div id = "server">
    <?php
        echo getServer();
    ?>
</div>
</body>
</html>
