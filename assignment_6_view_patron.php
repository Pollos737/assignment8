<!DOCTYPE html>
<html>
<head>
    <title>View Patrons</title>

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
        <h3>View Patrons</h3>
        <?php
            include "assignment_6_common_functions.php";
            $db = connectToServer();

            $sqlstatement = simpleSelect('*', 'patron');
            $sqlstatement .=  "ORDER BY last_name ";

            $results = mysqli_query($db, $sqlstatement);

            $output = '';
            $lines = 0;

            if (!$results) {
                $output .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
                $output .= "MySQL Error: ".mysqli_error($db)."<br>";
                $output .= "<br>SQL: ".$sqlstatement."<br>";
            } else {
                $lines = mysqli_num_rows($results);
                if($lines < 1)
                {
                    $output .= "<p>There are no Patrons</p>";
                    print $output;
                }
            }
        ?>

        <table border="1">
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Birth Year</th>
            </tr>
            <?php
                $display = "";
                if($results) {
                    for ($i = 0; $i < $lines; $i++){
                        $row = mysqli_fetch_array($results);
                        $lastName = $row['last_name'];
                        $firstName = $row['first_name'];
                        $userEmail = $row['email'];
                        $city = $row['city_name'];
                        $birthYear = $row['birth_year'];

                        $lineEvenOrOdd = $i % 2;

                        if($lineEvenOrOdd == 0){
                            $style = "style='background-color: #white;'";
                        } else {
                            $style = "style='background-color: #F0E68C;'";
                        }

                        //adding data to table
                        $display .= "<tr $style>";
                        $display .= "<td>".$lastName."</td>";
                        $display .= "<td>".$firstName."</td>";
                        $display .= "<td>".$userEmail."</td>";
                        $display .= "<td>".$city."</td>";
                        $display .= "<td>".$birthYear."</td>";
                        $display .= "</tr>\n";  //added newline
                    }
                }
                echo $display;
            ?>
        </table>


    </main>
    <div id = "server">
        <?php

        getServer();
        ?>
    </div>
</body>
</html>